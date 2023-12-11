<?php

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
require __DIR__ . '/user/auth.php';
require __DIR__ . '/user/user.php';
require __DIR__ . '/user/task.php';
require __DIR__ . '/user/sub-task.php';

Route::get('/', function() {
    App::setLocale(Session::get('lang'));

    if(Auth::check()) {
        return redirect('/profile');
    }else {
        return view('welcome');
    }
})->withoutMiddleware('auth');

Route::get('/lang', function(Request $request){
    $lang = $request->query('lang');
    Session::put('lang', $lang);
   
    return redirect()->back();
})->withoutMiddleware('auth');