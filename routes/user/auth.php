<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/login', function() {
    App::setLocale(Session::get('lang'));

    return view('log-in');
})->name('login')->withoutMiddleware('auth');

Route::get('/signup', function() {
    App::setLocale(Session::get('lang'));
    
    return view('sign-up');
})->withoutMiddleware('auth');

Route::post('/signup', [SignupController::class, 'signup'])->withoutMiddleware('auth');;
Route::post('/login', [LoginController::class, 'login'])->withoutMiddleware('auth');;
Route::get('/logout', [LoginController::class, 'logout'])->withoutMiddleware('auth');;
