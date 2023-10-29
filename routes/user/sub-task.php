<?php

use App\Http\Controllers\SubTaskController;
use Illuminate\Support\Facades\Route;

Route::post('/add-sub-task/{taskId}', [SubTaskController::class, 'addSubTask']);

