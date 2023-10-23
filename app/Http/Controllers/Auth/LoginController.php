<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        if(Auth::attempt([
            'name'=>$username,
            'password'=>$password])) {
            //get user id from session
            $userId = auth()->id();
            return redirect('/profile/'.$userId);
        }else {
            
            return back()->with('loginError', 'You input incorrect username or password');
        }
    }
}
