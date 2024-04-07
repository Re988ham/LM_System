<?php

namespace App\Requests;

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
            "role_id" => "required",
           "specialization_id" =>'nullable|max:5|array',


        ];
    }
}
