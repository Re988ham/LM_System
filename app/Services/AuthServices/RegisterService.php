<?php

namespace App\Services\AuthServices;

use App\Models\User;
use App\Services\GeneralServices\ImageService;
use App\Services\GeneralServices\SpecializationService;
use App\Traits\SendEmailTrait;
use Illuminate\Support\Facades\Hash;


class RegisterService
{
    use SendEmailTrait;

    // Service of register process:
    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        if (isset($data['image'])) {
            $destinationPath ='/images/users/';
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }

        $user = User::create($data);

        if (isset($data['specialization_id']) && is_array($data['specialization_id'])) {
            $specializationService = new SpecializationService();
            $specializationService->chooseSpecialization($user->id, $data['specialization_id']);
        }
        $useremail=$user['email'];
        //$this->SendGreetingEmail($useremail);
        return $user;
    }
}
