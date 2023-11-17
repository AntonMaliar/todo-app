<?php

namespace Tests\Feature;

use App\Models\SubTask;
use App\Models\Task;
use App\Models\User;
use App\Models\Util\Status;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SubTaskControllerTest extends TestCase {
    use RefreshDatabase;

    protected $user;
    protected $task;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->task = Task::factory()->create(['user_id' => $this->user->id]);
    }

    public function testAddIfLoginAndAuthorized() {
       
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1', 'SubTask 2', 'SubTask 3'],
        ];

        $response = $this->post("/add-sub-task/{$this->task->id}", $subTasksData);

        foreach ($subTasksData['sub_tasks'] as $description) {
            $this->assertDatabaseHas('sub_tasks', [
                'task_id' => $this->task->id,
                'description' => $description,
            ]);
        }

        $this->assertDatabaseCount('sub_tasks', 3);

        $response->assertRedirect("/open-task/{$this->task->id}");
    }

    public function testAddIfUserNotLogin() {
        $subTasksData = [
            'sub_tasks' => ['SubTask 1', 'SubTask 2', 'SubTask 3'],
        ];

        $response = $this->post("/add-sub-task/{$this->task->id}", $subTasksData);
        $this->assertDatabaseCount('sub_tasks', 0);
        $response->assertRedirect("/login");
    }

    public function testAddIfUserNotAuthorized() {
        $user2 = User::factory()->create();
        $this->actingAs($user2);
        
        $response = $this->post(
            "/add-sub-task/{$this->task->id}",
            ['sub_tasks'=>'sub task 1']);
        
        $this->assertDatabaseCount('sub_tasks', 0);
        $response->assertStatus(403);
    } 

    public function testDeleteIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1', 'SubTask 2', 'SubTask 3'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);

        $subTask = SubTask::where('description', 'SubTask 1')->first();
    
        $response = $this->get("/delete-sub-task/{$this->task->id}/{$subTask->id}");
        
        $this->assertDatabaseCount('sub_tasks', 2);

        $this->assertDatabaseMissing('sub_tasks', [
            'description' => 'SubTask 1',
        ]);

        $response->assertRedirect("/open-task/{$this->task->id}");
    }

    public function testDeleteIfUserNotLogin() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1', 'SubTask 2', 'SubTask 3'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);
        
        Auth::logout();

        $subTask = SubTask::where('description', 'SubTask 1')->first();
    
        $response = $this->get("/delete-sub-task/{$this->task->id}/{$subTask->id}");
        
        $this->assertDatabaseCount('sub_tasks', 3);

        $response->assertRedirect("/login");
    }

    public function testDeleteIfUserNotAuthorized() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1', 'SubTask 2', 'SubTask 3'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);
        
        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $subTask = SubTask::where('description', 'SubTask 1')->first();
    
        $response = $this->get("/delete-sub-task/{$this->task->id}/{$subTask->id}");
        
        $this->assertDatabaseCount('sub_tasks', 3);

        $response->assertStatus(403);
    }
    
    public function testCompleteIfLoginAndAuthorized() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);

        $subTask = SubTask::where('description', 'SubTask 1')->first();
    
        $response = $this->get("/complete-sub-task/{$this->task->id}/{$subTask->id}");

        $subTask = SubTask::where('description', 'SubTask 1')->first();

        $this->assertSame(Status::COMPLETED, $subTask->status);

        $response->assertRedirect("/open-task/{$this->task->id}");
    }

    public function testCompleteIfUserNotLogin() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);

        $subTask = SubTask::where('description', 'SubTask 1')->first();
        
        Auth::logout();

        $response = $this->get("/complete-sub-task/{$this->task->id}/{$subTask->id}");

        $subTask = SubTask::where('description', 'SubTask 1')->first();

        $this->assertSame(Status::INPROGRESS, $subTask->status);

        $response->assertRedirect("/login");
    } 

    public function testCompleteIfUserNotAuthorized() {
        $this->actingAs($this->user);

        $subTasksData = [
            'sub_tasks' => ['SubTask 1'],
        ];

        $this->post("/add-sub-task/{$this->task->id}", $subTasksData);

        $user2 = User::factory()->create();
        $this->actingAs($user2);

        $subTask = SubTask::where('description', 'SubTask 1')->first();

        $response = $this->get("/complete-sub-task/{$this->task->id}/{$subTask->id}");

        $subTask = SubTask::where('description', 'SubTask 1')->first();

        $this->assertSame(Status::INPROGRESS, $subTask->status);

        $response->assertStatus(403);
    }

}
