<?php

namespace App\Services;

use App\Helpers\UsersHelper;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Models\User;

class AuthService
{

    public function getRegisterUser(StoreAuthRequest $request): array
    {
        $user = User::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $userRole = $this->getRegisterRolUser($user->id, $request->role_id);

        $token = UsersHelper::getGenerateToken($user);

        return [
            'user' => $user,
            'role' => $userRole,
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }

    public function getRegisterRolUser($userId, $roleId)
    {
        $user = User::find($userId);
        $user->roles()->attach($roleId);
        return $user->roles()->get();
    }

    public function getLoginUser(StoreLoginRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $token = UsersHelper::getGenerateToken($user);
        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }
}