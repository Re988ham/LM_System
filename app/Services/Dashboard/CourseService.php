<?php

namespace App\Services\Dashboard;

use App\Enums\CourseStatus;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function getAllAcceptedCourses()
    {
        if (Auth::user()->hasRole('super-admin') || Auth::user()->role_id === 1) {
            return Course::where('status', CourseStatus::ACCEPTED)->get();
        } else {
            return Course::where('teacher_id', Auth::id())->get();
        }
    }

    public function getPendingCourses()
    {
        return Course::where('status', CourseStatus::PENDING)->get();
    }

    public function createCourse($data)
    {
        return Course::create($data);
    }

    public function updateCourse($id, $data)
    {
        $course = $this->findCourseById($id);
        $course->update($data);
        return $course;
    }

    public function findCourseById($id)
    {
        return Course::findOrFail($id);
    }

    public function deleteCourse($id)
    {
        $course = $this->findCourseById($id);
        $course->delete();
    }

    public function getAllTeachers()
    {
        return User::where('role_id', 2)->pluck('name', 'id');
    }

    public function accept($id): void
    {
        $content = Course::findOrFail($id);
        $content->changeStatus(CourseStatus::ACCEPTED);
    }

    public function showCourseContents(string $id)
    {
        $course = $this->findCourseById($id);
        return $course->contents;
    }

    public function showCourseQuizzes(string $id)
    {
        $course = $this->findCourseById($id);
        return $course->quizzes;
    }

    public function showCourseMembers(string $courseId)
    {
        $course = $this->findCourseById($courseId);
        return $course->members;
    }

    public function showCoursePendingMembers(string $courseId)
    {
        $course = $this->findCourseById($courseId);
        return $course->members->where('status', CourseStatus::PENDING);
    }
}
