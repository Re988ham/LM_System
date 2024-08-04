<?php

namespace App\Http\Controllers\User\ChattingWedget;

use App\Http\Controllers\Controller;
use App\Services\Application\ChattingWedget\ChattingService;
use App\Services\GeneralServices\ResponseService;

class ChattingController extends Controller
{
    public ChattingService $chattingService;
    public ResponseService $ResponseService;
    public function __construct(ResponseService $ResponseService,ChattingService $chattingService)
    {
        $this->ChattingService = $chattingService;
        $this->ResponseService = $ResponseService;
    }


    public function show()
    {
        $response = $this->ChattingService->getusers();
        return $this->ResponseService->sendResponse($response);
    }
}
