<?php

namespace App\Services\GeneralServices;

use App\Models\SpecializationOfUser;

class SpecializationService
{
    // Service of register process:
    public function chooseSpecialization($userId, array $specializationIds)
    {
        foreach ($specializationIds as $specializationId) {
            SpecializationOfUser::create([
                'user_id' => $userId,
                'specialization_id' => $specializationId,
            ]);
        }
    }
}
