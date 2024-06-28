<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sendnotify;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\CodeCheckController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\ChattingWedget\ChattingController;
use App\Http\Controllers\User\HomeWedget\LastTenController;
use App\Http\Controllers\User\HomeWedget\TapBarController;
use App\Http\Controllers\User\Operation\ContentController;
use App\Http\Controllers\User\Operation\CourseController;
use App\Http\Controllers\User\Operation\SearchController;
use App\Http\Controllers\User\QuizWedget\QuizeController;
use App\Http\Controllers\User\Registering\GetCountryController;
use App\Http\Controllers\User\Registering\GetSpecializationController;
use App\Http\Controllers\User\Specializationwedget\SpecializationwedgetController;
use App\Http\Controllers\User\LiveWedget\LiveController;
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

//General APIs:
Route::get('getCountries', [GetCountryController::class, 'getCountries']);
Route::get('getSpecializations', [GetSpecializationController::class, 'getSpecializations']);

//reset password via email:
Route::prefix('password')->group(function () {
    Route::post('/email',  ForgotPasswordController::class);
    Route::post('/code/check', CodeCheckController::class);
    Route::post('/reset', ResetPasswordController::class);
});

//Course mangments  APIs:
Route::middleware('auth:sanctum')->prefix('course')->controller(CourseController::class)->group(function () {
    Route::get('/show/{specializeid}', 'index');
    Route::post('/create', 'store');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'delete');
});

//content mangments APIs:
Route::middleware('auth:sanctum')->prefix('content')->controller(ContentController::class)->group(function () {
    Route::get('/show/{courseid}', 'index');
    Route::post('/create', 'store');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'delete');
});
//Home Wedget APIs
Route::middleware('auth:sanctum')->prefix('Home')->group(function () {
    Route::get('/last_updated_courses', [LastTenController::class, 'GetUpdatedcourses']);
    Route::get('/trend_Country_courses', [LastTenController::class, 'TrendCoursesInHisCountry']);
    Route::get('/rand_related_courses', [LastTenController::class, 'RandomRelatedCourses']);
    Route::get('/Getvideos_tapbar', [TapBarController::class, 'GetVideos']);
    Route::get('/Getdocuments_tapbar', [TapBarController::class, 'GetDocuments']);
    Route::get('/Getcourses_tapbar', [TapBarController::class, 'GetCourses']);

});
//Specialization (category) Wedget APIs:
Route::middleware('auth:sanctum')->controller(SpecializationwedgetController::class)->prefix('Specialization')->group(function () {
    Route::get('/getspecializations', 'getspecialization');
    Route::get('/getcourses/{id}', 'getcoursesbyspeclizationid');
    Route::get('/getcontent/{id}', 'getcontentsbycourseid');
});
//Lives Wedget APIs:
Route::middleware('auth:sanctum')->prefix('live')->controller(LiveController::class)->group(function (){
    Route::get('/getlives','show');
    Route::post('/createlive','create');
});

//Chatting Wedget APIs:
Route::middleware('auth:sanctum')->prefix('chat')->controller(ChattingController::class)->group(function (){
    Route::get('/getusers','show');
});

//Quize Wedget APIs:
Route::middleware('auth:sanctum')->prefix('quize')->controller(QuizeController::class)->group(function (){
    Route::post('/createquize','create');
    Route::get('/getquizes','getquizes');
    Route::get('/getquestions/{id}','getQuestions');
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
