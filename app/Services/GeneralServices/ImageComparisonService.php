<?php
namespace App\Services\GeneralServices;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SapientPro\ImageComparator\ImageComparator;
use SapientPro\ImageComparator\ImageResourceException;

class ImageComparisonService
{
    /**
     * Compare two images and return similarity percentage.
     *
     * @param string $imagePath
     * @return array
     * @throws ImageResourceException
     */
    public function compareImage(string $imagePath,string $name): array
    {
        $imageComparator = new ImageComparator();
        $similarImages = [];

        // Ensure correct path
        $imagesDirectory = public_path('images/users'); // Ensure this is correct
        $images = scandir($imagesDirectory);

        // Replace the comparison and image path generation with the following:
        foreach ($images as $image) {
            if ($image == '.' || $image == '..') {
                continue;
            }

            $currentImageFullPath = $imagesDirectory . '/' . $image;
            $imagefinalpath = public_path($imagePath);

            // Skip comparing the uploaded image with itself
            if ($currentImageFullPath === $imagefinalpath) {
                continue;
            }

            // Check if file exists and compare images
            if (file_exists($currentImageFullPath)) {
                $similarity = $imageComparator->compare($imagefinalpath, $currentImageFullPath);

                if ($similarity > 80) {
                    // Update the path for the similar image
                    $similarImageRelativePath = '/images/users//' . $image;

                    $similarImageUser = User::where('image', 'like','%'.$similarImageRelativePath.'%')->get();

                    $similarImages[] = [
                        'uploaded_image' => $imagePath,
                        'uploaded_image_user' => $name,
                        'similar_image' => $similarImageRelativePath,
                        'similar_image_user' => $similarImageUser->pluck('name'),
                        'similarity' => $similarity
                    ];
                }
            }
        }

        return $similarImages;
    }
}

