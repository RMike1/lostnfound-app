<?php

namespace App\Services\Api\V1\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordService
{
    public function sendPasswordLink($request): string|array
    {
        $status = Password::sendResetLink(
            $request->safe()->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return __($status);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    // ============================= Reset Password =============================

    public function resetPassword(array $data): mixed
    {
        $status = Password::reset(
            $data,
            function ($user) use ($data) {
                $user->forceFill([
                    'password' => Hash::make($data['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return __($status);
    }
}
