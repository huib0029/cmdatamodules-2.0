<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // Migratie aanzetten om te schrijven naar de database
    use DatabaseMigrations;
    // Variabelen om her te gebruiken
    private static $TABLE_NAME = 'tasks';
    private static $ID1 = 1;


}
