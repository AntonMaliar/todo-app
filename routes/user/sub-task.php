<?php

use Illuminate\Support\Facades\Route;

Route::post('/add-sub-task/{id}', [SubTaskController::class, 'addSubTask']);