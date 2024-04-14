<?php

//use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\CodeCheckController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\GetCountryController;
use App\Http\Controllers\User\GetSpecializationController;
//use App\Http\Controllers\CRUD_OperationController;
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
    Route::post('/', [ProfileController::class, 'updateProfileInfo']);
    Route::delete('/', [ProfileController::class, 'deleteImage']);
});

//General API:
Route::get('getCountries', [GetCountryController::class, 'getCountries']);
Route::get('getSpecializations', [GetSpecializationController::class, 'getSpecializations']);

//reset password via email
Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();});

//testing controller
Route::post('/index', [\App\Http\Controllers\testController::class, 'index']);
