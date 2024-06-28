<?php

namespace App\Requests\LiveWedget;

use App\Requests\BaseRequestFormApi;

class LiveValidation extends BaseRequestFormApi
{
    // Determine the rules for the live process API:
    public function rules() : array
    {
        return [
            "title" => 'required|string|max:255',
            "time_start" => 'required|date_format:H:i',
            "date_start" => 'required|date',
            "code" => 'required',
            "specialization_id" => 'required|integer',

        ];

    }
}
