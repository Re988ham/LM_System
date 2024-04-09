<?php

namespace App\Http\Controllers\DashboardControllers\Auth;

use App\Http\Controllers\BaseController;
use App\Requests\LoginValidation;
use App\Requests\RegisterValidation;
use App\Services\LoginService;
use App\Services\LogoutService;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;



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

        //verfication by email
        $this->middleware('guest')->except([
            'logout', 'home'
        ]);
        $this->middleware('auth')->only('logout', 'home');
        $this->middleware('verified')->only('home');
    }

    //Sign up function:
    public function signUp()
    {
        return view('admin/auth/register');
    }

    // Register Function:
    public function register(RegisterValidation $registerValidation)
    {
        if (!empty($registerValidation->getErrors())) {
            $errors = $registerValidation->getErrors();
            return redirect()->back()
                ->withErrors($errors)
                ->withInput($registerValidation->request()->all());
        }

        $user = $this->registerService->registerUser($registerValidation->request()->all());

        $message['user'] = $user->toArray();
        $message['user']['role_id'] = 3;
        if ($user) {
            return redirect()->route('dashboard');
        }

        // verfication by email
//        event(new Registered($user));
//
//        $credentials = $request->only('email', 'password');
//        Auth::attempt($credentials);
//        $request->session()->regenerate();
//        return redirect()->route('verification.notice');
    }

    //Sign in function:
    public function signIn()
    {
        return view('admin/auth/login');
    }

    // Login Function:
    public function login(LoginValidation $loginValidation)
    {
        if (!empty($loginValidation->getErrors())) {
            $errors = $loginValidation->getErrors();
            return redirect()
                ->route('signIn')
                ->withErrors($errors)
                ->withInput($loginValidation->request()->all());
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
    public function logout()
    {
        Auth::logout();

        return redirect()->route('signIn')->with(['success'=>'You\'ve been logged out.']);
    }
}
