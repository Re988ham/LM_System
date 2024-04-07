<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Models\Specialization;


class GetSpecializationController extends BaseController
{

    public function getSpecializations()
    {
        $specializations = Specialization::all();
        if ($specializations) {

            return $this->sendResponse($specializations);
        } else {
            return $this->sendError("Something went wrong!!");
        }
    }
}
