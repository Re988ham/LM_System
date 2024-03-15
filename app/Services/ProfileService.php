<?php

namespace App\Services;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;

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

    public function updateProfileUser(Request $request)
    {
        $user = auth('sanctum')->user();
        if ($user) {
            if ($request->address || $request->mobile_number) {
                $user->address = $request->address;
                $user->mobile_number = $request->mobile_number;
            }
            if ($request->hasFile('image')) {
                $destination = public_path('images\\users\\' . $user->image);
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $newdfilename = time() . $request->image->getClientOriginalName();
                $destinationPath = public_path('images\\\users\\');
                $request->image->move($destinationPath, $newdfilename);
                $user->image = $newdfilename;
            }
           $result = $user->save();
            return $result;
        } else {
            return null;
        }
    }
}
