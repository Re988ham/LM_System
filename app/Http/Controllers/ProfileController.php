<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    //To Update Profile Information:
    public function updateProfileInfo(Request $request)
    {
        $user = $this->profileService->updateProfileUser($request);
        if ($user) {
            return $this->sendResponse($user);
        } else {
            return $this->sendError("Something goes wrong");
        }

    }
}
