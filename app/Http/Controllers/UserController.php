<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
