<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/create-task', function() {
    App::setLocale(Session::get('lang'));
    
    return view('create-task');
});

Route::post('/create-task', [TaskController::class, 'create']);

Route::get('/complete-task/{id}', [TaskController::class, 'complete']);
Route::get('/undo-complete-task/{id}', [TaskController::class, 'undoComplete']);

Route::get('/edit-task/{id}', [TaskController::class, 'edit']);
Route::put('/edit-task-put/{id}', [TaskController::class, 'editPut']);

Route::get('delete-task/{id}', [TaskController::class, 'delete']);

Route::get('/open-task/{id}', [TaskController::class, 'open']);

Route::get('/tasks/sort', [TaskController::class, 'setSortOption']);

Route::get('/tasks/search', [TaskController::class, 'search']);

Route::get('/forward', [TaskController::class, 'forward']);
Route::get('/back', [TaskController::class, 'back']);