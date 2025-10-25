<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;



Route::get('/', function () {
    return response()->json(['message' => 'API is working']);
});





Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::put('projects/{id}', [ProjectController::class, 'update']);
    Route::delete('projects/{id}', [ProjectController::class, 'destroy']);

    Route::get('projects/{projectId}/columns', [ColumnController::class, 'index']);
    Route::get('projects/{projectId}/columns/{columnId}', [ColumnController::class, 'show']);
    Route::post('projects/{projectId}/columns', [ColumnController::class, 'store']);
    Route::put('projects/{projectId}/columns/{columnId}', [ColumnController::class, 'update']);
    Route::delete('projects/{projectId}/columns/{columnId}', [ColumnController::class, 'destroy']);

    Route::get('projects/{projectId}/columns/{columnId}/tasks', [TaskController::class, 'index']);
    Route::get('projects/{projectId}/columns/{columnId}/tasks/{taskId}', [TaskController::class, 'show']);
    Route::post('projects/{projectId}/columns/{columnId}/tasks', [TaskController::class, 'store']);
    Route::put('projects/{projectId}/columns/{columnId}/tasks/{taskId}', [TaskController::class, 'update']);
    Route::delete('projects/{projectId}/columns/{columnId}/tasks/{taskId}', [TaskController::class, 'destroy']);
});
