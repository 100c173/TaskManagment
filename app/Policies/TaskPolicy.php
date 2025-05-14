<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true ;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return true ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ($user->isSuperAdmin() || $user->isModerator()) ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
       if($user->isSuperAdmin()) return true ; 
       else if ( $user->isModerator() && $user->id == $task->created_by) return true;
       else return false ; 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
       if($user->isSuperAdmin()) return true ; 
       else if ( $user->isModerator() && $user->id === $task->created_by) return true;
       else return false ; 
    }
}
