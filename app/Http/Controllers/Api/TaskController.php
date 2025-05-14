<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use PDO;

class TaskController extends Controller
{
    protected  TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $this->taskService->getAllTasks($request);
        return $this->successResponse('All tasks fetched successfully', TaskResource::collection($tasks));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            $task = $this->taskService->createTask($request->user(), $request->validated());
            return $this->successResponse('Task Successfully created', new TaskResource($task));
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = $this->taskService->getTaskById($id);
        return $this->successResponse('Task fetched Successfully', new TaskResource($task));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        try {
            $task = $this->taskService->updateTask($request->user(), $request->validated(), $id);
            return $this->successResponse("Task updated Successfully", new TaskResource($task));
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $this->taskService->deleteTask($request->user(), $id);
            return $this->successResponse('Task deleted successfully');
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getAllCommnets(string $id)
    {
        $commnets = $this->taskService->getAllComment($id);
        return $this->successResponse("All comments feteched succefully", CommentResource::collection($commnets));
    }

    public function myTasks(Request $request)
    {
        $tasks = $this->taskService->myTasks($request->user());
        return $this->successResponse('All your tasks fetched successfully', TaskResource::collection($tasks));
    }

    public function taskStatus(Request $request, string $id)
    {
        try {
            $task_status = $this->taskService->taskStatus($request->user(), $id);
            return $this->successResponse('Task statues fetched successfully', $task_status);
        } catch (AuthorizationException $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
