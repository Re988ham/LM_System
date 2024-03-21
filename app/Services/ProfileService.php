<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;

class ProfileService
{

    // Service of show profile information:
    public function profileUser()
    {
        $user = User::find(auth('sanctum')->id());
        if ($user) {
            $imagePath = $user->image ? $user->image : null; // Check if image exists
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
            if (isset($data['address'])) {
                $user->address = $data['address'];
            }
            if (isset($data['image'])) {
                if ($user->image) {
                    $this->deleteProfileImage($user);
                }
                $newdestinationpath = public_path("images\\users\\");
                $user->image = ImageService::saveImage($data['image'], $newdestinationpath);
            }
            $result = $user->save();
            return $result;
        } else {
            return null;
        }
    }

    //Service of delete profile image:
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
