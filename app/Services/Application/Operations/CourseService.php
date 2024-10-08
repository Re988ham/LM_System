<?php

namespace App\Services\Application\Operations;

use App\Models\Country;
use App\Models\course;
use App\Models\Specialization;
use App\Models\User;
use App\Services\GeneralServices\ImageService;
use App\Services\GeneralServices\NotificationService;
use Illuminate\Support\Facades\Auth;

class CourseService{
    public function getallcourses(){
        $autherid = Auth::user()->id;
        $courses = [];

        Course::where('user_id',$autherid)
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
        return $courses;
    }
    public function getcourse(int $id){
        return Course::find($id)->first();
    }

    public function createcourse($data)
    {
        $destinationPath ='/images/courses/';
       $userid = Auth::user()->id;

        if (isset($data['image'])) {
            $data['image'] = ImageService::saveImage($data['image'],$destinationPath );
        }
        $data['user_id']=$userid;
        $user_name = User::find($data['user_id']);
        $notificationService = new NotificationService();
        $notificationService->send('EDUspark', "{$user_name->name} added a new course ");

        $course = Course::create($data);
        return $course;
    }


    public function updatecourse($id,$data){
        $course = Course::where('id', $id)->first();
        $course->update($data);
        $course->save();

        return $course;
    }

    public function deletecourse($id){
        $course=$this->getcourse($id);

        Course::where('id', $id)->delete();

        return 'the course is deleted successfully';
    }
}
