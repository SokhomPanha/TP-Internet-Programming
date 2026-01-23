<?php

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Login endpoint
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = $request->user();
    $token = $user->createToken('mobile')->accessToken;

    return response()->json([
        'token' => $token,
        'user' => $user->load('roles'),
    ]);
});

// Protected routes
Route::middleware('auth:api')->group(function () {

    // Get current user
    Route::get('/me', function (Request $request) {
        return $request->user()->load('roles.permissions');
    });

    // Projects (manager/admin only)
    Route::post('/projects', function (Request $request) {
        abort_unless($request->user()->can('projects.create'), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'created_by' => $request->user()->id,
        ]);

        return response()->json($project, 201);
    });

    // Update task status (assigned staff only)
    Route::patch('/tasks/{task}/status', function (Request $request, Task $task) {
        // Use policy authorization
        if (!$request->user()->can('updateStatus', $task)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($validated);

        return response()->json($task);
    });

    // Get my tasks (staff)
    Route::get('/my-tasks', function (Request $request) {
        $tasks = Task::where('assigned_to', $request->user()->id)
            ->with('project')
            ->get();

        return response()->json($tasks);
    });
});
