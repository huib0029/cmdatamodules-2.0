<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\json_decode;
use InvalidArgumentException;
use Jose\Factory\JWKFactory;
use Jose\Loader;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function openlogin(): View
{
    if (!session()->has('openid.state')) {
        session()->put('openid.state', str_random(32));
    }

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

    return view('auth.openidconnect')->with(['link' => $link]);
}

public function callback(Request $request)
{
    if ($request->input('state') !== session('openid.state')) {
        return redirect()->route('index')->withErrors(['state' => 'De waarde van de parameter state is ongeldig.']);
    }

    // The Discovery document for Google's OpenID Connect.
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

    $tokens = json_decode($response->getBody());

    $expiresAt = Carbon::now()->addMinutes(10);
    $jwks = Cache::remember('google.jwks', $expiresAt, function () use ($client, $discoveryDocument) {
        $jwk_set = JWKFactory::createFromJKU($discoveryDocument->jwks_uri);

        return $jwk_set;
    });

    $loader = new Loader();
    $signature_index = null;

    try {
        $jws = $loader->loadAndVerifySignatureUsingKeySet(
            $tokens->id_token,
            $jwks,
            ['RS256'],
            $signature_index
        );
    } catch (InvalidArgumentException $exception) {
        return redirect()->route('index')->withErrors(['id_token' => 'Ongeldige id token']);
    }

    $idToken = collect($jws->getPayload());
    $issNotValid = !in_array($idToken->get('iss'), ['https://accounts.google.com', 'accounts.google.com']);
    $audNotValid = $idToken->get('aud') !== env('GOOGLE_CLIENT_ID');
    $expNotValid = time() > $idToken->get('exp');

    if ($issNotValid || $audNotValid || $expNotValid) {
        return redirect()->route('index')->withErrors(['id_token' => 'Ongeldige id token']);
    }

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
