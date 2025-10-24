<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',function(){
    return response()->json(['message' => 'API is working']);
});

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

Route::get('columns/{columnId}/tasks', [TaskController::class, 'index']);
Route::get('columns/{columnId}/tasks/{taskId}', [TaskController::class, 'show']);
Route::post('columns/{columnId}/tasks', [TaskController::class, 'store']);
Route::put('columns/{columnId}/tasks/{taskId}', [TaskController::class, 'update']);
Route::delete('columns/{columnId}/tasks/{taskId}', [TaskController::class, 'destroy']);