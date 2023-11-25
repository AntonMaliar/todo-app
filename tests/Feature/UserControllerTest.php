<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase {
    use RefreshDatabase;

    public function testEditNewName() {
        $user = User::factory()->create([
            'name'=>'Jon',
            'email'=>'jon@email.com',
            'password'=>Hash::make('password')
        ]);
        $this->actingAs($user);

        $response = $this->put("/edit-profile", [
            'name'=>'newName',
            'email'=>'jon@email.com',
            'password'=>Hash::make('password')
        ]);

        $user->refresh();

        $this->assertEquals('newName', $user->name);
        $response->assertRedirect('/profile');
    }

    public function testEditNewEmail() {
        $user = User::factory()->create([
            'name'=>'Jon',
            'email'=>'jon@email.com',
            'password'=>Hash::make('password')
        ]);
        $this->actingAs($user);

        $response = $this->put("/edit-profile", [
            'name'=>'Jon',
            'email'=>'new@email.com',
            'password'=>Hash::make('password')
        ]);

        $user->refresh();

        $this->assertEquals('new@email.com', $user->email);
        $response->assertRedirect('/profile');
    }

    public function testEditNewPassword() {
        $user = User::factory()->create([
            'name'=>'Jon',
            'email'=>'jon@email.com',
            'password'=>Hash::make('password')
        ]);
        $this->actingAs($user);

        $response = $this->put("/edit-profile", [
            'name'=>'Jon',
            'email'=>'jon@email.com',
            'password'=>'12345'
        ]);

        $user->refresh();

        $this->assertTrue(Hash::check('12345', $user->password));
        $response->assertRedirect('/profile');
    }

    public function testProfile() {
        $user = User::factory()->create();
        $this->actingAs($user);
        $task = Task::factory()->create(['user_id' => $user->id]);
        $task2 = Task::factory()->create(['user_id' => $user->id]);
        

        $response = $this->get('/profile');

        $response->assertViewHas('user', $user);
        $response->assertViewHas('tasks', new Collection([$task, $task2]));
    }
}
