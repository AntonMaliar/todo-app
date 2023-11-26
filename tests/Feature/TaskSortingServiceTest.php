<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Models\Util\Status;
use App\Services\TaskSortingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TaskSortingServiceTest extends TestCase {
    use RefreshDatabase;
    protected $taskSortingService;
    protected $user;

    public function setUp(): void {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->taskSortingService = new TaskSortingService();
        $this->actingAs($this->user);
    }
    //1
    public function testSortIfSortOptionDefault() {
        Session::put('sortOption', null);

        $task1 = Task::factory()->create([
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();
        
        $this->assertSame($task1->id, $result[0]->id);
        $this->assertSame($task2->id, $result[1]->id);
        $this->assertSame($task3->id, $result[2]->id);
    }
    //2
    public function testSortIfSortOptionCompletedAsc() {
        Session::put('sortOption', 'completed_asc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(2, $result);
        $this->assertSame($task2->id, $result[0]->id);
        $this->assertSame($task1->id, $result[1]->id);
    }
    //3
    public function testSortIfSortOptionCompletedDesc() {
        Session::put('sortOption', 'completed_desc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(2, $result);
        $this->assertSame($task1->id, $result[0]->id);
        $this->assertSame($task2->id, $result[1]->id);
    }
    //4 in_progress_asc
    public function testSortIfSortOptionInProgressAsc() {
        Session::put('sortOption', 'in_progress_asc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(2, $result);

        $this->assertSame($task2->id, $result[0]->id);
        $this->assertSame($task3->id, $result[1]->id);
    }
    //5 in_progress_desc
    public function testSortIfSortOptionInProgressDesc() {
        Session::put('sortOption', 'in_progress_desc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(2, $result);

        $this->assertSame($task3->id, $result[0]->id);
        $this->assertSame($task2->id, $result[1]->id);
    }
    //6 name_asc
    public function testSortIfSortOptionNameAsc() {
        Session::put('sortOption', 'name_asc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(3, $result);

        $this->assertSame($task2->id, $result[0]->id);
        $this->assertSame($task1->id, $result[1]->id);
        $this->assertSame($task3->id, $result[2]->id);
    }
    //7 name_desc
    public function testSortIfSortOptionNameDesc() {
        Session::put('sortOption', 'name_desc');

        $task1 = Task::factory()->create([
                'title'=>'b',
                'status'=>Status::COMPLETED,
                'user_id'=>$this->user->id]);

        $task2 = Task::factory()->create([
                'title'=>'a',
                'user_id'=>$this->user->id]);

        $task3 = Task::factory()->create([
                'title'=>'c',
                'user_id'=>$this->user->id]);

        $result = $this->taskSortingService->sort();

        $this->assertCount(3, $result);

        $this->assertSame($task3->id, $result[0]->id);
        $this->assertSame($task1->id, $result[1]->id);
        $this->assertSame($task2->id, $result[2]->id);
    }
    //8
    public function testPagination() {
        Task::factory()->count(11)->create(['user_id'=>$this->user->id]);
        
        $result1 = $this->taskSortingService->sort();
        Session::put('offset', 5);
        $result2 = $this->taskSortingService->sort();
        Session::put('offset', 10);
        $result3 = $this->taskSortingService->sort();
        Session::put('offset', 5);
        $result4 = $this->taskSortingService->sort();

        $this->assertCount(5, $result1);
        $this->assertCount(5, $result2);
        $this->assertCount(1, $result3);
        $this->assertCount(5, $result4);
    }

}
