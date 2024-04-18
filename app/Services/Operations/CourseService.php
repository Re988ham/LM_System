<?php

namespace App\Services\Operations;

use App\Models\course;
use App\Services\ImageService;

class CourseService{
    public function getallcourses(){

        $courses = [];

        Course::chunk(10, function($chunk) use(&$courses){

            foreach($chunk as $course){
                $courses[] = $course;
            }
        });
        return $courses;
    }
    public function getcourse(int $id){
        return Course::find($id)->first();
    }

    public function createcourse($data){

        if (isset($data['image'])) {
            $destinationPath = public_path('images\\courses\\');
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }
        $course =Course::create($data);
        return $course;
    }

    public function updatecourse($id,$data){
        $course = $this->getcourse($id);
        $course->update($data);
        $course->save();

        return $course;
    }

    public function deletecourse($id){
        $course=$this->getcourse($id);
        Course::where('id', $id)->delete();

        return $course;

    }
}
