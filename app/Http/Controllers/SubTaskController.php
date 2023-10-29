<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\Util\Status;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function add(int $taskId, Request $request) {
        $subTasks = array_map(
            fn($subTasksDescription) => new SubTask(['description' => $subTasksDescription]),
            $request->input('sub_tasks')
        );

        $task = Task::find($taskId);
 
        $task->subTasks()->saveMany($subTasks);

        return redirect('/open-task/'.$taskId);
    }

    public function delete($taskId, $subTaskId) {
        SubTask::destroy($subTaskId);

        return redirect('/open-task/'.$taskId);
    }

    public function complete($taskId, $subTaskId) {
        $subTask = SubTask::find($subTaskId);
        $subTask->status = Status::COMPLETED;
        $subTask->save();

        return redirect('/open-task/'.$taskId);
    }
}
