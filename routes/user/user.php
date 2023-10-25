<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', function(){
    $user = auth()->user();
    return view('profile', ['user' => $user]);
})->middleware('auth');

Route::get('/edit-profile', function(){
    $user = auth()->user();
    return view('edit-profile', ['user' => $user]);
});

Route::put('/edit-profile', [UserController::class, 'edit']);