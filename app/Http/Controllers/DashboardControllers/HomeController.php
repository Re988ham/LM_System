<?php

namespace App\Http\Controllers\DashboardControllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function home()
    {
        return redirect('dashboard');
    }
}
