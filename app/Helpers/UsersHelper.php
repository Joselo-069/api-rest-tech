<?php

namespace App\Helpers;

use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\Role;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersHelper
{

    public static function getGenerateToken($user) {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public static function userIsAdmin(): bool
    {
        $user = auth('sanctum')->user();

        return RoleUser::where('user_id', $user->id)
            ->where('role_id', Role::ROLE_ADMIN)
            ->exists();
    }
}
