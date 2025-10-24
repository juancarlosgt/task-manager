<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Column;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
class ColumnController extends Controller
{
    
    public function index($projectId)
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $columns = Column::where('project_id', $projectId)->get();
        if ($columns->isEmpty()) {
            return response()->json(['message' => 'No columns found for this project'], 404);
        }

        return response()->json($columns);
    }

    public function show($projectId, $id)
    {
        $column = Column::find($id);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }
        return response()->json([$column]);
    }
     
    public function store(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'title' => $request->input('title'),            
            'project_id' => $projectId,
        ];
        $column = Column::create($data);
        return response()->json($column, 201);
    }

    public function update(Request $request,$projectId, $id)
    {
        $column = Column::find($id);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $column->update($validator->validated());
        return response()->json($column);
    }

    public function destroy($projectId, $id)
    {
        $column = Column::find($id);
        if (!$column) {
            return response()->json(['message' => 'Column not found'], 404);
        }

        $column->delete();
        return response()->json(['message' => 'Column deleted successfully']);
    }
}
