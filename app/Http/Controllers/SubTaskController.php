<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubTaskController extends Controller
{
    public function addSubTask(int $taskId, Request $request) {
        $subTasks = array_map(
            fn($subTasksDescription) => new SubTask(['description' => $subTasksDescription]),
            $request->input('sub_tasks')
        );

        $task = Task::find($taskId);
 
        $task->subTasks()->saveMany($subTasks);

        return redirect('/open-task/'.$taskId);
    }

    public function deleteSubTask($taskId, $subTaskId) {
        SubTask::destroy($subTaskId);

        return redirect('/open-task/'.$taskId);
    }
}
