<?php

namespace App\Services\AuthServices;

use App\Models\User;
use App\Services\GeneralServices\ImageService;
use Illuminate\Support\Facades\File;

class ProfileService
{
    // Service of show profile information:
    public function profileUser()
    {
        $user = User::find(auth('sanctum')->id());
        if ($user) {
            // Check if use already has image
            $imagePath = $user->image ? $user->image : null;
            return [
                'name' => $user->name,
                'email' => $user->email,
                'mobile_number' => $user->mobile_number,
                'gender' => $user->gender,
                'birth_date' => $user->birth_date,
                'image' => $imagePath, // Return image path or null
                'country' => $user->country,
                'interests' => $user->specializations->pluck('name', 'id'),
            ];
        } else {
            return null;
        }
    }

    // Service of update profile information(address, mobile_number, image):
    public function updateProfileUser(array $data)
    {
        $user = User::find(auth('sanctum')->id());
        if ($user) {
            if (isset($data['mobile_number'])) {
                $user->mobile_number = $data['mobile_number'];
            }

            // Handle image update
            if (isset($data['image'])) {
                // Delete previous image if exists
                if ($user->image) {
                    $this->deleteProfileImage($user);
                }
                $newdestinationpath ='/images/users/';

                $user->image = ImageService::saveImage($data['image'], $newdestinationpath);
            }

            $user->save();
            return $user;
        } else {
            return null;
        }
    }


    // Service of delete profile image:
    public function deleteProfileImage($user): bool
    {
        $destination = $user->image;
        if (File::exists($destination)) {
            File::delete($destination);
            $user->image = null;
            return $user->save();
        }
        return false;
    }
}
