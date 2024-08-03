<?php

namespace App\Http\Controllers\User\Specializationwedget;

use App\Http\Controllers\Controller;
use App\Services\GeneralServices\ResponseService;
use App\Services\Specializationwedget\SpecializationwedgetService;
use Illuminate\Support\Facades\Log;

class SpecializationwedgetController extends Controller
{
    public ResponseService $responseService;
    public SpecializationwedgetService $specializationwedgetService;

    public function __construct(SpecializationwedgetService $specializationwedgetService, ResponseService $responseService)
    {
        $this->specializationwedgetService = $specializationwedgetService;
        $this->responseService = $responseService;
    }

    public function getspecialization()
    {
        try {
            $response = $this->specializationwedgetService->getSpecialization();
            if (!empty($response)) {
                return $this->responseService->sendResponse($response);
            } else {
                return $this->responseService->sendError("No specializations found.", 404);
            }
        } catch (\Exception $e) {
            Log::error("Error in getspecialization: " . $e->getMessage());
            return $this->responseService->sendError("Something went wrong!!", 500);
        }
    }

    public function getcoursesbyspeclizationid($id)
    {
        try {
            $response = $this->specializationwedgetService->getallcoursesbyid($id);
            if (!empty($response)) {
                return $this->responseService->sendResponse($response);
            } else {
                return $this->responseService->sendError("No courses found for this specialization ID.", 404);
            }
        } catch (\Exception $e) {
            Log::error("Error in getcoursesbyspeclizationid: " . $e->getMessage());
            return $this->responseService->sendError("Something went wrong!!", 500);
        }
    }


    public function getcontentsbycourseid($id)
    {
        try {
            $response = $this->specializationwedgetService->getallcontentsbyid($id);
            if (!empty($response)) {
                return $this->responseService->sendResponse($response);
            } else {
                return $this->responseService->sendError("No contents found for this course ID.", 404);
            }
        } catch (\Exception $e) {
            Log::error("Error in getcontentsbycourseid: " . $e->getMessage());
            return $this->responseService->sendError("Something went wrong!!", 500);
        }
    }
}
