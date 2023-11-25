<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskSortingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $taskSortingService;

    public function __construct(TaskSortingService $taskSortingService)
    {
        $this->taskSortingService = $taskSortingService;
    }

    public function edit(Request $request) {
        $user = User::find(auth()->id());

        $user->name = $request->name;
        $user->email = $request->email;
        
        if($user->password !== $request->password) {
            $user->password = Hash::make($request->password);
        }
 
        $user->save();
        return redirect('/profile');
    }

    public function profile() {
        $user = auth()->user();
        $tasks = $this->taskSortingService->sort();
    
        return view('profile', [
            'user' => $user,
            'tasks' => $tasks
        ]);
    }

}
