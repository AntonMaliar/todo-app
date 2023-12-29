<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Util\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
        Session::put("currentCount", null);
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
        App::setLocale(Session::get('lang'));

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
        App::setLocale(Session::get('lang'));

        $task = Task::find($id);

        $this->authorize('authorize', $task);

        return view('task', ['task' => $task]);
    }

    public function setSortOption(Request $request) {
        Session::put('searchOption', null);

        if(Session::get('sortOption') != $request->input('sort_option')) {
            Session::put('offset', 0);
            Session::put('currentCount', 0);
        }

        Session::put('sortOption', $request->input('sort_option'));

        return redirect('/profile');
    }

    public function search(Request $request) {
        Session::put('sortOption', null);

        if(Session::get('searchOption') != $request->input('search_option')) {
            Session::put('offset', 0);
            Session::put('currentCount', 0);
        }

        Session::put('searchOption', $request->input('search_option'));

        return redirect('/profile');
    }

    public function forward() {
        $offset = session('offset');
        $currentCount = session('currentCount');

        if(($offset+5) <= $currentCount) {
            $offset+=5;
            session(['offset' => $offset]);
        }

        return redirect('/profile');
    }

    public function back() {
        $offset = session('offset');

        if($offset > 0) {
            $offset-=5;
            session(['offset' => $offset]);
        }

        return redirect('/profile');
    }

    public function reset() {
        Session::put('sortOption', null);
        Session::put('searchOption', null);
        Session::put("currentCount", null);

        return redirect('/profile');
    }
}
