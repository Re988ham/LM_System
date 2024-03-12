<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Requests\LoginValidation;
use App\Requests\RegisterValidation;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Models\User;



class AuthController extends BaseController
{

    public RegisterService $registerService;
    public LoginService $loginService;

    public function __construct(RegisterService $registerService, LoginService $loginService)
    {
        $this->registerService = $registerService;
        $this->loginService = $loginService;
    }

    //Register Function:
    public function register(RegisterValidation $registerValidation)
{
    if (!empty($registerValidation->getErrors())) {
        return response()->json($registerValidation->getErrors(), 406);
    }

    $user = $this->registerService->registerUser($registerValidation->request()->all());

    $message['user'] = $user->toArray();
    $message['user']['role_id'] = 3;
    // User::find('role_id');
    $message['token'] = $user->createToken('AppName')->plainTextToken;

    return $this->sendResponse($message);
}


    //Login Function:
    public function login(LoginValidation $loginValidation)
    {
        if (!empty($loginValidation->getErrors())) {
            return response()->json($loginValidation->getErrors(), 406);
        } else {
            $user = $this->loginService->loginUser($loginValidation->request()->all());
            if ($user) {
                $message = "You Logged in Successfully";
                $token = $user->createToken('AppName')->plainTextToken;
                return $this->sendResponse(['message' => $message, 'token' => $token]);
            } else {
                $message = "Invalid credentials";
                return $this->sendError("$message" );
            }
        }
    }
}
