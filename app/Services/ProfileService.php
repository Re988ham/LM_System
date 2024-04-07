<?php

namespace App\Services;

use App\Models\User;
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
                'address' => $user->address,
                'mobile_number' => $user->mobile_number,
                'gender' => $user->gender,
                'role' => 'student',
                'birth_date' => $user->birth_date,
                'image' => $imagePath, // Return image path or null
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
            if (isset($data['country_id'])) {
                $user->country_id = $data['country_id'];
            }
            // Handle image update
            if (isset($data['image'])) {
                // Delete previous image if exists
                if ($user->image) {
                    $this->deleteProfileImage($user);
                }
                // Upload and set the new image
                $newdestinationpath = public_path("images\\users\\");
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


//For Experience:
// $user = auth('sanctum')->user();
// if ($user) {
//     $destination = $user->image;
//     if (File::exists($destination)) {
//         File::delete($destination);
//     }
//     // $path = $request['image']->store('images\\users\\', 'public');
//     $path = $request->image->store('images/users/', 'public');
//     $result = $user->update(['image' => $path]);
//     return $result;
// } else {
//     return null;
// }

// public function updateProfileImage(Request $request)
// {
//     $user = auth('sanctum')->user();
//     if ($user) {
//         $destination = $user->image;
//         if (File::exists($destination)) {
//             File::delete($destination);
//         }
//         $newdfilename = time() . $request->image->getClientOriginalName();
//         $destinationPath = public_path('images\\users\\');
//         $request->image->move($destinationPath, $newdfilename);
//         $user->image = $destinationPath . $newdfilename;
//         $result = $user->save();
//         return $result;
//     } else {
//         return null;
//     }
// }
