<?php

namespace App\Http\Controllers\User\Sidebar;

use App\Http\Controllers\Controller;
use App\Services\Application\Sidebar\SidebarService;
use App\Services\GeneralServices\ResponseService;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public SidebarService $sidebarService;
    public ResponseService $responseService;


    public function __construct(ResponseService $responseService, SidebarService $sidebarService)
    {
        $this->SidebarService = $sidebarService;
        $this->ResponseService = $responseService;
    }


    public function getmycourses()
    {
        $response = $this->SidebarService->getmycourses();
        return $this->ResponseService->sendResponse($response);
    }

    public function getlibrarycontent()
    {
        $response = $this->SidebarService->getlibrarycontent();
        return $this->ResponseService->sendResponse($response);
    }

    public function getmyXPs()
    {
        $response = $this->SidebarService->getmyxp();
        return $this->ResponseService->sendResponse($response);
    }

    public function updatemyxp($xp)
    {
        $response = $this->SidebarService->updatemyxp($xp);
        return $this->ResponseService->sendResponse($response);
    }

    public function getmylibrary()
    {
        $response = $this->SidebarService->getmylibrary();
        return $this->ResponseService->sendResponse($response);
    }
    public function librarypaying($book_id): \Illuminate\Http\JsonResponse
    {

        $response = $this->SidebarService->payfromlibrary($book_id);
        if (!empty($response)) {
            return $this->ResponseService->sendResponse($response);
        } else {
            return $this->ResponseService->sendError("Something went wrong!!");
        }
    }

    public function refundFromMyLibrary($book_id)
    {
        $response = $this->SidebarService->refundFromMyLibrary($book_id);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 400);
        }

        return response()->json([
            'my_library' => $response['my_library'],
            'current_balance' => $response['current_balance'],
            'message' => $response['message']
        ], 200);
    }

}
