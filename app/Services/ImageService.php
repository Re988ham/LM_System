<?php

namespace App\Services;

class ImageService
{

    public static function saveImage($image, string $destinationPath): ?string
    {
        if ($image->isValid()) {
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            return $destinationPath . $fileName;
        }

        return null;
    }
}


//Note:
//we will build this function because we want to use image many times, and we will use the same system to manage it.
