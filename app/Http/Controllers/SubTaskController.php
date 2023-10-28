<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{
    public function addSubTask($taskId ,Request $request) {
        $subTasks = $request->input('sub-tasks');

        foreach($subTasks as $st) {
            $st->task_id = $taskId;
        }
        //add task id for each sub task
        //send batch of task to db
        SubTask::createMany($subTasks);
    }
}
