<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileService
{
    public function profileUser()
    {
        $user = auth('sanctum')->user();

        if ($user) {
            $dis = public_path('images/users/');
            $imagePath = $user->image ? $dis . $user->image : null; // Check if image exists

            return [
                'name' => $user->name,
                'email' => $user->email,
                'address' => $user->address,
                'mobile_number' => $user->mobile_number,
                'gender' => $user->gender,
                'role' => 'student',
                'date_of_birth' => $user->date_of_born,
                'image' => $imagePath, // Return image path or null
            ];
        } else {
            return null;
        }
    }

    public function updateProfileUser(array $request)
    {
        $user = auth('sanctum')->user();
        if ($user) {
            if (isset($request['address'])) {
                $user->address = $request['address'];
            }
            if (isset($request['mobile_number'])) {
                $user->mobile_number = $request['mobile_number'];
            }
            $result = $user->save();
            return $result;
        } else {
            return null;
        }
    }

    public function deleteProfileImage()
    {
        $user = auth('sanctum')->user();
        if ($user) {
            $destination = $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
                $user->image = Null;
                $result = $user->save();
                return $result;
            }
        } else {
            return null;
        }
    }
}


//For Experience:
//if ($request->hasFile('image')) {
    // $destination = public_path('images\\users\\' . $user->image);
    // if (File::exists($destination)) {
    //     File::delete($destination);
    // }
    // $newdfilename = time() . $request->image->getClientOriginalName();
    // $destinationPath = public_path('images\\\users\\');
    // $request->image->move($destinationPath, $newdfilename);
    // $user->image = $newdfilename;
// }
