<?php

namespace App\Requests\Operations;

use App\Requests\BaseRequestFormApi;

class CourseValidation extends BaseRequestFormApi
{
    // Determine the rules for the registration process API:
    public function rules(): array
    {
        return [
            "name"=> 'required|string|min:5|max:100',
            "specialization_id",
            "description"=>'required|string|min:10|max:2000',
            "status"=>'required',
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif",
            "country_id"=>"required",
        ];
    }
}
