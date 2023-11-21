<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function create(Request $request) {
        User::find(auth()->id())
            ->tasks()
            ->save(new Task([
                'title' => $request->title,
                'description' => $request->description,
                'reminder' => $request->reminder,
            ]));

        return redirect('/profile');
    }

    public function complete($id) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);
        
        $task->update(['status' => Status::COMPLETED]);

        return redirect('/profile');
    }

    public function undoComplete($id) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);

        $task->update(['status' => Status::INPROGRESS]);

        return redirect('/profile');
    }

    public function edit($id) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);
        
        return view('edit-task', ['task' => $task]); 
    }

    public function editPut(int $id, Request $request) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'reminder' => $request->reminder,
            'notification_status' => false,
        ]);
        
        return redirect('/profile');
    }

    public function delete($id) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);

        $task->delete();

        return redirect('/profile');
    }

    public function open($id) {
        $task = Task::find($id);
        $this->authorize('authorize', $task);

        return view('task', ['task' => $task]);
    }

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
