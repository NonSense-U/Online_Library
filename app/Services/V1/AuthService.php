<?php

namespace App\Services\V1;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function signup(array $payload): array
    {
        /** @var \App\Models\User $user */
        $user = User::create($payload['base']);
        $data['user'] = $user;
        if ($payload['login']) {
            $data['token'] = $user->createToken('token')->plainTextToken;
        }
        return $data;
    }


    public function login(array $payload): array
    {
        /** @var \App\Models\User $user */
        $user = null;
        if (isset($payload['username'])) {
            $user = User::query()->where('username', '=', $payload['username'])->firstOrFail();
        } else {
            $user = User::query()->where('email', '=', $payload['email'])->firstOrFail();
        }

        if (!Hash::check($payload['password'], $user->password)) {
            throw new AuthorizationException('Wrong Credentials!');
        }

        $data['token'] = $user->createToken('token')->plainTextToken;

        return $data;
    }


    public function logout(User $user): void
    {
        //TODO
        //! FLASE ERROR
        $user->currentAccessToken()->delete();
        return;
    }
}
