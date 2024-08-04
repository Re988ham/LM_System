<?php

namespace App\Http\Controllers\User\LiveWedget;

use App\Http\Controllers\Controller;
use App\Requests\LiveWedget\LiveValidation;
use App\Services\Application\LivesWedget\LiveService;
use App\Services\GeneralServices\ResponseService;

class LiveController extends Controller
{
    public LiveService $liveService;
    public ResponseService $ResponseService;
    public function __construct(ResponseService $ResponseService,LiveService $liveService)
    {
        $this->LiveService = $liveService;
        $this->ResponseService = $ResponseService;
    }
    public function create(LiveValidation $livedata){
        if (!empty($livedata->getErrors())) {
            return response()->json($livedata->getErrors(), 406);
        }

        $response = $this->LiveService->createlive($livedata->request()->all());
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }




    }

    public function show()
    {
        $response = $this->LiveService->getlives();
        return $this->ResponseService->sendResponse($response);
    }
}
