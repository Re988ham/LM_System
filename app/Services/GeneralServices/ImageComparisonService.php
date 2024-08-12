<?php
namespace App\Services\GeneralServices;

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
    public function compareImage(string $imagePath): array
    {
        $imageComparator = new ImageComparator();
        $similarImages = [];

        // Ensure correct path
        $imagesDirectory = public_path('images/users'); // Ensure this is correct
        $images = scandir($imagesDirectory);

        foreach ($images as $image) {
            if ($image == '.' || $image == '..') {
                continue;
            }

            $currentImageFullPath = $imagesDirectory . '/' . $image;
            $imagefinalpath=  public_path($imagePath);
            // Skip comparing the uploaded image with itself
            if ($currentImageFullPath === $imagefinalpath) {
                continue;
            }

            // Check if file exists and compare images
            if (file_exists($currentImageFullPath)) {
                $similarity = $imageComparator->compare($imagefinalpath, $currentImageFullPath);

                if ($similarity > 80 && !($imagePath === '/images/users//' . $image)) {
                    $similarImages[] = [
                        'uploaded_image' => $imagePath,
                        'similar_image' => '/images/users//' . $image,
                        'similarity' => $similarity
                    ];
                }
            }
        }

        return $similarImages;
    }
}

