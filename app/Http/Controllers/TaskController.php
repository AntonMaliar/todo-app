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

    public function sort(Request $request) {
        //get sort option
        $sortOption = $request->input('sort_option');
        $tasks = null;
        $user = auth()->user();
        $userId = $user->id;

        if($sortOption === 'completed_asc') {
            $tasks = $this->completedAsc($userId);
        }elseif($sortOption === 'completed_desc') {
            $tasks = $this->completedDesc($userId);
        }elseif($sortOption === 'in_progress_asc') {
            $tasks = $this->inProgressAsc($userId);
        }elseif($sortOption === 'in_progress_desc') {
            $tasks = $this->inProgressDesc($userId);
        }elseif($sortOption === 'name_asc') {
            $tasks = $this->nameAsc($userId);
        }elseif($sortOption === 'name_desc') {
            $tasks = $this->nameDesc($userId);
        }

        return view('profile', [
            'user' => $user,
            'tasks' => $tasks]);
    }
    

    private function completedAsc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('status', 'asc')
        ->orderBy('title', 'asc')
        ->get();
    }

    private function completedDesc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('status', 'asc')
        ->orderBy('title', 'desc')
        ->get();
    }

    private function inProgressAsc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('status', 'desc')
        ->orderBy('title', 'asc')
        ->get();
    }

    private function inProgressDesc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('status', 'desc')
        ->orderBy('title', 'desc')
        ->get();
    }

    private function nameAsc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('title', 'asc')
        ->get();
    }

    private function nameDesc($userId) {
        return Task::where('user_id', $userId)
        ->orderBy('title', 'desc')
        ->get();
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
}
