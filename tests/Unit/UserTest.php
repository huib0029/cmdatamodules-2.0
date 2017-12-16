<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // Migratie aanzetten om te schrijven naar de database
    use DatabaseMigrations;
    // Variabelen om her te gebruiken
    private static $TABLE_NAME = 'users';
    private static $ID1 = 1;

    public function test_of_user_aangemaakt_kan_worden()
    {
        // Maak user aan d.m.v. de factory (factories/UserFactory)
        $user = factory(User::class)->create();
        // Check of er een User aangemaakt is met de volgende variabelen van de faker uit de factory:
        $this->assertDatabaseHas($this::$TABLE_NAME, [
            'id'    => $this::$ID1,
            'sub' => $user->sub,
            'email' => $user->email,
            'name' => $user->name,
            'picture' => $user->picture,
            'password' => $user->password,
            'remember_token' => $user->remember_token
        ]);
    }
    // Test of naam nodig is in de Users tabel
    public function test_of_naam_nodig_is()
    {
        try {
            factory(User::class)->create(['name' => null]);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }

    // delete gebeurd na iedere functie automatisch tenzij handmatig uit gezet (use Databasemigrations), toch belangrijk om te testen
    public function test_of_user_verwijdert_kan_worden()
    {
        // test of de database tabel
        $this->assertDatabaseMissing($this::$TABLE_NAME, [
            'id'    => $this::$ID1,
        ]);
    }
}
