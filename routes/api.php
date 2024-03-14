<?php

//use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Authentication API:
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('sanctum');
});


//Profile API:
Route::middleware('sanctum')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'showProfileInfo']);
    // Route::put('/', [ProfileController::class, 'updateProfileInfo']);
});


// Route::get('auth/google/callback', SocialiteController::class, 'handleGoogleCallback');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
