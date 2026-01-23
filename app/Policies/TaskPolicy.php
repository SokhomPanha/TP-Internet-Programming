<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        // Manager can view tasks in their projects
        if ($user->hasRole('manager')) {
            return $task->project->created_by === $user->id;
        }

        // Staff can only view tasks assigned to them
        if ($user->hasRole('staff')) {
            return $task->assigned_to === $user->id;
        }

        return false;
    }

    public function updateStatus(User $user, Task $task): bool
    {
        // Staff can only update status of tasks assigned to them
        return $user->hasRole('staff') && $task->assigned_to === $user->id;
    }

    public function update(User $user, Task $task): bool
    {
        // Managers can update tasks in their projects
        if ($user->hasRole('manager')) {
            return $task->project->created_by === $user->id;
        }

        return false;
    }
}
