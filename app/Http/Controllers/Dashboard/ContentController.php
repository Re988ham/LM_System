<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Content\ContentCreateRequest;
use App\Http\Requests\Dashboard\Content\ContentUpdateRequest;
use App\Services\Dashboard\ContentService;
use App\Services\Dashboard\CourseService;
use Exception;

class ContentController extends Controller
{
    private ContentService $contentService;
    private CourseService $courseService;

    public function __construct(ContentService $contentService, CourseService $courseService)
    {
        $this->contentService = $contentService;
        $this->courseService = $courseService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = $this->contentService->list();
        return view('dashboard.pages.courses.contents.index', compact('contents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentCreateRequest $request)
    {
        $validatedData = $request->validated();
        $this->contentService->create($validatedData);
        return redirect()->route('admin.course.courses.contents', $validatedData['course_id'])->with('success', 'Content created successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $courseId)
    {
        $course = $this->courseService->findCourseById($courseId);
        return view('dashboard.pages.courses.contents.create', compact('course'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$courses = $this->courseService->show($id);
        return view('dashboard.pages.courses.contents.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $courseId, string $contentId)
    {
        $content = $this->contentService->findById($contentId);
        $course = $this->courseService->findCourseById($courseId);
        return view('dashboard.pages.courses.contents.update', compact(
            'content', 'course'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContentUpdateRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $content = $this->contentService->update($validatedData);
            return redirect()->route('admin.course.courses.contents', $content->course_id)->with('success', 'Content updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->contentService->destroy($id);
            return redirect()->route('admin.courses.contents.index')->with('success', 'Content deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.courses.contents.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Accept the specified content.
     */
    public function acceptContent(string $id)
    {
        $this->contentService->accept($id);
        return redirect()->route('admin.courses.contents.index')->with('success', 'Content accepted successfully.');
    }
}
