<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;

// AUTHENTICATION ROUTES - PUBLIC
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// PROTECTED ROUTES
Route::middleware('auth:sanctum')->group(function () {
    // AUTHENTICATION ROUTES
    Route::post('/logout', [UserController::class, 'logout']);

    // USER ROUTES
    Route::get('/user', [UserController::class, 'index']); // List all users
    Route::get('/user/{id}', [UserController::class, 'show']); // Show a single user by ID
    Route::post('/user/update', [UserController::class, 'update']); // Update an existing user
    Route::post('/user/delete', [UserController::class, 'destroy']); // Delete a user

    // PROJECTS ROUTES
    Route::post('/project', [ProjectController::class, 'store']); // Create a new project
    Route::get('/project', [ProjectController::class, 'index']); // List all projects
    Route::get('/project/{id}', [ProjectController::class, 'show']); // Show a single project by ID
    Route::post('/project/update', [ProjectController::class, 'update']); // Update an existing project
    Route::post('/project/delete', [ProjectController::class, 'destroy']); // Delete a project
    // Additional routes for assigning users and getting users of a project
    Route::post('project/{project}/assign-users', [ProjectController::class, 'assignUsers']);
    Route::get('project/{project}/users', [ProjectController::class, 'users']);

    // TimeSheets ROUTES
    Route::post('/timesheet', [TimesheetController::class, 'store']); // Create a new timesheet
    Route::get('/timesheet', [TimesheetController::class, 'index']); // List all timesheets
    Route::get('/timesheet/{id}', [TimesheetController::class, 'show']); // Show a single timesheet by ID
    Route::post('/timesheet/update', [TimesheetController::class, 'update']); // Update an existing timesheet
    Route::post('/timesheet/delete', [TimesheetController::class, 'destroy']); // Delete a timesheet

});
