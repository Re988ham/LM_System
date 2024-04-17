<?php

namespace App\Http\Controllers\User\Operation;

use App\Http\Controllers\Controller;
use App\Requests\Operations\CourseValidation;
use App\Services\Operations\CourseService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public ResponseService $responseService;
    public CourseService $courseService;

    public function __construct(ResponseService $responseService, CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->ResponseService = $responseService;
    }

    public function index()
    {
        $response = $this->courseService->getallcourses();
        return $this->ResponseService->sendResponse($response);
    }

    public function store(CourseValidation $courseValidation)
    {
        if (!empty($courseValidation->getErrors())) {
            return response()->json($courseValidation->getErrors(), 406);
        }
        $response = $this->courseService->createcourse($courseValidation->request()->all());
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function update($id, CourseValidation $courseValidation)
    {
        if (!empty($courseValidation->getErrors())) {
            return response()->json($courseValidation->getErrors(), 406);
        }
        $response = $this->courseService->updatecourse($id, $courseValidation->request()->all());
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function delete($id)
    {
//        if (!empty($id->getErrors())) {
//            return response()->json($id->getErrors(), 406);
//        }
        $response = $this->courseService->deletecourse($id);
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

}
