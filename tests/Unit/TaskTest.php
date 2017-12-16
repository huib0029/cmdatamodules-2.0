<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
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
}
