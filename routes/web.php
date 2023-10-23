<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::view('/', 'welcome');

Route::view('/log-in', 'log-in')->name('login');

Route::view('/sign-up', 'sign-up');

//after login must redirect to profile user must be saved in session
Route::get('/profile/{id}', function(){
    // Get the authenticated user
    $user = auth()->user(); // This will get the currently authenticated user
    return view('profile', ['user' => $user]);
})->middleware('auth');

Route::post('/sign-up', [RegisterController::class, 'register']);

Route::post('/log-in', [LoginController::class, 'login']);