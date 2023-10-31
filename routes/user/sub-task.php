<?php

use App\Http\Controllers\SubTaskController;
use App\Models\SubTask;
use Illuminate\Support\Facades\Route;

Route::post('/add-sub-task/{taskId}', [SubTaskController::class, 'add']);

Route::get('/delete-sub-task/{taskId}/{subTaskId}', [SubTaskController::class, 'delete'])
->middleware('auth');

Route::get('/complete-sub-task/{taskId}/{subTaskId}', [SubTaskController::class, 'complete'])
->middleware('auth');

