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

        $username = $request->username;
        //encrype password before store to DB
        $password = Hash::make($request->password);

        $user = new User();
        $user->name = $username;
        $user->password = $password;

        $user->save();

        return redirect('/');
    }

    private function userValidate($request) {
        $request->validate([
            'username' => 'unique:users,name'
        ]);
    }
}
