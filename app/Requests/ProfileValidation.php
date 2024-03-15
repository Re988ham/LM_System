<?php

namespace App\Requests;

class ProfileValidation extends BaseRequestFormApi
{
    //Determine the rules for the registeration process:
    public function rules(): array
    {
        $rules = [];
        $userId = auth('sanctum')->user()->id;
        if (array_key_exists('mobile_number', $this->request()->all())) {
            // $rules['mobile_number'] = 'numeric|unique:users';
            $rules['mobile_number'] = 'numeric|unique:users,mobile_number,' . $userId;
        }

        if (array_key_exists('address', $this->request()->all())) {
            $rules['address'] = '';
        }

        return $rules;
    }
}
