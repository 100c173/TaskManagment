<?php

namespace App\Services;

use App\Filters\TaskFilter;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use PDO;

class TaskService
{
    /**
     * Get all tasks with pagination.
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllTasks(Request $request)
    {
        $filter = new TaskFilter($request);

        return $filter
            ->apply(Task::query())
            ->latest()
            ->paginate(3);
    }

    /**
     * Create a new task using the provided data.
     *
     * @param array $data
     * @return \App\Models\Task
     */
    public function createTask(User $user, array $data)
    {
        throw_if(
            !$user->can('create', Task::class),
            throw new AuthorizationException('Unauthorized')
        );

        $data['created_by'] = $user->id;
        $task = Task::create($data);

        return $task;
    }

    /**
     * Update an existing task by ID using the provided data.
     *
     * @param array $data
     * @param string $id
     * @return \App\Models\Task
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updateTask(User $user, array $data, string $id)
    {
        $task = Task::findOrFail($id);

        if (!($user->can('update', $task)))
            throw new AuthorizationException('Unauthorized');

        $task->update($data);
        return $task;
    }

    /**
     * Retrieve a specific task by its ID.
     *
     * @param string $id
     * @return \App\Models\Task
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getTaskById(string $id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Delete a task by its ID.
     *
     * @param string $id
     * @return void
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteTask(User $user, string $id)
    {
        $task = Task::findOrFail($id);

        if (!$user->can('delete', $task))
            throw new AuthorizationException('Unauthorized');

        $task->delete();
    }

    public function getAllComment($id)
    {

        $task = Task::findOrFail($id);
        return $task->comments()->latest()->paginate(5);
    }

    public function myTasks(User $user)
    {
        return $user->tasks;
    }

    public function taskStatus(User $user, $id)
    {

        $task = Task::findOrFail($id);
        if (!$user->can('show-task-status', $task))
            throw new AuthorizationException('Unauthorized');

        return $task->status->name;
    }
}
