<?php

namespace App\Requests\BlogWedget;

use App\Requests\BaseRequestFormApi;

class StorePostRequest extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'text' => 'required|string|max:255|min:5',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
