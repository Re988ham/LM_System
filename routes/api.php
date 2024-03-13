<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;

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
});
//Profile API:

Route::prefix('profile')->group(function () {
    Route::get('/{user_id}', [ProfileController::class, 'showProfileInfo']);
    //  Route::put('/{user_id}', [UserController::class, 'updateProfileInfo']);
});


// Route::get('auth/google/callback', SocialiteController::class, 'handleGoogleCallback');




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
