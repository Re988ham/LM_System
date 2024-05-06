<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sendnotify;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\CodeCheckController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\HomeWedget\LastTenController;
use App\Http\Controllers\User\HomeWedget\TapBarController;
use App\Http\Controllers\User\Operation\ContentController;
use App\Http\Controllers\User\Operation\CourseController;
use App\Http\Controllers\User\Operation\SearchController;
use App\Http\Controllers\User\Registering\GetCountryController;
use App\Http\Controllers\User\Registering\GetSpecializationController;
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
Route::prefix('password')->group(function () {
    Route::post('/email',  ForgotPasswordController::class);
    Route::post('/code/check', CodeCheckController::class);
    Route::post('/reset', ResetPasswordController::class);
});

//Course API:
Route::middleware('auth:sanctum')->prefix('course')->group(function () {
    Route::get('/show/{specializeid}', [CourseController::class, 'index']);
    Route::post('/create', [CourseController::class, 'store']);
    Route::post('/update/{id}', [CourseController::class, 'update']);
    Route::post('/delete/{id}', [CourseController::class, 'delete']);
});

//content API:
Route::middleware('auth:sanctum')->prefix('content')->group(function () {
    Route::get('/show/{courseid}', [ContentController::class, 'index']);
    Route::post('/create', [ContentController::class, 'store']);
    Route::post('/update/{id}', [ContentController::class, 'update']);
    Route::post('/delete/{id}', [ContentController::class, 'delete']);
});
//Home Wedget API
Route::middleware('auth:sanctum')->prefix('Home')->group(function () {
    Route::get('/last_updated_courses', [LastTenController::class, 'GetUpdatedcourses']);
    Route::get('/trend_Country_courses', [LastTenController::class, 'TrendCoursesInHisCountry']);
    Route::get('/rand_related_courses', [LastTenController::class, 'RandomRelatedCourses']);
    Route::get('/Getvideos_tapbar', [TapBarController::class, 'GetVideos']);
    Route::get('/Getdocuments_tapbar', [TapBarController::class, 'GetDocuments']);

});
//searching in course
Route::middleware('auth:sanctum')->group(function () {
Route::get('/search',[SearchController::class,'search']);

});
//send notification to mobile
Route::post('/send_notify', [sendnotify::class, 'sendWebNotification']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();});

//testing controller
Route::post('/index', [\App\Http\Controllers\testController::class, 'index']);
