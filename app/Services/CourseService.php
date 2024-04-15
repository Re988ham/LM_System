<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Http\UploadedFile;

class CourseService
{
    /**
     Service for manage course operations in the system.
    */
    public function index(){
        $course = [];

        Course::chunk(10, function ($chunkedCouese) use (&$course) {
            foreach ($chunkedCouese as $country) {
                $course[] = $country;
            }
        });

        if (!empty($course)) {
            return $this->sendResponse($course);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }

}
