<?php

namespace App\Requests\Dashboard;

use App\Requests\BaseRequestFormApi;
use Illuminate\Validation\Rule;

class RegisterValidator extends BaseRequestFormApi
{
    // Determine the rules for the registration process dashboard:
    public function rules(): array
    {
        return [
       //     dd($request->date);

            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted'],
            'address' => ['required', 'max:50'],
            'mobile_number' => ['required', 'digits:10', 'starts_with:09', 'unique:users,mobile_number'],
            'gender' => ['required', 'in:male,female'],
            'date' => ['required'],];
//            'image' => ['required', 'image', 'max:2048', 'mimes:jpeg,png'],];
            // 'date' => ['required', 'date_format:Y-m-d'],
    }
}
