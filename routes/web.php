<?php

//use App\Http\Controllers\Dashboard\Auth\VerificationController;
use App\Http\Controllers\DashboardControllers\Auth\WebAuthController;
use App\Http\Controllers\DashboardControllers\EmailController;
use App\Http\Controllers\DashboardControllers\HomeController;
use App\Http\Controllers\GoogleLoginController;
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

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

//// Define Custom Verification Routes
//Route::controller(VerificationController::class)->group(function() {
//    Route::get('/email/verify', 'notice')->name('verification.notice');
//    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
//    Route::post('/email/resend', 'resend')->name('verification.resend');
//});



Route::get('/send-email', [EmailController::class, 'index']);
