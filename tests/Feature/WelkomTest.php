<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelkomTest extends TestCase
{
    // Test of de welkomstpagina bereikbaar is
    public function test_of_welkomstpagina_bereikbaar_is()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    // Test of welkomstpagina juist te zien is
    public function test_of_welkomstpagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/');
        $this->assertContains('panel-body', $response->getContent());
    }
}
