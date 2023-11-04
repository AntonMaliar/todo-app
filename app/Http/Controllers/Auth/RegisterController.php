<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request) {
        //validate if such user exist in db
        $this->userValidate($request);

        $user = new User([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();

        return redirect('/');
    }

    private function userValidate($request) {
        $request->validate([
            'username' => 'unique:users,name'
        ]);
    }
}
