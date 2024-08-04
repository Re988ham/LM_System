<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Requests\AuthRequests\ProfileUpdateRequest;
use App\Services\Application\AuthServices\ProfileService;

class ProfileController extends BaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    // Show User Profile Information
    public function showProfileInfo()
    {
        $user = $this->profileService->profileUser();
        if ($user) {
            return $this->sendResponse($user);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }

    // Update User Profile Information (country id, mobile_number, image):
    public function updateProfileInfo(ProfileUpdateRequest $profileValidation)
    {
        if ($profileValidation->hasError()) {
            return $this->sendError(message: $profileValidation->getErrors(), code: 406);
        } else {
            $user = $this->profileService->updateProfileUser($profileValidation->validatedData());
            if ($user) {
                $user = $this->profileService->profileUser();
                return $this->sendResponse($user);
            } else {
                return $this->sendError("Something went wrong!!");
            }
        }
    }

    // Delete User Profile Image
    public function deleteImage()
    {
        $user = User::find(auth('sanctum')->id());
        $isDeleted = $this->profileService->deleteProfileImage($user);
        if ($isDeleted) {
            return $this->sendResponse("Image has been deleted successfully.");
        } else {
            return $this->sendError("Something goes wrong!!");
        }
    }
}
