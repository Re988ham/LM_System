<?php

namespace App\Requests\QuizWedget;

use App\Requests\BaseRequestFormApi;

class QuizValidation extends BaseRequestFormApi
{
    // Determine the rules for the live process API:
    public function rules() : array
    {
        return [
            "title" => 'required|string|max:255',
            "question_number" => 'required|integer',
            "course_id" => 'required|integer',
           // "questions"=>'required|array',

        ];

    }
}
