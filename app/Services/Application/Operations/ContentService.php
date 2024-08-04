<?php

namespace App\Services\Application\Operations;

use App\Models\content;

class ContentService{
    public function getallcontents($courseid){

        $contents = [];

        Content::where('course_id',$courseid)
            ->where('status','accepted')

            ->chunk(10, function($chunk) use(&$contents){

            foreach($chunk as $content){
                $contents[] = $content;
            }
        });
        return $contents;
    }

    public function getcontent(int $id){
        return Content::find($id)->first();
    }

    public function createcontent($data){

        $content =Content::create($data);
        return $content;
    }

    public function updatecontent($id,$data){
        $content = Content::where('id', $id)->first();
        $content->update($data);
        $content->save();

        return $content;
    }

    public function deletecontent($id){
        $content=$this->getcontent($id);
        Content::where('id', $id)->delete();

        return $content;

    }
}
