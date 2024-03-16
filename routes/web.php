<?php

use App\Http\Controllers\Dashboard\ChangePasswordController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\InfoUserController;
use App\Http\Controllers\Dashboard\RegisterController;
use App\Http\Controllers\Dashboard\ResetController;
use App\Http\Controllers\Dashboard\SessionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('billing', 'billing')->name('billing');
        Route::get('profile', 'profile')->name('profile');
        Route::get('rtl', 'rtl')->name('rtl');
        Route::get('user-management', 'userManagement')->name('user-management');
        Route::get('tables', 'tables')->name('tables');
        Route::get('virtual-reality', 'virtualReality')->name('virtual-reality');
        Route::get('static-sign-in', 'signIn')->name('sign-in');
        Route::get('static-sign-up', 'signUp')->name('sign-up');
    });

    Route::controller(InfoUserController::class)->group(function () {
        Route::get('/user-profile', 'create');
        Route::post('/user-profile', 'store');
    });

    Route::get('/logout', [SessionsController::class, 'destroy']);

    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
