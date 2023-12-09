<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Models\Util\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TaskControllerTest extends TestCase {
    use RefreshDatabase;

    protected $user;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testCreateIfUserLogin() {
        $this->actingAs($this->user);
        $taskData = [
                'title' => 'some title',
                'description' => 'some description',
                'reminder' => null,
        ];

        $response = $this->post("/create-task", $taskData);

        $this->assertDatabaseHas('tasks', [
            'title' => 'some title',
            'description' => 'some description',
            'user_id' => $this->user->id
        ]);

        $response->assertRedirect("/profile");

    }

    public function testCreateIfUserNotLogin() {
        $taskData = [
                'title' => 'some title',
                'description' => 'some description',
                'reminder' => null,
        ];

        $response = $this->post("/create-task", $taskData);

        $this->assertDatabaseCount('tasks', 0);

        $response->assertRedirect("/login");
    }

    public function testCompleteIfUserLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/complete-task/{$task->id}");

        $task->refresh();

        $this->assertSame(Status::COMPLETED, $task->status);

        $response->assertRedirect("/profile");
    }

    public function testCompleteIfUserNotLogin() {
        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/complete-task/{$task->id}");

        $task->refresh();

        $this->assertNotEquals(Status::COMPLETED, $task->status);

        $response->assertRedirect('/login');
    }

    public function testCompleteIfUserNotAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create();

        $response = $this->get("/complete-task/{$task->id}");

        $task->refresh();

        $this->assertNotEquals(Status::COMPLETED, $task->status);

        $response->assertStatus(403);
    }

    public function testUndoCompleteIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'status' => Status::COMPLETED,
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/undo-complete-task/{$task->id}");

        $task->refresh();

        $this->assertEquals(Status::INPROGRESS, $task->status);
        $response->assertRedirect('/profile');
    }

    public function testUndoCompleteIfUserNotLogin() {
        $task = Task::factory()->create([
            'status' => Status::COMPLETED,
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/undo-complete-task/{$task->id}");

        $task->refresh();

        $this->assertNotEquals(Status::INPROGRESS, $task->status);
        $response->assertRedirect('/login');
    }

    public function testUndoCompleteIfUserNotAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create(['status' => Status::COMPLETED]);

        $response = $this->get("/undo-complete-task/{$task->id}");

        $task->refresh();

        $this->assertNotEquals(Status::INPROGRESS, $task->status);
        $response->assertStatus(403);
    }

    public function testEditIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/edit-task/{$task->id}");

        $response->assertViewHas('task', $task);
        $response->assertViewIs('edit-task');
    }

    public function testEditIfNotLogin() {
        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/edit-task/{$task->id}");

        $response->assertRedirect('/login');
    }

    public function testEditIfNotAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create();

        $response = $this->get("/edit-task/{$task->id}");

        $response->assertStatus(403);
    }

    public function testEditPutIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->put("/edit-task-put/{$task->id}", [
            'title' => 'newTitle',
            'description' => 'newDescription'
        ]);

        $task->refresh();

        $this->assertEquals('newTitle', $task->title);
        $this->assertEquals('newDescription', $task->description);
        $response->assertRedirect('/profile');
    }

    public function testEditPutIfNotLogin() {
        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->put("/edit-task-put/{$task->id}", [
            'title' => 'newTitle',
            'description' => 'newDescription'
        ]);

        $task->refresh();

        $this->assertNotEquals('newTitle', $task->title);
        $this->assertNotEquals('newDescription', $task->description);
        $response->assertRedirect('/login');
    }

    public function testEditPutIfNotAuthorized() {
        $this->actingAs($this->user);
        $task = Task::factory()->create();

        $response = $this->put("/edit-task-put/{$task->id}", [
            'title' => 'newTitle',
            'description' => 'newDescription'
        ]);

        $task->refresh();

        $this->assertNotEquals('newTitle', $task->title);
        $this->assertNotEquals('newDescription', $task->description);
        $response->assertStatus(403);
    }

    public function testDeleteIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("delete-task/{$task->id}");

        $this->assertDatabaseMissing('tasks', ['user_id' => $this->user->id]);
        $response->assertRedirect('/profile');
    }

    public function testDeleteIfNotLogin() {
        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("delete-task/{$task->id}");

        $this->assertDatabaseHas('tasks', ['user_id' => $this->user->id]);
        $response->assertRedirect('/login');
    }

    public function testDeleteIfNotAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create();

        $response = $this->get("delete-task/{$task->id}");

        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
        $response->assertStatus(403);
    }

    public function testOpenIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/open-task/{$task->id}");

        $response->assertViewHas('task', $task);
        $response->assertViewIs('task');
    }

    public function testOpenIfNotLogin() {
        $task = Task::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->get("/open-task/{$task->id}");

        $response->assertRedirect('/login');
    }

    public function testOpenIfNotAuthorized() {
        $this->actingAs($this->user);

        $task = Task::factory()->create();

        $response = $this->get("/open-task/{$task->id}");

        $response->assertStatus(403);
    }

    public function testSetSortOption() {
        $this->actingAs($this->user);

        $response = $this->get("/tasks/sort?sort_option=completed_asc");

        $response->assertRedirect('/profile');
        $this->assertEquals('completed_asc', session('sortOption'));
    }

    public function testSetSortOptionIfSearchOptionExist() {
        $this->actingAs($this->user);
        Session::put("searchOption", "some value");

        $response = $this->get("/tasks/sort?sort_option=completed_asc");

        $response->assertRedirect('/profile');
        $this->assertEquals('completed_asc', session('sortOption'));
        $this->assertNull(Session::get('searchOption'));
    }

    public function testSetSortOptionIfWeChangeSortOption() {
        $this->actingAs($this->user);
        $this->get("/tasks/sort?sort_option=completed_asc");
        Session::put('offset', 10);
        Session::put('currentCount', 5);

        $response = $this->get("/tasks/sort?sort_option=completed_desc");
        $response->assertRedirect('/profile');
        $this->assertEquals('completed_desc', session('sortOption'));
        $this->assertEquals(0, Session::get("offset"));
        $this->assertEquals(0, Session::get("currentCount"));
    }
    public function testSearchIfUserLogin() {
        $this->actingAs($this->user);

        $response = $this->get('/tasks/search?search_option=SomeValue');

        $response->assertRedirect('/profile');
        $this->assertEquals('SomeValue', Session::get('searchOption'));
    }

    public function testSearchIfSortOptionExist() {
        $this->actingAs($this->user);
        $this->get("/tasks/sort?sort_option=completed_desc");

        $response = $this->get('/tasks/search?search_option=SomeValue');
        $response->assertRedirect('/profile');
        $this->assertEquals('SomeValue', Session::get('searchOption'));
        $this->assertNull(Session::get('sortOption'));
    }

    public function testSearchIfSearchOptionChanged() {
        $this->actingAs($this->user);
        $this->get('/tasks/search?search_option=SomeValue');
        Session::put('offset', 10);
        Session::put('currentCount', 20);

        $response = $this->get('/tasks/search?search_option=SomeValue2');
        $response->assertRedirect('/profile');
        $this->assertEquals('SomeValue2', Session::get('searchOption'));
        $this->assertEquals(0, Session::get('offset'));
        $this->assertEquals(0, Session::get('currentCount'));
    }

    public function testSearchIfUserNotLogin() {
        $response = $this->get("/tasks/search?search_option=someValue");

        $response->assertRedirect('/login');
    }

    public function testForward() {
        Session::put('currentCount', 15);
        $this->actingAs($this->user);

        $this->get('/forward');
        $this->assertEquals(5, Session::get('offset'));

        $this->get('/forward');
        $this->assertEquals(10, Session::get('offset'));

        $this->get('/forward');
        $this->assertEquals(15, Session::get('offset'));


        //bigger then currentCount
        $this->get('/forward');
        $this->assertNotEquals(20, Session::get('offset'));

        $this->get('/forward');
        $this->assertEquals(15, Session::get('offset'));
    }


    public static function testBackProvider(): array {
        return [
            [20, 2, 10],
            [20, 4, 0],
            [15, 4, 0],
            [0, 1, 0],
        ];
    }

    #[DataProvider('testBackProvider')]
    public function testBack($offset, $requestCount, $resultCount) {
        $this->actingAs($this->user);
        session(['offset'=>$offset]);

        while($requestCount > 0) {
            $this->get('/back');
            $requestCount--;
        }

        $this->assertEquals($resultCount, session('offset'));
    }
}
