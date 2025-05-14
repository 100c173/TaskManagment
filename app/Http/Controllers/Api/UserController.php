<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService ; 

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $this->successResponse('All Users Fetched Successfully' , UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=$this->userService->getUser($id);
        return $this->successResponse('User fetcehd successfully',new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = $this->userService->updateUserRole($request->validated() , $id);
        return $this->successResponse('User role updated successfully',new UserResource($user),201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userService->deleteUser($id);
        return $this->successResponse('User and related tasks  deleted Successfully ');
    }
}
