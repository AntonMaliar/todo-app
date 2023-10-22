<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        if(Auth::attempt([
            'name'=>$username,
            'password'=>$password])) {
            //get user and pass it to view (or get user from session)
            
            //$user = User::where('column_name', $username)->first();

            return view('profile', ['username'=> $username]);
        }else {
            
            return back()->with('loginError', 'You input incorrect username or password');
        }
    }
}
