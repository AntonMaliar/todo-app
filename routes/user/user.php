<?php

use App\Http\Controllers\UserController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/profile', [UserController::class, 'profile']);

Route::get('/edit-profile', function(){
    App::setLocale(Session::get('lang'));

    $user = auth()->user();

    return view('edit-profile', ['user' => $user]);
});

Route::put('/edit-profile', [UserController::class, 'edit']);