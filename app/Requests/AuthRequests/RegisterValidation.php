<?php

namespace App\Requests\AuthRequests;

use App\Requests\BaseRequestFormApi;

class RegisterValidation extends BaseRequestFormApi
{
    // Determine the rules for the registration process API:
    public function rules(): array
    {
        return [
            "name" => 'required|min:2|max:20',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:6|max:100',
            "confirm_password" => 'required|same:password',
            "country_id" => 'required',
            "mobile_number" => 'required|numeric|unique:users',
            "gender" => 'required',
            "birth_date" => 'required',
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif",
            "specialization_id" => "nullable|array|max:5",
            "role_id" =>'required'

        ];
    }
}
