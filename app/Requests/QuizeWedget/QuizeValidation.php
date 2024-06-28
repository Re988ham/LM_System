<?php

namespace App\Requests\QuizeWedget;

use App\Requests\BaseRequestFormApi;

class QuizeValidation extends BaseRequestFormApi
{
    // Determine the rules for the live process API:
    public function rules() : array
    {
        return [
            "name" => 'required|string|max:255',
            "question_number" => 'required|integer',
            "specialization_id" => 'required|integer',
           // "questions"=>'required|array',

        ];

    }
}
