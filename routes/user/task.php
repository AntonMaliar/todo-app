<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/create-task','create-task')->middleware('auth');
Route::post('/create-task', [TaskController::class, 'create']);

Route::get('/complete-task/{id}', [TaskController::class, 'complete'])->middleware('auth');

Route::get('/edit-task/{id}', [TaskController::class, 'edit'])->middleware('auth');
Route::put('/edit-task-put/{id}', [TaskController::class, 'editPut']);

Route::get('delete-task/{id}', [TaskController::class, 'delete'])->middleware('auth');

Route::get('/open-task/{id}', [TaskController::class, 'open'])->middleware('auth');

Route::get('/tasks/sort', [TaskController::class, 'sort'])->middleware('auth');