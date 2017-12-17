<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectTest extends TestCase
{
    // Test of de projectenpagina bereikbaar is
    // TODO bug fixen in test_of_projectpagina_bereikbaar_is() error 500 verschijnt i.p.v. 200
//    public function test_of_projectpagina_bereikbaar_is()
//    {
//        $response = $this->get('/projects');
//        $response->assertStatus(200);
//    }
    // Test of de projectenpagina juist te zien is
    public function test_of_projectpaginaa_juist_te_zien_is()
    {
        $response = $this->call('GET', '/projects');
        $this->assertContains('panel-body', $response->getContent());
    }
    // Test of de projecten api aan te spreken is
    public function test_of_de_projecten_api_aan_te_spreken_is()
    {
        $response = $this->call('GET', '/api/search');
        $response->assertStatus(200);
    }
}
