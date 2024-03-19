<?php

namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class LoginForDashboardService
{

    // Service of LoginAdmin process in dashboard:

    public function LoginAdmin(array $attributes)
    {
        if (Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('/dashboard');
        }


        else {

            return back()->withErrors(['email' => 'Email or password invalid.']);
        }


    }
}
