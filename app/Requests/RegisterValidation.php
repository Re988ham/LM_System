<?php

namespace App\Requests;

class RegisterValidation extends BaseRequestFormApi
{
    // Determine the rules for the registration process:
    public function rules(): array
    {
        return [
            "name" => 'required|min:2|max:20',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:6|max:100',
            "confirm_password" => 'required|same:password',
            "address" => 'required',
            "mobile_number" => 'required|numeric',
            "gender" => 'required',
            "date_of_born" => 'required',
            "image" => "nullable|image"
        ];
    }


}
