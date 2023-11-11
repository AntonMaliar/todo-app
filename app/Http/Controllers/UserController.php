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

    public function edit(Request $request) {
        $user = User::find(auth()->id());

        $user->name = $request->username;
        $user->email-> $request->email;
        
        if($user->password !== $request->password) {
            $user->password = Hash::make($request->password);
        }
 
        $user->save();
        return redirect('/profile');
    }

    public function profile() {
        $user = auth()->user();
        $tasks = TaskSortingService::sort();
    
        return view('profile', [
        'user' => $user,
        'tasks' => $tasks
        ]);
    }

}
