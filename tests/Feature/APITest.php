<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // Test of de API pagina bereikbaar is
    public function test_of_apipagina_bereikbaar_is()
    {
        $response = $this->get('/api');
        $response->assertStatus(200);
    }
    // Test of de opleidingsvarianten van de API pagina juist te zien is
    public function test_of_de_opleidingsvarianten_apipagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/api');
        $this->assertContains('Genereer opleidingsvarianten', $response->getContent());
    }
    // Test of de crohos van de API pagina juist te zien is
    public function test_of_de_crohos_apipagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/api');
        $this->assertContains('Genereer Crohos', $response->getContent());
    }
}
