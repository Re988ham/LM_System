<?php

namespace App\Services\GeneralServices;

use Illuminate\Http\UploadedFile;

class ImageService
{
    /**
     * Save an uploaded image to a specific destination and return the path.
     *
     * @param UploadedFile $image
     * @param string $destinationPath
     * @return string|null
     */
    public static function saveImage(UploadedFile $image, string $destinationPath): ?string
    {
        if ($image->isValid()) {
            $destination = public_path($destinationPath);
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destination, $fileName);
            return $destinationPath . '/' . $fileName; // Ensure single slash
        }

        return null;
    }

    /**
     * Delete an image from a specific path.
     *
     * @param string $imagePath
     * @return bool
     */
    public static function deleteImage(string $imagePath): bool
    {
        $fullPath = public_path($imagePath);

        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}


