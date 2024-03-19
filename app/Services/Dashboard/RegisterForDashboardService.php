<?php

namespace App\Services\Dashboard;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterForDashboardService
{

    // Service of register process in dashboard:

    public function RegisterAdmin(array $attributes):RedirectResponse
    {
        static $role_id = 2;
        $attributes['password'] = bcrypt($attributes['password']);

        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        $user->update(['role_id' => $role_id]);
        Auth::login($user);

        return redirect('/dashboard');
    }
}
