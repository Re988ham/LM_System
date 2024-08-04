<?php

namespace App\Http\Controllers\User\Operation;

use App\Http\Controllers\Controller;
use App\Requests\Operations\contentValidation;
use App\Services\Application\Operations\contentService;
use App\Services\GeneralServices\ResponseService;

class ContentController extends Controller
{
    public ResponseService $responseService;
    public contentService $contentService;

    public function __construct(ResponseService $responseService, contentService $contentService)
    {
        $this->contentService = $contentService;
        $this->ResponseService = $responseService;
    }

    public function index($courseid)
    {
        $response = $this->contentService->getallcontents($courseid);
        return $this->ResponseService->sendResponse($response);
    }

    public function store(contentValidation $contentValidation)
    {
        if (!empty($contentValidation->getErrors())) {
            return response()->json($contentValidation->getErrors(), 406);
        }
        $response = $this->contentService->createcontent($contentValidation->request()->all());
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function update($id, contentValidation $contentValidation)
    {
        if (!empty($contentValidation->getErrors())) {
            return response()->json($contentValidation->getErrors(), 406);
        }
        $response = $this->contentService->updatecontent($id, $contentValidation->request()->all());
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
        $response = $this->contentService->deletecontent($id);
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

}
