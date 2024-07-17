<?php

namespace App\Http\Controllers\User\Operation;

use App\Http\Controllers\Controller;
use App\Requests\Operations\CourseValidation;
use App\Services\GeneralServices\EnrollmentService;
use App\Services\GeneralServices\ResponseService;
use App\Services\Operations\CourseService;

class CourseController extends Controller
{
    public EnrollmentService $enrollmentService;
    public ResponseService $responseService;
    public CourseService $courseService;

    public function __construct(ResponseService $responseService, CourseService $courseService,EnrollmentService $enrollmentService)
    {
        $this->courseService = $courseService;
        $this->ResponseService = $responseService;
        $this->enrollmentService = $enrollmentService;
    }

    public function index($specializeid)
    {
        $response = $this->courseService->getallcourses($specializeid);
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

    public function enrollment($course_id)
    {
        $response = $this->enrollmentService->store_Enrollment($course_id);
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }
}
