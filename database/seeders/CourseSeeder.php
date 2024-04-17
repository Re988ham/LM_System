<?php
namespace Database\Seeders;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->truncate();

        $courses = [
            // 10 courses defined

        ];

        // Use a loop to generate 90 more courses
        for($i = 0; $i < 90; $i++) {
            $statuses = ['pending', 'accepted'];
            $courses[] = [
                'name' => fake()->name,
                'specialization_id' => rand(1,10),
                'user_id' => rand(1,10),
                'description' => substr(fake()->paragraph(3), 0, 100),
                'status' => $statuses[random_int(0,1)],
                'created_at'=>now(),
                'updated_at'=>now(),
            ];

        }

        foreach($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }

}
