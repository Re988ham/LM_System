<?php

namespace App\Http\Controllers\DashboardControllers\Auth;

use App\Http\Controllers\BaseController;
use App\Requests\LoginValidation;
use App\Requests\RegisterValidation;
use App\Services\LoginService;
use App\Services\LogoutService;
use App\Services\RegisterService;
use Illuminate\Http\Request;


class WebAuthController extends BaseController
{

    public RegisterService $registerService;
    public LoginService $loginService;
    public LogoutService $logoutService;

    public function __construct(RegisterService $registerService, LoginService $loginService, LogoutService $logoutService)
    {
        $this->registerService = $registerService;
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }

    // Register Function:
    public function register(RegisterValidation $registerValidation)
    {
        if (!empty($registerValidation->getErrors())) {
            $errors = $registerValidation->getErrors();
            return view('admin/auth/register', ['errors' => $errors]);
        }

        $user = $this->registerService->registerUser($registerValidation->request()->all());
        $message['user'] = $user->toArray();
        $message['user']['role_id'] = 3;
        if ($user) {
            return redirect()->route('dashboard');
        }
    }

    //Sign up function:
    public function signUp()
    {
        return view('admin/auth/register');
    }

 //Sign in function:
 public function signIN()
 {
     return view('admin/auth/login');
 }
    // Login Function:
    public function login(LoginValidation $loginValidation)
    {
        if (!empty($loginValidation->getErrors())) {
            $errors = $loginValidation->getErrors();
            return view('welcome', ['errors' => $errors]);
        } else {
            $user = $this->loginService->loginUser($loginValidation->request()->all());
            if ($user) {
                return redirect()->route('dashboard');
            } else {
                $errors = ['login' => "Invalid credentials"];
                return view('welcome', ['errors' => $errors]);
            }
        }
    }


    // Logout Function:
    public function logout(Request $request)
    {
        $response = $this->logoutService->logoutUser();
        if ($response) {
            $message = "Logout Successfully.";
            return $this->sendResponse($message, 204);
        } else {
            $message = "Something goes wrong!!";
            return $this->sendError($message);
        }
    }
}
