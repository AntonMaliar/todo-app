<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/log-in', 'log-in')->name('login');
Route::view('/sign-up', 'sign-up');
Route::post('/sign-up', [RegisterController::class, 'register']);
Route::post('/log-in', [LoginController::class, 'login']);