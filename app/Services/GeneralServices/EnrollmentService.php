<?php

namespace App\Services\GeneralServices;

use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EnrollmentService
{
    /**
     Service for manage Enrollment operations in the system.
    */

    public static function store_Enrollment($course_id)
    {
        $data['course_id'] = $course_id;
        $data['user_id'] = Auth::user()->id;
        //$data['enrollment_date'] = Carbon::now();

        $enrollment = Enrollment::create($data);
        return $enrollment;
    }
}
