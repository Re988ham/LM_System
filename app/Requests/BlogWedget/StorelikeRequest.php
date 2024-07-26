<?php

namespace App\Requests\BlogWedget;

use App\Requests\BaseRequestFormApi;

class StorelikeRequest extends BaseRequestFormApi
{
    public function rules():array
    {
        return [
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
