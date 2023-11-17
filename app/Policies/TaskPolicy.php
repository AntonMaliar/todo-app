<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function authorize(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
