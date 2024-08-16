<?php

namespace App\Services\Dashboard;

use App\Enums\CourseStatus;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Services\GeneralServices\ImageService;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function getAllAcceptedCourses()
    {
        if (Auth::user()->hasRole('super-admin') || Auth::user()->role_id === 1) {
            return Course::where('status', CourseStatus::ACCEPTED)->get();
        } else {
            return Course::where('user_id', Auth::id())->get();
        }
    }

    public function getPendingCourses()
    {
        return Course::where('status', CourseStatus::PENDING)->get();
    }

    public function createCourse($data)
    {
        $data['status'] = CourseStatus::PENDING;
        if (Auth::user()->hasRole('teacher') || Auth::user()->role_id === 2) {
            $data['user_id'] = Auth::id();
        }
        $data['image'] = ImageService::saveImage($data['image'], '/images/courses/');
        return Course::create($data);
    }

    public function updateCourse($id, $data)
    {
        $course = $this->findCourseById($id);

        $isDeleted = ImageService::deleteImage($course->image);
        if (isset($data['image'])) {
            $destinationPath = 'images/courses/';
            $data['image'] = ImageService::saveImage($data['image'], $destinationPath);
        }

        $course->update($data);

        return $course->fresh();
    }

    public function findCourseById($id)
    {
        return Course::findOrFail($id);
    }

    public function deleteCourse($id)
    {
        $course = $this->findCourseById($id);
        $isDeleted = ImageService::deleteImage($course->image);
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
        $members = Enrollment::where('course_id', $courseId)
            ->where('status', CourseStatus::ACCEPTED)->get();
        return $members;
    }

    public function showCoursePendingMembers(string $courseId)
    {
        $members = Enrollment::where('course_id', $courseId)
            ->where('status', CourseStatus::PENDING)->get();
        return $members;
    }
}
