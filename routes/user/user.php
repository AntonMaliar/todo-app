<?php

use App\Http\Controllers\UserController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [UserController::class, 'profile']);

Route::get('/edit-profile', function(){
    $user = auth()->user();
    return view('edit-profile', ['user' => $user]);
});

Route::put('/edit-profile', [UserController::class, 'edit']);