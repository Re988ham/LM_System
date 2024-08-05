<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Course\CourseCreateRequest;
use App\Http\Requests\Dashboard\Course\CourseUpdateRequest;
use App\Services\Dashboard\CourseService;
use App\Services\Dashboard\SpecializationService;

class CourseController extends Controller
{
    private $courseService;
    private $specializationService;

    public function __construct(CourseService $courseService, SpecializationService $specializationService)
    {
        $this->courseService = $courseService;
        $this->specializationService = $specializationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = $this->courseService->getAllAcceptedCourses();
        return view('dashboard.pages.courses.index', compact('courses'));
    }

    public function pendingCourses()
    {
        $courses = $this->courseService->getPendingCourses();
        return view('dashboard.pages.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->specializationService->getAllSpecializationsChoices();
        return view('dashboard.pages.courses.create', compact(
            'specializations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCreateRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['teacher_id'] = auth()->id();
        // dd($validatedData);
        $this->courseService->createCourse($validatedData);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = $this->courseService->findCourseById($id);
        return view('dashboard.pages.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = $this->courseService->findCourseById($id);
        $specializations = $this->specializationService->getAllSpecializationsChoices();
        return view('dashboard.pages.courses.update', compact('course', 'specializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $this->courseService->updateCourse($validatedData['id'], $validatedData);
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->courseService->deleteCourse($id);
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully');
    }

    /**
     * Accept the specified course.
     */
    public function acceptCourse(string $id)
    {
        $this->courseService->accept($id);
        return redirect()->route('admin.courses.index')->with('success', 'Course accepted successfully.');
    }

    /**
     * Display the contents of specific course.
     */
    public function showCourseContents(string $courseId)
    {
        $contents = $this->courseService->showCourseContents($courseId);
        return view('dashboard.pages.contents.index', compact(
            'contents',
            'courseId'
        ));
    }

    /**
     * Display the quizzes of specific course.
     */
    public function showCourseQuizzes(string $courseId)
    {
        $quizzes = $this->courseService->showCourseQuizzes($courseId);
        return view('dashboard.pages.quizzes.index', compact(
            'quizzes',
            'courseId'
        ));
    }

    /**
     * Display the members of specific course.
     */
    public function showCourseMembers(string $courseId)
    {
        $members = $this->courseService->showCourseMembers($courseId);
        return view('dashboard.pages.courses.enrollments.index', compact(
            'courseId',
            'members'
        ));
    }

    /**
     * Display the pending members of specific course.
     */
    public function showCoursePendingMembers(string $courseId)
    {
        $members = $this->courseService->showCoursePendingMembers($courseId);
        return view('dashboard.pages.courses.enrollments.index', compact(
            'courseId',
            'members'
        ));
    }
}
