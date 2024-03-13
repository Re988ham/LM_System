<?php

namespace App\Services;

class LogoutService
{

    public function logoutUser()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            $user->tokens()->delete();
            return true;
        }
        return false;
    }
}
