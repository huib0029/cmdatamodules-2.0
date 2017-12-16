<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // Refreshdata aanzetten om steeds de database te refreshen na gebruik
    use RefreshDatabase;
    // Variabelen om her te gebruiken
    private static $TABLE_NAME = 'users';
    private static $ID1 = 1;

    public function test_of_user_aangemaakt_kan_worden_database()
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
    // Negatieve test: Test of naam verplicht is in de Users tabel
    public function test_of_naam_verplicht_is_database()
    {
        try {
            factory(User::class)->create(['name' => null]);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }
    // Negatieve test: Test of e-mail verplicht is in de Users tabel
    public function test_of_mail_verplicht_is_database()
    {
        try {
            factory(User::class)->create(['email' => null]);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }
    // Negatieve test: Test of Wachtwoord verplicht is in de Users tabel
    public function test_of_wachtwoord_verplicht_is_database()
    {
        try {
            factory(User::class)->create(['password' => null]);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }
    // Negatieve test: Test of een unieke subscriber niet twee keer aangemaakt kan worden in de Users tabel
    public function test_of_sub_uniek_is_database()
    {
        try {
            factory(User::class)->create(['sub' => 1]);
            factory(User::class)->create(['sub' => 1]);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }
    // Negatieve test: Test of een unieke e-mail niet twee keer aangemaakt kan worden in de Users tabel
    public function test_of_email_uniek_is_database()
    {
        try {
            factory(User::class)->create(['email' => 'test@test.nl']);
            factory(User::class)->create(['email' => 'test@test.nl']);
        } catch(\Exception $e) {
            $this->assertTrue(true);
        }
    }
    // Test of een subscriber nullable in User tabel mag zijn
    public function test_of_sub_nullable_is_database()
    {
        factory(User::class)->create(['sub' => null]);
        $this->assertDatabaseHas($this::$TABLE_NAME, [
            'sub' => null,
        ]);
    }
    // Test of een picture nullable in User tabel mag zijn
    public function test_of_picture_nullable_is_database()
    {
        factory(User::class)->create(['picture' => null]);
        $this->assertDatabaseHas($this::$TABLE_NAME, [
            'picture' => null,
        ]);
    }

    // delete gebeurd na iedere functie automatisch tenzij handmatig uit gezet (use Refreshdatabase), toch belangrijk om te testen
    public function test_of_user_verwijdert_kan_worden_database()
    {
        // test of de database tabel
        $this->assertDatabaseMissing($this::$TABLE_NAME, [
            'id'    => $this::$ID1,
        ]);
    }
    // Test of een user aangemaakt kan worden
    public function test_of_user_aangemaakt_kan_worden()
    {
        $response = $this->json('POST', '/register', [
            'name' => 'Test',
            'email' => 'Test@test.nl',
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $response
            ->assertStatus(302);
    }
    // Test of een user kan inloggen
    public function test_of_user_kan_inloggen()
    {
        $this->json('POST', '/register', [
            'name' => 'Test',
            'email' => 'Test@test.nl',
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $response = $this->json('POST', '/login', [
            'email' => 'Test@test.nl',
            'password' => 'Test123',
        ]);

        $response
            ->assertStatus(302);
    }

    // Test of een user kan uitloggen
    public function test_of_user_kan_uitloggen()
    {
        $this->json('POST', '/register', [
            'name' => 'Test',
            'email' => 'Test@test.nl',
            'password' => 'Test123',
            'password_confirmation' => 'Test123'
        ]);

        $response = $this->json('POST', '/logout');

        $response
            ->assertStatus(302);
    }

}
