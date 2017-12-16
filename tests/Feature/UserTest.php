<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{

    // Test of loginpagina bereikbaar is
    public function test_of_loginpagina_bereikbaar_is()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    // Test of loginpagina juist te zien is
    public function test_of_loginpagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/login');
        $this->assertContains('Login', $response->getContent());
    }
    // Test of registreer pagina bereikbaar is
    public function test_of_registreer_pagina_bereikbaar_is()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    // Test of registreer pagina juist te zien is
    public function test_of_registreer_pagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/register');
        $this->assertContains('Registeren', $response->getContent());
    }
    // Test of de reset pagina bereikbaar is
    public function test_of_reset_pagina_bereikbaar_is()
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
    }
    // Test of reset pagina juist te zien is
    public function test_of_reset_pagina_juist_te_zien_is()
    {
        $response = $this->call('GET', '/password/reset');
        $this->assertContains('Reset Password', $response->getContent());
    }
}
