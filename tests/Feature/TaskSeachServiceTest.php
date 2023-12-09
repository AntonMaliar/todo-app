<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Services\TaskSearchService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskSeachServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $taskSearchService;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
        Task::factory()->create(['title'=>'hello','user_id'=>$this->user->id]);
        Task::factory()->create(['title'=>'world','user_id'=>$this->user->id]);
        Task::factory()->create(['title'=>'!!!','user_id'=>$this->user->id]);

        $this->taskSearchService = new TaskSearchService();
    }

    public function testSearch() {
        $result = $this->taskSearchService->search($this->user->id, 'o');

        $this->assertEquals(2, $result->count());
    }

    public function testSearchIfNoMatches() {
        $result = $this->taskSearchService->search($this->user->id, 'a');

        $this->assertEquals(0, $result->count());
    }
}
