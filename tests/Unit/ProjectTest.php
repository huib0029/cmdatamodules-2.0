<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    // Test of API data op kan halen
    public function test_of_projecten_api_data_op_kan_halen()
    {
        $response = $this->call('GET', '/api/search?q=4352522343542533');
        $this->assertContains('{"error":"Geen resultaten gevonden"}', $response->getContent());
    }
    // Negatieve test, test of de projecten API data op kan slaan (normaal gesproken niet)
    public function test_of_projecten_api_data_data_op_kan_slaan()
    {
        $response = $this->json('POST', '/api/search', [
            'name' => 'Test',
            'competenties' => 'Test',
            'projectgrootte' => 11,
            'leverancier' => 'Test'
        ]);
        $response
            ->assertStatus(405);
    }
    // Negatieve test, test of de projecten API data kan deleten (normaal gesproken niet)
    public function test_of_projecten_api_data_data_kan_deleten()
    {
        $response = $this->json('DELETE', '/api/search', [
            'objectID' => '7',
        ]);
        $response
            ->assertStatus(405);
    }
    // Negatieve test, test of de projecten API data kan updaten (normaal gesproken niet)
    public function test_of_projecten_api_data_data_kan_updaten()
    {
        $response = $this->json('PATCH', '/api/search', [
            'name' => 'Test',
            'competenties' => 'Test',
            'projectgrootte' => 11,
            'leverancier' => 'Test'],
            [   'name' => 'Test2',
                'competenties' => 'Test2',
                'projectgrootte' => 111,
                'leverancier' => 'Test2']);
        $response
            ->assertStatus(405);
    }
}
