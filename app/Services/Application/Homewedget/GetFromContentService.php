<?php

namespace App\Services\Application\Homewedget;

use App\Models\Country;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;


// Service of last 10 objects in Home widget (The results Change depending on the user ):
class GetFromContentService
{
    public function Getvideos()
    {
        $userId = auth('sanctum')->id();
        $user = User::with('specializations')->find($userId);

        if (!$user) {
            return null;
        }

        $specializationIds = $user->specializations->pluck('id')->toArray();

        if (empty($specializationIds)) {
            return collect();
        }

        $relatedVideos = Course::whereIn('specialization_id', $specializationIds)
            ->where('status', 'accepted')
            ->with(['contents' => function($query) {
                $query->where('status', 'accepted')
                    ->where('type_id', 1);
            },])
            ->get()
            ->flatMap(function($course) {
                return $course->contents;
            });

        return $relatedVideos;
    }

    public function Getdocuments()
    {
        $userId = auth('sanctum')->id();
        $user = User::with('specializations')->find($userId);

        if (!$user) {
            return null;
        }

        $specializationIds = $user->specializations->pluck('id')->toArray();

        if (empty($specializationIds)) {
            return collect();
        }

        $relateddocuments = Course::whereIn('specialization_id', $specializationIds)
            ->where('status', 'accepted')
            ->with(['contents' => function($query) {
                $query->where('status', 'accepted')
                    ->where('type_id', 2);
            },])
            ->get()
            ->flatMap(function($course) {
                return $course->contents;
            });

        return $relateddocuments;
    }




    public function Getcourses()
    {
        $user = User::find(auth('sanctum')->id());

        if ($user) {
            $userSpecializations = $user->specializations;
            $specializationIds = $userSpecializations->pluck('id');
            $courses =[];

             Course::whereIn('specialization_id', $specializationIds)
                ->where('status','accepted')
                ->chunk(10, function($chunk) use(&$courses){

                    foreach($chunk as $course){
                        $countryid =$course->country_id;
                        $specializeid=$course->specialization_id;
                        $autherid=$course->user_id;
                        $country =Country::find($countryid);
                        $specialization=Specialization::find($specializeid);
                        $author=User::find($autherid);
                        $course['country_id']= $country ? $country->name : 'Unknown Country';
                        $course['specialization_id']= $specialization ? $specialization->name : 'Unknown Specialization';
                        $course['user_id']= $author ? $author->name : 'Unknown Author';



                        $courses[] = $course;

                    }
                });


            return collect($courses)->flatten();
        }

        return null;
    }
}
