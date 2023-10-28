<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'../auth/auth.php';
require __DIR__.'../user/user.php';
require __DIR__.'../user/task.php';

Route::get('/', function() {
    if(Auth::check()) {
        return redirect('/profile');
    }else {
        return view('welcome');
    }
});

