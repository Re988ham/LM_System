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

        $user = User::create($data);

        if (isset($data['specialization_id']) && is_array($data['specialization_id'])) {
            $specializationService = new SpecializationService();
            $specializationService->chooseSpecialization($user->id, $data['specialization_id']);
        }

        return $user;
    }
}
