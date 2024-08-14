<?php

namespace App\Http\Controllers\User\QuizWedget;

use App\Http\Controllers\Controller;
use App\Requests\QuizWedget\QuizValidation;
use App\Services\Application\QuizService\QuizService;
use App\Services\GeneralServices\ResponseService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public QuizService $QuizService;
    public ResponseService $responseService;

    public function __construct(ResponseService $responseService, QuizService $QuizService)
    {
        $this->QuizService = $QuizService;
        $this->responseService = $responseService;
    }

    public function create(QuizValidation $QuizValidation)
    {
        if (!empty($QuizValidation->getErrors())) {
            return response()->json($QuizValidation->getErrors(), 406);
        }

        $response = $this->QuizService->createQuiz($QuizValidation->request()->all());

        if (!empty($response)) {
            return $this->responseService->sendResponse($response);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }

    public function getQuizzes()
    {
        $Quizzes = $this->QuizService->getQuizzes();
        if (!empty($Quizzes)) {
            return $this->responseService->sendResponse($Quizzes);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }

    public function getQuestions($id)
    {
        $questions = $this->QuizService->getQuestions($id);
        if (!empty($questions)) {
            return $this->responseService->sendResponse($questions);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }

    public function sendcertification(Request $request): \Illuminate\Http\JsonResponse
    {
        $certification = $this->QuizService->make_certification($request);

        if (!empty($certification)) {
            return $this->responseService->sendResponse($certification);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }

    public function getmycourses()
    {
        $response = $this->QuizService->get_my_courses();

        if (!empty($response)) {
            return $this->responseService->sendResponse($response);
        } else {
            return $this->responseService->sendError("No courses found.");
        }

    }

}
