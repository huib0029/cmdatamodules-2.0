<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    // Refreshdata aanzetten om steeds de database te refreshen na gebruik
    use DatabaseMigrations;
    // Variabelen om her te gebruiken
    private static $TABLE_NAME = 'tasks';
    private static $ID1 = 1;

    public function test_of_task_aangemaakt_kan_worden_database()
    {
        // Maak user aan d.m.v. de factory (factories/TaskFactory)
        $task = factory(Task::class)->create();
        // Check of er een Task aangemaakt is met de volgende variabelen van de faker uit de factory:
        $this->assertDatabaseHas($this::$TABLE_NAME, [
            'id' => $this::$ID1,
            'user_id' => $task->user_id,
            'name' => $task->name,
            'description' => $task->description,
        ]);
    }

    // delete gebeurd na iedere functie automatisch tenzij handmatig uit gezet (use Refreshdatabase), toch belangrijk om te testen
    public function test_of_task_verwijderd_kan_worden_database()
    {
        // test of de database tabel
        $this->assertDatabaseMissing($this::$TABLE_NAME, [
            'id' => $this::$ID1,
        ]);
    }

    // Negatieve test, test of er zonder een inlog een taak aangemaakt kan worden
    public function test_of_zonder_inlog_geen_taak_te_maken_is()
    {
        $response = $this->json('POST', '/task', [
            'name' => 'Test',
            'description' => 'Test',
            'user_id' => $this::$ID1,
        ]);

        $response
            ->assertStatus(401);
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

    // Kijk of een taak gewijzigd kan worden
    public function test_of_een_taak_gewijzigd_kan_worden()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->json('POST', '/task', [
            'name' => 'Test',
            'description' => 'Test',
            'user_id' => $this::$ID1,
        ]);

        $response = $this->json('PATCH', '/task/1', [
            'name' => 'Test2',
            'description' => 'Test2',
            'user_id' => $this::$ID1,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Task updated successfully!',
            ]);
    }

    // Kijk of een taak verwijderd kan worden
    public function test_of_een_taak_verwijderd_kan_worden()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->json('POST', '/task', [
            'name' => 'Test',
            'description' => 'Test',
            'user_id' => $this::$ID1,
        ]);

        $response = $this->json('DELETE', '/task/1', [
            'name' => 'Test2',
            'description' => 'Test2',
            'user_id' => $this::$ID1,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Task deleted successfully!',
            ]);
    }
}
