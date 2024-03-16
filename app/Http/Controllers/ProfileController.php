<?php

namespace App\Http\Controllers;

use App\Requests\ProfileValidation;
use App\Services\ProfileService;
use App\Models\User;

class ProfileController extends BaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    // To Show Profile Information:
    public function showProfileInfo()
    {
        $user = $this->profileService->profileUser();
        if ($user) {
            return $this->sendResponse($user);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }

    // To Update Profile Information (address, mobile_number, image):
    public function updateProfileInfo(ProfileValidation $profileValidation)
    {
        if (!empty($profileValidation->getErrors())) {
            return response()->json($profileValidation->getErrors(), 406);
        } else {
            $user = $this->profileService->updateProfileUser($profileValidation->request()->all());
            if ($user) {
                return $this->sendResponse("Profile Information has been Updated Successfully");
            } else {
                return $this->sendError("Something went wrong!!");
            }
        }
    }

    // To delete image profile:
    public function deleteImage()
    {
        $user = User::find(auth('sanctum')->id());
        $isDeleted = $this->profileService->deleteProfileImage($user);
        if ($isDeleted) {
            return $this->sendResponse("Image has been deleted successfully");
        } else {
            return $this->sendError("Something goes wrong");
        }
    }
}
