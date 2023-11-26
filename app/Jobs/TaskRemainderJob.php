<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TaskRemainderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void {
        $tasks = Task::where('reminder', '>', now())
                 ->where('reminder', '<=', now()->addHours(1))
                 ->where('notification_status', false)
                 ->get();


        foreach ($tasks as $task) {
            $task->notification_status = true;
            $task->save();

            $user = User::find($task->user_id);
            $user->notify(new TaskReminderNotification($task));
        }
    }

}
