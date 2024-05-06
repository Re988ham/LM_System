<?php

namespace App\Http\Controllers\User\HomeWedget;

use App\Http\Controllers\Controller;
use App\Services\Homewedget\LastTenService;
use App\Services\ResponseService;

class LastTenController extends Controller
{
    public LastTenService $lasttenservice;
    public ResponseService $responseService;
    public function __construct(LastTenService $lastTenService,ResponseService $responseService)
    {
        $this->lasttenservice=$lastTenService;
        $this->responseService=$responseService;
    }

    public function GetUpdatedcourses(){
        $courses=$this->lasttenservice->UpdatedCourses();

        if (!empty($courses)) {
            return $this->responseService->sendResponse($courses);
        } else {
            return $this->responseService->sendResponse("There aren't courses currently!");
        }

    }

    public function TrendCoursesInHisCountry(){
        $courses=$this->lasttenservice->TrendCoursesInHisCountry();

        if (!empty($courses)) {
            return $this->responseService->sendResponse($courses);
        } else {
            return $this->responseService->sendResponse("There aren't courses currently!");
        }

    }

    public function RandomRelatedCourses(){
        $courses=$this->lasttenservice->randCourses();

        if (!empty($courses)) {
            return $this->responseService->sendResponse($courses);
        } else {
            return $this->responseService->sendResponse("There aren't courses currently!");
        }

    }

}
