<?php

namespace App\Http\Controllers;

// Benodigde libraries
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
// JSON berichten decoden:
use function GuzzleHttp\json_decode;
use InvalidArgumentException;
use Jose\Factory\JWKFactory;
use Jose\Loader;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
// functie openlogin waarin verwezen wordt, dit moet leiden naar een URL, zie web.php
    public function openlogin(): View
{
  // Als sessie van openid al is aangemaakt hoeft er geen nieuwe sessie aangemaakt te worden
    if (!session()->has('openid.state')) {
        session()->put('openid.state', str_random(32));
    }
// Maakt een sessie aan met de endpoint gegevens van Google
    session()->put('openid.nonce', str_random(32));

    $endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';
    $clientId = env('GOOGLE_CLIENT_ID');
    $redirectUri = route('callback');
    $state = session('openid.state');
    $nonce = session('openid.nonce');

    $link = "{$endpoint}" .
        "?client_id={$clientId}" .
        "&response_type=code" .
        "&scope=openid email profile" .
        "&redirect_uri={$redirectUri}" .
        "&state={$state}" .
        "&nonce={$nonce}";
// neemt de gegevens van variabel link mee met de return view van auth.openidconnect blade, een $link kan aangesproken worden d.m.v. een knop of link
    return view('auth.openidconnect')->with(['link' => $link]);
}
// Callback functie nadat gegevens van Google worden teruggestuurd naar de client
public function callback(Request $request)
{
  // Indien er een timeout is tussen de relatie laat dan een timeout zien
    if ($request->input('state') !== session('openid.state')) {
        return redirect()->route('index')->withErrors(['state' => 'timeout in relatie tussen client en server.']);
    }

    // haal het Discovery document van Google's OpenID Connect op.
    $client = new Client();
    $response = $client->get('https://accounts.google.com/.well-known/openid-configuration');
    $discoveryDocument = json_decode($response->getBody());

    $response = $client->request('POST', $discoveryDocument->token_endpoint, [
        'form_params' => [
            'code' => $request->input('code'),
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => route('callback'),
            'grant_type' => 'authorization_code'
        ]
    ]);
    // Haal autorisatie token op en voeg er 10 minuten autorisatie tijd aan toe
    $tokens = json_decode($response->getBody());

    $expiresAt = Carbon::now()->addMinutes(10);
    $jwks = Cache::remember('google.jwks', $expiresAt, function () use ($client, $discoveryDocument) {
        $jwk_set = JWKFactory::createFromJKU($discoveryDocument->jwks_uri);

        return $jwk_set;
    });
    // laad een lader
    $loader = new Loader();
    $signature_index = null;
    // Probeer een signature op te halen door een token en de juist keyset
    try {
        $jws = $loader->loadAndVerifySignatureUsingKeySet(
            $tokens->id_token,
            $jwks,
            ['RS256'],
            $signature_index
        );
    } catch (InvalidArgumentException $exception) {
        return redirect()->route('index')->withErrors(['id_token' => 'Kan geen signature ophalen']);
    }
    // Genereer autorisatietoken
    $idToken = collect($jws->getPayload());
    $issNotValid = !in_array($idToken->get('iss'), ['https://accounts.google.com', 'accounts.google.com']);
    $audNotValid = $idToken->get('aud') !== env('GOOGLE_CLIENT_ID');
    $expNotValid = time() > $idToken->get('exp');

    if ($issNotValid || $audNotValid || $expNotValid) {
        return redirect()->route('index')->withErrors(['id_token' => 'Ongeldige id token']);
    }
    // Voeg autorisatietoken toe en maak een nieuwe user aan, haal gegevens op d.m.v. de autorisatietoken
    $user = (new User)->updateOrCreate([
        'sub' => $idToken->get('sub')
    ], [
        'password' => str_random(32),
        'email' => $idToken->get('email'),
        'name' => $idToken->get('name'),
        'picture' => $idToken->get('picture')
    ]);

    Auth::login($user);

    return redirect()->route('index');
}
}
