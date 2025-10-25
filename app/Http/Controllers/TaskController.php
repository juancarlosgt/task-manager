<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Column;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Project;
use Tymon\JWTAuth\Exceptions\JWTException;

class TaskController extends Controller
{
    public function index($projectId, $columnId)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        $project = Project::where('user_id', $user->id)->findOrFail($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $column = Column::where("project_id", $projectId)->find($columnId);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }

        $tasks = Task::where('column_id', $columnId)->get();
        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found for this column'], 404);
        }

        return response()->json($tasks);
    }

    public function show($projectId, $columnId, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json([$task]);
    }

    public function store(Request $request, $projectId, $columnId)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        $project = Project::where('user_id', $user->id)->findOrFail($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $column = Column::where("project_id", $projectId)->findOrFail($columnId);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'column_id' => $columnId,
        ];
        $task = Task::create($data);
        return response()->json($task, 201);
    }

    public function update(Request $request, $projectId, $columnId, $taskId)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        $project = Project::where('user_id', $user->id)->findOrFail($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $column = Column::where("project_id", $projectId)->findOrFail($columnId);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }

        $task = Task::where('column_id', $columnId)->find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'new_column_id' => 'sometimes|exists:columns,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task->title = $request->input('title', $task->title);
        $task->description = $request->input('description', $task->description);
        if ($request->has('new_column_id')) {
            $task->column_id = $request->input('new_column_id');
        }
        $task->save();
        return response()->json($task);
    }

    public function destroy($projectId, $columnId, $taskId)
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }

        
        $project = Project::where('user_id', $user->id)->find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found or unauthorized'], 403);
        }

        $column = Column::where('project_id', $projectId)->find($columnId);
        if (!$column) {
            return response()->json(['message' => 'Column not found or unauthorized'], 404);
        }

        
        $task = Task::where('column_id', $columnId)->find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
