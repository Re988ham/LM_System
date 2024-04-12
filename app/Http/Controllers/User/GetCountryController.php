<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\BaseController;
use App\Models\Country;
use Illuminate\Http\JsonResponse;


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
