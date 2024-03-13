<?php

namespace App\Services;

use App\Models\User;

class ProfileService
{
    public function profileUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $dis = public_path('images/users/');
            return [
                'name' => $user->name,
                'email' => $user->email,
                'address' => $user->address,
                'mobile_number' => $user->mobile_number,
                'gender' => $user->gender,
                'role' => 'student',
                'date_of_birth' => $user->date_of_born,
                'image' => $dis . $user->image,
            ];
        } else {
            return null;
        }
    }
}
