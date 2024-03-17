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
        return view('dashboard/dashboard');
    }

    public function billing()
    {
        return view('dashboard/billing');
    }

    public function profile()
    {
        return view('dashboard/profile');
    }

    public function rtl()
    {
        return view('dashboard/rtl');
    }

    public function userManagement()
    {
        return view('dashboard/laravel-examples/user-management');
    }

    public function tables()
    {
        return view('dashboard/tables');
    }

    public function virtualReality()
    {
        return view('dashboard/virtual-reality');
    }

    public function signIn()
    {
        return view('dashboard/static-sign-in');
    }

    public function signUp()
    {
        return view('dashboard/static-sign-up');
    }
}
