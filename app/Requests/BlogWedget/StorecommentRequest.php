<?php

namespace App\Requests\BlogWedget;

use App\Requests\BaseRequestFormApi;

class StorecommentRequest extends BaseRequestFormApi
{
    public function rules() : array
    {
        return [
            'text' => 'required|string|max:255|min:2',
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
