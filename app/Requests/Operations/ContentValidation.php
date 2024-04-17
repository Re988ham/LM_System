<?php

namespace App\Requests\Operations;

use App\Requests\BaseRequestFormApi;

class ContentValidation extends BaseRequestFormApi
{
    // Determine the rules for the registration process API:
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:100',
            'course_id' => 'required|int',
            'url' => 'required',//['required','url', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'type' => 'required|in:video,document',
        ];

    }
}
