<?php

namespace App\Requests;

class ProfileValidation extends BaseRequestFormApi
{
    //Determine the rules for the registeration process:
    public function rules(): array
    {
        $rules = [];

        if (array_key_exists('mobile_number', $this->request()->all())) {
            $rules['mobile_number'] = 'numeric';
        }

        if (array_key_exists('address', $this->request()->all())) {
            $rules['address'] = '';
        }

        return $rules;
    }
}
