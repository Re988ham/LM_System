<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
            $this->enrollmentService->destroy($id);
            return redirect()->route('admin.courses.enrollments.index')->with('success', 'Content deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.courses.enrollments.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Accept the specified member.
     */
    public function acceptMember(string $id)
    {
        $this->enrollmentService->accept($id);
        return redirect()->route('admin.courses.enrollments.index')->with('success', 'Content accepted successfully.');
    }
}
