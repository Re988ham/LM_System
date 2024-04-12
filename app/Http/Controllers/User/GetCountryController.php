<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\BaseController;
use App\Models\Country;


class GetCountryController extends BaseController
{

    public function getCountries()
    {
        $countries = [];
        Country::getAllCountries()->each(function ($country) use (&$countries) {
            $countries[] = $country;
        });

        if (!empty($countries)) {
            return $this->sendResponse($countries);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }

}
