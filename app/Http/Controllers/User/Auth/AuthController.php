<?php
namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\BaseController;
use App\Requests\AuthRequests\LoginValidation;
use App\Requests\AuthRequests\RegisterValidation;
use App\Services\Application\AuthServices\LoginService;
use App\Services\Application\AuthServices\LogoutService;
use App\Services\Application\AuthServices\RegisterService;
use Illuminate\Http\Request;

class AuthController extends BaseController
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

    public function register(RegisterValidation $registerValidation)
    {
        if (!empty($registerValidation->getErrors())) {
            return response()->json($registerValidation->getErrors(), 406);
        }

        $user = $this->registerService->registerUser($registerValidation->request()->all());


        $message = [
            'user' => $user[0],
            'similar images' => $user[1],
        ];

        return $this->sendResponse($message);
    }

    public function login(LoginValidation $loginValidation)
    {
        if (!empty($loginValidation->getErrors())) {
            return response()->json($loginValidation->getErrors(), 406);
        }

        $user = $this->loginService->loginUser($loginValidation->request()->all());
        if ($user) {
            $message = "You logged in successfully";
            $token = $user->createToken('AppName')->plainTextToken;
            return $this->sendResponse([
                'message' => $message,
                'token' => $token,
                'role_id' => $user->role_id
            ]);
        } else {
            return $this->sendError('Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        $response = $this->logoutService->logoutUser();
        if ($response) {
            return $this->sendResponse("Logout successfully.", 204);
        } else {
            return $this->sendError("Something went wrong!");
        }
    }
}
