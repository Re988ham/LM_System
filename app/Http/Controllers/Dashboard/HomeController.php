<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function billing()
    {
        return view('billing');
    }

    public function profile()
    {
        return view('profile');
    }

    public function rtl()
    {
        return view('rtl');
    }

    public function userManagement()
    {
        return view('laravel-examples/user-management');
    }

    public function tables()
    {
        return view('tables');
    }

    public function virtualReality()
    {
        return view('virtual-reality');
    }

    public function signIn()
    {
        return view('static-sign-in');
    }

    public function signUp()
    {
        return view('static-sign-up');
    }
}
