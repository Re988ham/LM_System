<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\BaseController;
use App\Models\Country;


class GetCountryController extends BaseController
{

    public function getCountries()
    {
        $countries = Country::all();
        if ($countries) {

            return $this->sendResponse($countries);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }

}
