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

Route::apiResource('columns', 'App\Http\Controllers\ColumnController');
Route::apiResource('tasks', 'App\Http\Controllers\TaskController');