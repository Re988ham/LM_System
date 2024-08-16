<?php

namespace Database\Seeders;

use App\Enums\EnrollmentStatus;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a few enrollments samples
        Enrollment::create([
            'user_id' => 2,
            'course_id' => 2,
            'status' => EnrollmentStatus::PENDING,
        ]);
        Enrollment::create([
            'user_id' => 3,
            'course_id' => 2,
            'status' => EnrollmentStatus::PENDING,
        ]);
    }
}
