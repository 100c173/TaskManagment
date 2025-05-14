<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(CreateUserRequest $request)
    {
        $data = $request->validated();
        [$user, $token] = $this->authService->register($data);

        return $this->registerResponse(new UserResource($user),$token);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        [$user, $token] = $this->authService->login($data);

        return $this->loginResponse(new UserResource($user), $token);
    }

    public function user(Request $request)
    {
        return $this->successResponse('User retrieved successfully', new UserResource($request->user()));
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return $this->logoutResponse();
    }
}
