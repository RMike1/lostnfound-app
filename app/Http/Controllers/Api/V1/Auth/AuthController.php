<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserPasscodeForgotRequest;
use App\Http\Requests\Auth\UserPasscodeResetRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Services\Api\V1\Auth\AuthService;
use App\Services\Api\V1\Auth\PasswordService;
use App\Services\Api\V1\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService,
        private RegisterService $registerService,
        private PasswordService $passwordService) {}

    // ==================login===================

    public function login(LoginRequest $request)
    {
        return response()->json([
            'token' => $this->authService->login($request),
        ], 200);
    }

    // ================logout=================

    public function logout(Request $request)
    {
        if ($this->authService->logout($request)) {
            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    // ==================Register===================

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        return response()->json([
            'user' => $this->registerService->register($request->validated()),
        ],201);
    }

    public function forgotPassword(UserPasscodeForgotRequest $request)
    {
        return response()->json($this->passwordService->sendPasswordLink($request),200);
    }

    public function resetPassword(UserPasscodeResetRequest $request)
    {
        return response()->json([
            'status' => $this->passwordService->resetPassword($request->validated()),
        ]);
    }
}
