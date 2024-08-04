<?php

namespace App\Http\Controllers\User\BlogWedget;

use App\Http\Controllers\Controller;
use App\Requests\BlogWedget\StorecommentRequest;
use App\Requests\BlogWedget\StorelikeRequest;
use App\Requests\BlogWedget\StorePostRequest;
use App\Services\Application\BlogWedget\BlogService;
use App\Services\GeneralServices\ResponseService;

class BlogController extends Controller
{
    public BlogService $BlogService;
    public ResponseService $responseService;

    public function __construct(ResponseService $responseService, BlogService $BlogService)
    {
        $this->BlogService = $BlogService;
        $this->responseService = $responseService;
    }

    public function createpost(StorePostRequest $storePostRequest)
    {
        if (!empty($storePostRequest->getErrors())) {
            return response()->json($storePostRequest->getErrors(), 406);
        }

        $response = $this->BlogService->createpost($storePostRequest->request()->all());

        if (!empty($response)) {
            return $this->responseService->sendResponse($response);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }
    public function createcomment(StorecommentRequest $storecommentRequest)
    {
        if (!empty($storecommentRequest->getErrors())) {
            return response()->json($storecommentRequest->getErrors(), 406);
        }

        $response = $this->BlogService->createcomment($storecommentRequest->request()->all());

        if (!empty($response)) {
            return $this->responseService->sendResponse($response);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }
    public function createlike(StorelikeRequest $storelikeRequest)
    {
        if (!empty($storelikeRequest->getErrors())) {
            return response()->json($storelikeRequest->getErrors(), 406);
        }

        $response = $this->BlogService->createlike($storelikeRequest->request()->all());

        if (!empty($response)) {
            return $this->responseService->sendResponse($response);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }
    public function getposts()
    {
        $posts = $this->BlogService->getposts();
        if (!empty($posts)) {
            return $this->responseService->sendResponse($posts);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }

    public function getcomments($post_id)
    {
        $comments = $this->BlogService->getcomments($post_id);
        if (!empty($comments)) {
            return $this->responseService->sendResponse($comments);
        } else {
            return $this->responseService->sendError("Something went wrong!!");
        }
    }
}
