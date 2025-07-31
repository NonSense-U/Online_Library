<?php

namespace App\Http\Controllers\V1\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Services\V1\AuthService;
use App\Traits\V1\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(SignupRequest $request)
    {
        $data = $this->authService->signup($request->validated());
        return ApiResponse::success('user created successfully!',$data,201);    
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());
        return ApiResponse::success('Logged in successfully!',$data,200);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return ApiResponse::success('logged out successfully!',[],200);
    }
}
