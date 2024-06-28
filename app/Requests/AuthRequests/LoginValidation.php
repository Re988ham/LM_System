<?php

namespace App\Requests\AuthRequests;

use App\Requests\BaseRequestFormApi;

class LoginValidation extends BaseRequestFormApi
{
    // Determine the rules for the login process:
    public function rules(): array
    {
        return [
            "email" => 'required|email',
            "password" => 'required|min:6|max:100',
        ];
    }
}
