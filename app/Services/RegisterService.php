<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\password;

class RegisterService
{

    public function registerUser(array $data): User
{
    $data['password'] = Hash::make($data['password']);

    if (isset($data['image']) && $data['image']->isValid()) {
        $destinationPath = public_path('images/users');
        $fileName = time() . '_' . $data['image']->getClientOriginalName();
        $data['image']->move($destinationPath, $fileName);
        $data['image'] = $destinationPath . $fileName;
    }

    return User::create($data);
}

}
