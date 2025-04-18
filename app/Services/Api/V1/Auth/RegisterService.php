<?php

namespace App\Services\Api\V1\Auth;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterService
{
    public function register($request): UserResource
    {
        $user = User::create($request);
        event(new Registered($user));

        return $user->toResource();
    }
}
