<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterService
{

    // Service of register process:
    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        if (isset($data['image'])) {
            $destinationPath = public_path('images\\users\\');
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }

        return User::create($data);
    }
}
