<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\DeleteProjectRequest;
use App\Http\Requests\AssignUsersRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Create a new project
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create([
            'name' => $request->name,
            'department' => $request->department,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Project created successfully', 'project' => $project], 201);
    }

    // List all projects with optional filtering
    public function index(Request $request)
    {
        $query = Project::query();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->get();
        return response()->json($projects, 200);
    }

    // Show a single project by ID
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project, 200);
    }

    // Update an existing project's information
    public function update(UpdateProjectRequest $request)
    {
        $project = Project::findOrFail($request->id);

        $project->update([
            'name' => $request->name ?? $project->name,
            'department' => $request->department ?? $project->department,
            'start_date' => $request->start_date ?? $project->start_date,
            'end_date' => $request->end_date ?? $project->end_date,
            'status' => $request->status ?? $project->status,
        ]);

        return response()->json(['message' => 'Project updated successfully', 'project' => $project], 200);
    }

    // Delete a project by ID
    public function destroy(DeleteProjectRequest $request)
    {
        $project = Project::findOrFail($request->id);
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully'], 200);
    }

    // Assign users to a project
    public function assignUsers(AssignUsersRequest $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        // Sync the users to the project
        $project->users()->sync($request->user_ids);

        return response()->json(['message' => 'Users assigned to project successfully', 'project' => $project], 200);
    }

    // Get all users assigned to a project
    public function users($projectId)
    {
        $project = Project::findOrFail($projectId);
        $users = $project->users;

        return response()->json($users, 200);
    }
}
