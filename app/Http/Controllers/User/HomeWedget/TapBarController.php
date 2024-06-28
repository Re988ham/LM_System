<?php

namespace App\Http\Controllers\User\HomeWedget;

use App\Http\Controllers\Controller;
use App\Services\GeneralServices\ResponseService;
use App\Services\Homewedget\GetFromContentService;

class TapBarController extends Controller
{
    public GetFromContentService $GetFromContentService;
    public ResponseService $responseService;

    public function __construct(GetFromContentService $GetFromContentService,ResponseService $responseService)
    {
        $this->GetFromContentService= $GetFromContentService;
        $this->responseService=$responseService;
    }

    public function GetCourses(){
        $courses=$this->GetFromContentService->Getcourses();

        if (!empty($courses)) {
            return $this->responseService->sendResponse($courses);
        } else {
            return $this->responseService->sendResponse("There aren't courses currently!");
        }

    }

    public function GetVideos(){
        $randVideo=$this->GetFromContentService->Getvideos();

        if (!empty($randVideo)) {
            return $this->responseService->sendResponse($randVideo);
        } else {
            return $this->responseService->sendResponse("There aren't videos currently!");
        }

    }

    public function GetDocuments(){
        $randdocument=$this->GetFromContentService->Getdocuments();

        if (!empty($randdocument)) {
            return $this->responseService->sendResponse($randdocument);
        } else {
            return $this->responseService->sendResponse("There aren't documents currently!");
        }

    }

}
