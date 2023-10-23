<?php

use Illuminate\Support\Facades\Route;

Route::get('/profile/{id}', function(){
    $user = auth()->user();
    return view('profile', ['user' => $user]);
})->middleware('auth');