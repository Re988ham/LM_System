<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Services\Dashboard\CourseService;
use App\Services\Dashboard\EnrollmentService;
use Exception;

class EnrollmentController extends Controller
{
    private EnrollmentService $enrollmentService;

    public function __construct(EnrollmentService $enrollmentService, CourseService $courseService)
    {
        $this->enrollmentService = $enrollmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = $this->enrollmentService->list();
        return view('dashboard.pages.courses.enrollments.index', compact('enrollments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $enrollment = $this->enrollmentService->findById($id);
            $this->enrollmentService->destroy($enrollment);
            return redirect()->route('admin.course.members', $enrollment->course_id)->with('success', 'Content deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.course.members', $enrollment->course_id)->with('error', $e->getMessage());
        }
    }

    /**
     * Accept the specified member.
     */
    public function acceptMember(string $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $this->enrollmentService->accept($enrollment);
        return redirect()->route('admin.course.members', $enrollment->course_id)->with('success', 'Content accepted successfully.');
    }
}
