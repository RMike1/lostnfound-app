<?php

namespace App\Services\Api\V1\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(LoginRequest $request): string
    {
        $request->authenticate();
        $user = Auth::user();

        return $user->createToken($user->email)->plainTextToken;
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
