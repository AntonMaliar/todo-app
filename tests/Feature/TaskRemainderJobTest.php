<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskReminderNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TaskRemainderJobTest extends TestCase {
    

    public function testHandleIfTaskInNeededDiapason() {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'reminder' => now()->addMinutes(30)
        ]);

        Notification::fake();

        $this->artisan('schedule:run');

        Notification::assertSentTo([$user], TaskReminderNotification::class);

        $task->refresh();

        $this->assertTrue($task->notification_status);
    }

    public function testHandleIfTaskDeprecated()
    {
        
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'reminder' => now()->subMinutes(30)
        ]);

        Notification::fake();

        $this->artisan('schedule:run');

        Notification::assertNotSentTo([$user], TaskReminderNotification::class);

        $task->refresh();

        $this->assertFalse($task->notification_status);
    }

    public function testHandleIfTaskBiggerThenOneHour() {
        $user = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'reminder' => now()->addMinute(61)
        ]);

        Notification::fake();

        $this->artisan('schedule:run');
    
        Notification::assertNotSentTo([$user], TaskReminderNotification::class);

        $task->refresh();

        $this->assertFalse($task->notification_status);
    }
}
