<?php

namespace App\Requests\Operations;

use Illuminate\Foundation\Http\FormRequest;

class SearchValidation extends FormRequest
{
    public function rules()
    {
        return [
            'query' => 'required', // Validate query input
        ];
    }

}
