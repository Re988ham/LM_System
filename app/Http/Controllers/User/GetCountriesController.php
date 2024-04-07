<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Models\Country;

class GetCountriesController extends BaseController
{

    public function getCountries()
{
    $countries = Country::orderBy('name')->get();

    if ($countries->count() > 0) {
        return $this->sendResponse($countries);
    } else {
        return $this->sendError("Something went wrong!!");
    }
}
}
