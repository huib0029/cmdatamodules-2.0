<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    // Test of takenpagina bereikbaar is
    public function test_of_takenpagina_bereikbaar_is()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }
    // Negatieve test, kijk of er zonder een inlog de task pagina te bereiken is
    public function test_of_task_zonder_inlog_te_bereiken_is()
    {
        $response = $this->call('GET', '/tasks');
        $this->assertContains('Je moet inloggen om de pagina te kunnen bekijken', $response->getContent());
    }
}
