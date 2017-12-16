<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    public function test_of_user_aangemaakt_kan_worden()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'id'    => 1,
            'sub' => $user->sub,
            'email' => $user->email,
            'name' => $user->name,
            'picture' => $user->picture,
            'password' => $user->password,
            'remember_token' => $user->remember_token
        ]);
    }
}
