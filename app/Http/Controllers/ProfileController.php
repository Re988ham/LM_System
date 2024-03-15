<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\ProfileValidation;
use App\Services\ProfileService;
use Illuminate\Support\Facades\File;

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
            return $this->sendError("Something goes wrong!!");
        }
    }

    // To Update Profile Information:
    public function updateProfileInfo(ProfileValidation $profileValidation)
    {
        if (!empty($profileValidation->getErrors())) {
            return response()->json($profileValidation->getErrors(), 406);
        } else {
            $user = $this->profileService->updateProfileUser($profileValidation->request()->all());
            if ($user) {
                return $this->sendResponse($user);
            } else {
                return $this->sendError("Something goes wrong");
            }
        }
    }

    public function deleteImage()
    {
        $user = $this->profileService->deleteProfileImage();
        if ($user) {
            return $this->sendResponse($user);
        } else {
            return $this->sendError("Something goes wrong");
        }
    }
}
