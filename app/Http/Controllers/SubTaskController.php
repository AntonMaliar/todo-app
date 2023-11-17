<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubTaskController extends Controller
{
    public function add($taskId, Request $request) {
        $task = Task::find($taskId);
        $this->authorize('authorize', $task);

        $subTasks = array_map(
            fn($subTasksDescription) => new SubTask(['description' => $subTasksDescription]),
            $request->input('sub_tasks')
        );

        $task = Task::find($taskId);
        $task->subTasks()->saveMany($subTasks);

        return redirect('/open-task/'.$taskId);
    }

    public function delete($taskId, $subTaskId) {
        $task = Task::find($taskId);
        $this->authorize('authorize', $task);

        SubTask::destroy($subTaskId);

        return redirect('/open-task/'.$taskId);
    }

    public function complete($taskId, $subTaskId) {
        $task = Task::find($taskId);
        $this->authorize('authorize', $task);

        $subTask = SubTask::find($subTaskId);
        $subTask->status = Status::COMPLETED;
        $subTask->save();

        return redirect('/open-task/'.$taskId);
    }
}
