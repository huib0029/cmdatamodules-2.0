<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    // Refreshdata aanzetten om steeds de database te refreshen na gebruik
    use DatabaseMigrations;
    // Variabelen om her te gebruiken
    private static $TABLE_NAME = 'tasks';
    private static $ID1 = 1;

    public function test_of_task_aangemaakt_kan_worden()
    {
        // Maak user aan d.m.v. de factory (factories/TaskFactory)
        $task = factory(Task::class)->create();
        // Check of er een Task aangemaakt is met de volgende variabelen van de faker uit de factory:
        $this->assertDatabaseHas($this::$TABLE_NAME, [
            'id'    => $this::$ID1,
            'user_id' => $task->user_id,
            'name' => $task->name,
            'description' => $task->description,
        ]);
    }
    // delete gebeurd na iedere functie automatisch tenzij handmatig uit gezet (use Refreshdatabase), toch belangrijk om te testen
    public function test_of_task_verwijdert_kan_worden()
    {
        // test of de database tabel
        $this->assertDatabaseMissing($this::$TABLE_NAME, [
            'id' => $this::$ID1,
        ]);
    }
    // Negatieve test, kijk of er zonder een inlog de task pagina te bereiken is
    public function test_of_task_zonder_inlog_te_bereiken_is()
    {
        Auth::logout();
        $response = $this->call('GET', '/tasks');
        $this->assertContains('Je moet inloggen om de pagina te kunnen bekijken', $response->getContent());
    }
    // Maak een taak d.m.v. een gebruiker
    public function test_of_een_taak_gemaakt_kan_worden()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('POST', '/task', [
            'name' => 'Test',
            'description' => 'Test',
            'user_id' => $this::$ID1,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Success',
            ]);
    }
}
