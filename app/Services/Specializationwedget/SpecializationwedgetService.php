<?php

namespace App\Services\Specializationwedget;

use App\Models\Content;
use App\Models\Country;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;

class SpecializationwedgetService
{
    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getallcoursesbyid($id)
    {
        $courses = [];
//        $courses=Course::all();
         Course::where('specialization_id', $id)
            ->where('status', 'accepted')
            ->chunk(10, function($chunk) use(&$courses) {
                foreach ($chunk as $course) {
                    $country = Country::find($course->country_id);
                    $specialization = Specialization::find($course->specialization_id);
                    $author = User::find($course->user_id);

                    $course['country_name'] = $country ? $country->name : 'Unknown Country';
                    $course['specialization_name'] = $specialization ? $specialization->name : 'Unknown Specialization';
                    $course['author_name'] = $author ? $author->name : 'Unknown Author';

                    $courses[] = $course;
                }
            });

        return $courses;
    }

    public function getallcontentsbyid($id)
    {
        $contents = [];
       $contents= Content::all();
//        Content::where('course_id', $id)
//            ->where('status', 'accepted')
//            ->chunk(10, function($chunk) use(&$contents) {
//                foreach ($chunk as $content) {
//                    $contents[] = $content;
//                }
//            });

        return $contents;
    }
}
