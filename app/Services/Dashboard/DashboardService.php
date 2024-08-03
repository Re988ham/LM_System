<?php

namespace App\Services\Dashboard;

use App\Models\Course;
use App\Models\Specialization;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class DashboardService
{
    public function getCounts(): array
    {
        $coursesCount = Course::count();
        $teacherRole = Role::findByName('teacher');
        $teachersCount = $teacherRole->users->count();
        $studentRole = Role::findByName('teacher');
        $studentsCount = $studentRole->users->count();
        $specializationCount = Specialization::count();

        return [
            'coursesCount' => $coursesCount,
            'teachersCount' => $teachersCount,
            'studentsCount' => $studentsCount,
            'specializationCount' => $specializationCount,
        ];
    }

    public function getLatestSpecializations(): Collection
    {
        $specializations = Specialization::latest()->take(6)->get();

        $icons = [
            'ni ni-bell-55 text-success',
            'ni ni-html5 text-danger',
            'ni ni-cart text-info',
            'ni ni-credit-card text-warning',
            'ni ni-key-25 text-primary',
            'ni ni-money-coins text-dark',
        ];

        $specializations->each(function ($specialization, $index) use ($icons) {
            // Default to a question mark icon if no icon found
            $specialization->icon = $icons[$index] ?? 'ni ni-question';
        });

        return $specializations;
    }

    public function getTop6Courses(): Collection
    {
        $courses = Course::latest()->take(6)->get();
        return $courses;
    }
}
