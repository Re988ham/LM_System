<?php

namespace App\Services\Application\AuthServices;

use App\Jobs\CompareImagesJob;
use App\Models\User;
use App\Services\GeneralServices\ImageService;
use App\Services\GeneralServices\ImageComparisonService; // Import ImageComparisonService
use App\Services\GeneralServices\SpecializationService;
use App\Traits\SendEmailTrait;
use Illuminate\Support\Facades\Hash;
use SapientPro\ImageComparator\ImageResourceException;

class RegisterService
{
    use SendEmailTrait;

    protected $imageComparisonService; // Instance variable for ImageComparisonService

    public function __construct(ImageComparisonService $imageComparisonService)
    {
        $this->imageComparisonService = $imageComparisonService;
    }

    /**
     * Register a user and handle image processing.
     * @throws ImageResourceException
     */
    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        if (isset($data['image'])) {
            $destinationPath = '/images/users/';
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);

//            if ($data['image']) {
//                CompareImagesJob::dispatch($data['image'], $data['name']);
//            }
//            if ($data['image']) {
//                $similarImages = $this->imageComparisonService->compareImage($data['image'],$data['name']);
//            }
        }

        $user = User::create($data);

        if (isset($data['specialization_id']) && is_array($data['specialization_id'])) {
            $specializationService = new SpecializationService();
            $specializationService->chooseSpecialization($user->id, $data['specialization_id']);
        }

        // Example sending email
        $useremail = $user->email;
        // $this->SendGreetingEmail($useremail);
//        return [$user,$similarImages];
        return $user;
    }

}
