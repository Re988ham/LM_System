<?php

namespace App\Requests\Dashboard;

use App\Requests\BaseRequestFormApi;
use Illuminate\Validation\Rule;

class LoginValidator extends BaseRequestFormApi
{
    // Determine the rules for the registration process dashboard:
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            //'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
