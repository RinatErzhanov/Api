<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/tasks', [TasksController::class, 'index']);
Route::get('/tasks/{id}', [TasksController::class, 'show']);
Route::middleware('api')->post('tasks', [TasksController::class, 'store']);
Route::middleware('api')->put('/tasks/{id}', [TasksController::class, 'update']);
Route::middleware('api')->delete('/tasks/{id}', [TasksController::class, 'destroy']);

Route::middleware('api')->post('/login/', [AuthController::class, 'login']);
Route::middleware('api')->get('/me/', [AuthController::class, 'me']);

