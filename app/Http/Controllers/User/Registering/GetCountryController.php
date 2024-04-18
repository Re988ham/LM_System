<?php

namespace App\Http\Controllers\User\Registering;
use App\Http\Controllers\BaseController;
use App\Models\Country;


class GetCountryController extends BaseController
{

    public function getCountries()
    {
        $countries = [];

        Country::chunk(10, function ($chunkedCountries) use (&$countries) {
            foreach ($chunkedCountries as $country) {
                $countries[] = $country;
            }
        });

        if (!empty($countries)) {
            return $this->sendResponse($countries);
        } else {
            return $this->sendError("Something went wrong!!");
         }
    }

}
