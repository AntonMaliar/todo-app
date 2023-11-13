<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignupControllerTest extends TestCase {
    use RefreshDatabase;

    public function testSuccessfulSignup() {
        $userData = [
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password' => 'testPassword',
        ];

        $response = $this->get('/signup');
        $response = $this->post('/signup', $userData);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', ['name' => 'TestUser', 'email' => 'test@example.com']);
    }
    public function testSignupWithExistingUser() {
        $existingUser = User::factory()->create();
        $newUserData = [
            'name' => $existingUser->name,
            'email' => $existingUser->email,
            'password' => 'password123',
        ];
        
        $response = $this->get('/signup');
        $response = $this->post('/signup', $newUserData);

        $response->assertRedirect('/signup');
        $response->assertSessionHasErrors(['name', 'email']);
        $this->assertDatabaseCount('users', 1);
    }
}
