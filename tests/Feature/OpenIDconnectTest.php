<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OpenIDconnectTest extends TestCase
{
    // Test of de OpenIDconnect pagina bereikbaar is
    public function test_of_openidconnectpagina_bereikbaar_is()
    {
        $response = $this->get('/openidconnect');
        $response->assertStatus(200);
    }
    // Test of OpenIDconnect pagina juist te zien is
    public function test_of_openidconnectpagin_juist_te_zien_is()
    {
        $response = $this->call('GET', '/openidconnect');
        $this->assertContains('Selecteer provider:', $response->getContent());
    }
    // Test of OpenIDconnect api een sessie genereert
    public function test_of_openidconnectpagin_een_oauth_sessie_genereert()
    {
        $response = $this->call('GET', '/openidconnect');
        $this->assertContains('https://accounts.google.com/o/oauth2/v2/auth', $response->getContent());
    }
}
