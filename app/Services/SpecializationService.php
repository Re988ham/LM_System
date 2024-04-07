<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSpecialization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SpecializationService
{
    // Service of register process:
    public function chooseSpecialization($userId, array $specializationIds)
    {
        foreach ($specializationIds as $specializationId) {
            UserSpecialization::create([
                'user_id' => $userId,
                'specialization_id' => $specializationId,
            ]);
        }
    }
}
