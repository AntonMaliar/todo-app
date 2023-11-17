<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'log-in')->name('login')->withoutMiddleware('auth');
Route::view('/signup', 'sign-up')->withoutMiddleware('auth');
Route::post('/signup', [SignupController::class, 'signup'])->withoutMiddleware('auth');;
Route::post('/login', [LoginController::class, 'login'])->withoutMiddleware('auth');;
Route::get('/logout', [LoginController::class, 'logout'])->withoutMiddleware('auth');;
