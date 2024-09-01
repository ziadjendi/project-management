<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Http\Requests\DeleteTimesheetRequest;
use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    // Create a new timesheet
    public function store(StoreTimesheetRequest $request)
    {
        $timesheet = Timesheet::create([
            'task_name' => $request->task_name,
            'date' => $request->date,
            'hours' => $request->hours,
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
        ]);

        return response()->json(['message' => 'Timesheet created successfully', 'timesheet' => $timesheet], 201);
    }

    // List all timesheets with optional filtering
    public function index(Request $request)
    {
        $query = Timesheet::query();

        // Apply filters
        if ($request->filled('task_name')) {
            $query->where('task_name', 'like', "%{$request->task_name}%");
        }
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $timesheets = $query->get();
        return response()->json($timesheets, 200);
    }

    // Show a single timesheet by ID
    public function show($id)
    {
        $timesheet = Timesheet::findOrFail($id);
        return response()->json($timesheet, 200);
    }

    // Update an existing timesheet's information
    public function update(UpdateTimesheetRequest $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);

        $timesheet->update([
            'task_name' => $request->task_name ?? $timesheet->task_name,
            'date' => $request->date ?? $timesheet->date,
            'hours' => $request->hours ?? $timesheet->hours,
            'user_id' => $request->user_id ?? $timesheet->user_id,
            'project_id' => $request->project_id ?? $timesheet->project_id,
        ]);

        return response()->json(['message' => 'Timesheet updated successfully', 'timesheet' => $timesheet], 200);
    }

    // Delete a timesheet by ID
    public function destroy(DeleteTimesheetRequest $request)
    {
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->delete();

        return response()->json(['message' => 'Timesheet deleted successfully'], 200);
    }
}
