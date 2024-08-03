<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;

class HomeController extends Controller
{

    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard()
    {
        $counts = $this->dashboardService->getCounts();
        $specializations = $this->dashboardService->getLatestSpecializations();
        $courses = $this->dashboardService->getTop6Courses();
        return view('dashboard/dashboard', compact(
            'counts', 'specializations', 'courses'
        ));
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
