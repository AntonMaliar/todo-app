<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function create(Request $request) {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = auth()->id();
        $task->save();

        return redirect('/profile');
    }

    public function complete(int $id) {
        $task = Task::find($id);
        $task->status = Status::COMPLETED;
        $task->save();

        return redirect('/profile');
    }

    public function edit(int $id) {
        $task = Task::find($id);
        
        return view('edit-task', ['task' => $task]); 
    }

    public function editPut(int $id, Request $request) {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return redirect('/profile');
    }

    public function delete($id) {
        Task::destroy($id);

        return redirect('/profile');
    }

    public function open($id) {
        $task = Task::find($id);

        return view('task', ['task' => $task]);
    }
}
