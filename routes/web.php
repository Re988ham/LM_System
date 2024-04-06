<?php

// use App\Http\Controllers\Dashboard\ChangePasswordController;
// use App\Http\Controllers\Dashboard\InfoUserController;
// use App\Http\Controllers\Dashboard\RegisterController;
// use App\Http\Controllers\Dashboard\ResetController;
// use App\Http\Controllers\Dashboard\SessionsController;
// use App\Http\Controllers\GoogleLoginController;


use App\Http\Controllers\DashboardControllers\Auth\WebAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardControllers\HomeController;

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

Route::get('/', [HomeController::class, 'home']);
Route::get('/', function () {
    return view('welcome');
})->name('welcome');;

Route::get('dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard');

//Authentication API:
Route::controller(WebAuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::get('signUp', 'signUp')->name('signUp');
    Route::get('signIn', 'signIn')->name('signIn');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
});
