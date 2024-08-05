<?php

use App\Http\Controllers\Dashboard\AdsController;
use App\Http\Controllers\Dashboard\AnswerController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\ContentController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\EnrollmentController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\QuizController;
use App\Http\Controllers\Dashboard\SessionsController;
use App\Http\Controllers\Dashboard\SpecializationController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes: "web" middleware group
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');

        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('billing', 'billing')->name('billing');
        Route::get('profile', 'profile')->name('profile');
        Route::get('rtl', 'rtl')->name('rtl');
        Route::get('tables', 'tables')->name('tables');
        Route::get('static-sign-in', 'signIn')->name('sign-in');
        Route::get('static-sign-up', 'signUp')->name('sign-up');
    });

    ############################# Countries #############################
    Route::controller(CountryController::class)->group(function () {
        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', 'index')->name('admin.countries.index');
            Route::get('/create', 'create')->name('admin.countries.create');
            Route::post('/store', 'store')->name('admin.countries.store');
            Route::get('/edit/{id}', 'edit')->name('admin.countries.edit');
            Route::post('/update', 'update')->name('admin.countries.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.countries.destroy');
        });
    });

    ############################# Specializations #############################
    Route::controller(SpecializationController::class)->group(function () {
        Route::group(['prefix' => 'specializations'], function () {
            Route::get('/', 'index')->name('admin.specializations.index');
            Route::get('/create', 'create')->name('admin.specializations.create');
            Route::post('/store', 'store')->name('admin.specializations.store');
            Route::get('/edit/{id}', 'edit')->name('admin.specializations.edit');
            Route::post('/update', 'update')->name('admin.specializations.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.specializations.destroy');
        });
    });

    ############################# Courses #############################
    Route::controller(CourseController::class)->group(function () {
        Route::group(['prefix' => 'courses'], function () {
            // Basic Courses CRUD
            Route::get('/', 'index')->name('admin.courses.index');
            //Route::get('/show/{id}', 'show')->name('admin.courses.show');
            Route::get('/create', 'create')->name('admin.courses.create');
            Route::post('/store', 'store')->name('admin.courses.store');
            Route::get('/edit/{courseId}', 'edit')->name('admin.courses.edit');
            Route::post('/update', 'update')->name('admin.courses.update');
            Route::get('/destroy/{courseId}', 'destroy')->name('admin.courses.destroy');
            // Extra Operations
            Route::get('/pending', 'pendingCourses')->name('admin.courses.pending');
            Route::get('/accept/{courseId}', 'acceptCourse')->name('admin.course.accept');
            Route::get('/contents/{courseId}', 'showCourseContents')->name('admin.course.contents');
            Route::get('/quizzes/{courseId}/', 'showCourseQuizzes')->name('admin.course.quizzes');
            Route::get('/enrollments/{courseId}/', 'showCourseMembers')->name('admin.course.members');
            Route::get('/enrollments/pending/{courseId}/', 'showCoursePendingMembers')->name('admin.course.pending.members');
        });
    });

    ############################# Contents #############################
    Route::controller(ContentController::class)->group(function () {
        Route::group(['prefix' => 'contents'], function () {
            // Basic Contents CRUD
            //Route::get('/', 'index')->name('admin.contents.index');
            Route::get('/create/{courseId}', 'create')->name('admin.contents.create');
            Route::post('/store', 'store')->name('admin.contents.store');
            Route::get('/edit/{courseId}/{contentId}', 'edit')->name('admin.contents.edit');
            Route::post('/update', 'update')->name('admin.contents.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.contents.destroy');
            // Extra Operations
            Route::get('/accept/{id}', 'acceptContent')->name('admin.content.accept');
        });
    });

    ############################# Course Enrollments/Members #############################
    Route::controller(EnrollmentController::class)->group(function () {
        Route::group(['prefix' => 'enrollments'], function () {
            // Basic Enrollments CRUD
            Route::get('/destroy/{id}', 'destroy')->name('admin.enrollments.destroy');
            // Extra Operations
            Route::get('/accept/{id}', 'acceptContent')->name('admin.enrollments.accept');
        });
    });

    ############################# Quizzes #############################
    Route::controller(QuizController::class)->group(function () {
        Route::group(['prefix' => 'quizzes'], function () {
            // Basic Courses CRUD
            //Route::get('/', 'index')->name('admin.quizzes.index');
            Route::get('/create/{courseId}', 'create')->name('admin.quizzes.create');
            Route::post('/store', 'store')->name('admin.quizzes.store');
            Route::get('/edit/{quizId}', 'edit')->name('admin.quizzes.edit');
            Route::post('/update', 'update')->name('admin.quizzes.update');
            Route::get('/destroy/{quizId}', 'destroy')->name('admin.quizzes.destroy');
            // Extra Operations
            Route::get('/questions/{quizId}', 'showQuizQuestions')->name('admin.quiz.questions');
        });
    });

    ############################# Questions #############################
    Route::controller(QuestionController::class)->group(function () {
        Route::group(['prefix' => 'questions'], function () {
            // Basic Courses CRUD
            //Route::get('/', 'index')->name('admin.quizzes.index');
            Route::get('/create/{quizId}', 'create')->name('admin.questions.create');
            Route::post('/store', 'store')->name('admin.questions.store');
            Route::get('/edit/{questionId}', 'edit')->name('admin.questions.edit');
            Route::post('/update', 'update')->name('admin.questions.update');
            Route::get('/destroy/{questionId}', 'destroy')->name('admin.questions.destroy');
            // Extra Operations
            Route::get('answers/{questionId}', 'showQuestionAnswers')->name('admin.question.answers');
        });
    });

    ############################# Answers #############################
    Route::controller(AnswerController::class)->group(function () {
        Route::group(['prefix' => 'answers'], function () {
            // Basic Courses CRUD
            Route::get('/create/{questionId}', 'create')->name('admin.answers.create');
            Route::post('/store', 'store')->name('admin.answers.store');
            Route::get('/edit/{answerId}', 'edit')->name('admin.answers.edit');
            Route::post('/update', 'update')->name('admin.answers.update');
            Route::get('/destroy/{answerId}', 'destroy')->name('admin.answers.destroy');
        });
    });

    ############################# Books #############################
    Route::controller(BookController::class)->group(function () {
        Route::group(['prefix' => 'books'], function () {
            // Basic Courses CRUD
            Route::get('/', 'index')->name('admin.books.index');
            Route::get('/create', 'create')->name('admin.books.create');
            Route::post('/store', 'store')->name('admin.books.store');
            Route::get('/edit/{id}', 'edit')->name('admin.books.edit');
            Route::post('/update', 'update')->name('admin.books.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.books.destroy');
        });
    });

    ############################# Advertisements #############################
    Route::controller(AdsController::class)->group(function () {
        Route::group(['prefix' => 'advertisements'], function () {
            // Basic Courses CRUD
            Route::get('/', 'index')->name('admin.advertisements.index');
            Route::get('/create', 'create')->name('admin.advertisements.create');
            Route::post('/store', 'store')->name('admin.advertisements.store');
            Route::get('/edit/{id}', 'edit')->name('admin.advertisements.edit');
            Route::post('/update', 'update')->name('admin.advertisements.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.advertisements.destroy');
        });
    });

    ############################# Types #############################
    Route::controller(TypeController::class)->group(function () {
        Route::group(['prefix' => 'types'], function () {
            // Basic Courses CRUD
            Route::get('/', 'index')->name('admin.types.index');
            Route::get('/create', 'create')->name('admin.types.create');
            Route::post('/store', 'store')->name('admin.types.store');
            Route::get('/edit/{id}', 'edit')->name('admin.types.edit');
            Route::post('/update', 'update')->name('admin.types.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.types.destroy');
        });
    });

    ############################# Users #############################
    Route::controller(UserController::class)->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'index')->name('admin.users.index');
            Route::get('/create', 'create')->name('admin.users.create');
            Route::post('/store', 'store')->name('admin.users.store');
            Route::get('/profile/{id}', 'edit')->name('admin.users.edit');
            Route::post('/profile/update', 'update')->name('admin.users.update');
            Route::get('/destroy/{id}', 'destroy')->name('admin.users.destroy');
        });
    });

    ############################# Auth #############################
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');
    Route::get('/logout', [SessionsController::class, 'destroy'])->name('admin.logout');
});


############################# Auth #############################
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store'])->name('admin.session');
});
