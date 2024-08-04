<?php

namespace App\Services\GeneralServices;

use Illuminate\Support\Facades\Storage;
use SapientPro\ImageComparator\ImageComparator;
use App\Traits\SendEmailTrait;
use SapientPro\ImageComparator\ImageResourceException;

class ImageComparisonService
{
    use SendEmailTrait;

    /**
     * @throws ImageResourceException
     */
    public function compareImage($uploadedImagePath)
    {
        $uploadedImageFullPath = $uploadedImagePath;

        // Check if uploaded image exists
        if (!file_exists($uploadedImageFullPath)) {
            return ['error' => 'Uploaded image does not exist.', 'status' => 404];
        }
        dd('fffffffffffff');

        $imageComparator = new ImageComparator();
        $similarImages = [];

        $imagesDirectory = public_path('images/users');
        $images = scandir($imagesDirectory);
        foreach ($images as $image) {
            if ($image == '.' || $image == '..') {
                continue;
            }

            $currentImageFullPath = $imagesDirectory . DIRECTORY_SEPARATOR . $image;

            if ($currentImageFullPath == $uploadedImageFullPath) {
                continue;
            }

            if (file_exists($currentImageFullPath)) {
                $similarity = $imageComparator->compare($uploadedImageFullPath, $currentImageFullPath);

                if ($similarity > 80) {
                    // If similarity is greater than 80%
                    $this->SendGreetingEmail('mhranabwdqt971@email.com');
                }
            }
        }

        return ['similar_images' => $similarImages, 'status' => 200];
    }
}
