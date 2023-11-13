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
        $name = $request->name;
        $password = $request->password;

        if(Auth::attempt([
            'name'=>$name,
            'password'=>$password])) {

            return redirect('/profile');
        }else {

            return redirect('/login')
            ->with('loginError', 'You input incorrect username or password');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
    }
}
