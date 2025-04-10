<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserPasscodeResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserPasscodeResetRequest $request)
    {

        $status = Password::sendResetLink(
            $request->safe()->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return [
                'status' => __($status),
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
