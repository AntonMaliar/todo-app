<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    protected User $user;

    public function setUp(): void {
        parent::setUp();

        $this->user = new User([
            'name' => 'TestName',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->user->save();
    }

    public function tearDown(): void {
        if ($this->user) {
            $this->user->delete();
        }

        parent::tearDown();
    }

    public function testSuccessfulLogin() {
        $response = $this->post('/login', [
            'name' => 'TestName',
            'password' => 'password',
        ]);

        $response->assertRedirect('/profile');
        $this->assertTrue(Auth::check());
    }

    public function testFailedLogin() {
        $response = $this->post('/login', [
            'name' => 'invalidUsername',
            'password' => 'invalidPassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('loginError', 'You input incorrect username or password');
        $this->assertFalse(Auth::check());
    }

    public function testLogout() {
        $response = $this->get('/logout');
        $response ->assertRedirect('/');
        $this->assertFalse(Auth::check());
    }
}
