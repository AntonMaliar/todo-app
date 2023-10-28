<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/create-task','create-task');
Route::post('/create-task', [TaskController::class, 'create']);

Route::get('/complete-task/{id}', [TaskController::class, 'complete']);

Route::get('/edit-task/{id}', [TaskController::class, 'edit']);
Route::put('/edit-task-put/{id}', [TaskController::class, 'editPut']);

Route::get('delete-task/{id}', [TaskController::class, 'delete']);

Route::get('/open-task/{id}', [TaskController::class, 'open']);