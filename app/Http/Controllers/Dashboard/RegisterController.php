<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('dashboard.session.register');
    }

    public function store(Request $request)
    {
//        dd($request->date);
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted'],
            'address' => ['required', 'max:50'],
            'mobile_number' => ['required', 'digits:10', 'starts_with:09', 'unique:users,mobile_number'],
            'gender' => ['required', 'in:male,female'],
            'date' => ['required'],
//            'image' => ['required', 'image', 'max:2048', 'mimes:jpeg,png'],
        ]);
        static $role_id =2;
        $attributes['password'] = bcrypt($attributes['password']);
        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        $user->update(['role_id' => $role_id]);
        Auth::login($user);
        return redirect('/dashboard');
    }
}
