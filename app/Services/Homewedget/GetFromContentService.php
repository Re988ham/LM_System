<?php

namespace App\Services\Homewedget;

use App\Models\Course;
use App\Models\User;


    // Service of last 10 objects in Home widget (The results Change depending on the user ):
class GetFromContentService
{
    public function Getvideos()
    {
        $user = User::find(auth('sanctum')->id());

        if ($user) {
            $userSpecializations = $user->specializations;
            $specializationIds = $userSpecializations->pluck('id');
            $relatedvideos = [];

            $relatedvid = Course::whereIn('specialization_id', $specializationIds)->where('status','accepted')->get();

            foreach ($relatedvid as $course) {
                $relatedvideos[] = $course->contents->filter(function($content) {
                    return $content->type == 'video' && $content->status == 'accepted';
                });
            }

            return collect($relatedvideos)->flatten();
        }

        return null;
    }
    public function Getdocuments()
    {
        $user = User::find(auth('sanctum')->id());

        if ($user) {
            $userSpecializations = $user->specializations;
            $specializationIds = $userSpecializations->pluck('id');
            $relatedvideos = [];

            $relateddoc = Course::whereIn('specialization_id', $specializationIds)->where('status','accepted')->get();

            foreach ($relateddoc as $course) {
                $relateddocuments[] = $course->contents->filter(function($content) {
                    return $content->type == 'document' && $content->status == 'accepted';
                });;
            }

            return collect($relateddocuments)->flatten();
        }

        return null;
    }

    public function Getcourses()
    {
        $user = User::find(auth('sanctum')->id());

        if ($user) {
            $userSpecializations = $user->specializations;
            $specializationIds = $userSpecializations->pluck('id');
            $relatedcourses = [];

            $relatedcourses = Course::whereIn('specialization_id', $specializationIds)->where('status','accepted')->get();

            return collect($relatedcourses)->flatten();
        }

        return null;
    }
}
