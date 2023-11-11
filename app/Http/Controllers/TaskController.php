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
        $task->reminder = $request->reminder;
        $task->save();

        return redirect('/profile');
    }

    public function complete(int $id) {
        $task = Task::find($id);
        $task->status = Status::COMPLETED;
        $task->save();

        return redirect('/profile');
    }

    public function undoComplete($id) {
        $task = Task::find($id);
        $task->status = Status::INPROGRESS;
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
        $task->reminder = $request->reminder;
        $task->notification_status = false;
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

    //set sort option to session
    public function setSortOption(Request $request) {
        session(['sortOption' => $request->input('sort_option')]);

        return redirect('/profile');
    }

    public function search(Request $request) {
        $searchOption = $request->input('search_option');
        $user = auth()->user();


        $tasks = Task::where('user_id', $user->id)
        ->where('title', 'ilike', '%'.$searchOption.'%')
        ->get();

        return view('profile', [
            'user' => $user,
            'tasks' => $tasks
        ]);
    }

    public function forward() {
        $offset = session('offset');

        if($offset) {
            $offset+=5;
            session(['offset' => $offset]);
        }else {
            session(['offset' => 5]);
        }

        return redirect('/profile');
    }

    public function back() {
        $offset = session('offset');

        if($offset && $offset > 0) {
            $offset-=5;
            session(['offset' => $offset]);
        }

        return redirect('/profile');
    }
}
