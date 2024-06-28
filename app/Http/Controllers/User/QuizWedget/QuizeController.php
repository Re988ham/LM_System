<?php

namespace App\Http\Controllers\User\QuizWedget;

use App\Http\Controllers\Controller;
use App\Requests\QuizeWedget\QuizeValidation;
use App\Services\GeneralServices\ResponseService;
use App\Services\QuizeService\QuizeService;

class QuizeController extends Controller
{
    public QuizeService $quizeService;
    public ResponseService $responseService;

    public function __construct(ResponseService $responseService,QuizeService $quizeService)
    {
        $this->QuizeService =$quizeService;
        $this->ResponseService = $responseService;
    }
    public function create(QuizeValidation $quizeValidation){

        if(!empty($quizeValidation->getErrors())){
            return response()->json($quizeValidation->getErrors(),406);
        }
        $response = $this->QuizeService->createQuize($quizeValidation->request()->all());

        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function getquizes()
    {
        $quizes = $this->QuizeService->getQuizes();
        if (!empty($quizes)) {
            return $this->ResponseService->sendResponse($quizes);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function getQuestions($id)
    {
        $questions = $this->QuizeService->getQuestions($id);
        if (!empty( $questions)) {
            return $this->ResponseService->sendResponse($questions);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }
}
