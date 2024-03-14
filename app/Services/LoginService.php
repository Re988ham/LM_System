<?php

namespace App\Services;

use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

class LoginService
{

    public function loginUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            return $user;
        }
        return null;
    }
}
