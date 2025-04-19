<?php

namespace App\Services\Api\V1\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $request): array
    {
        $request->authenticate();
        $user = Auth::user()->toResource();

        return [
            $user->createToken($user->email)->plainTextToken,
            $user
        ];
    }

    public function logout(Request $request): bool
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();

            return true;
        }

        return false;
    }
}
