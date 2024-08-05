<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run()
    {
        DB::table('contents')->truncate();

        $faker = Factory::create();

        for ($i = 0; $i < 90; $i++) {
            $statuses = ['pending', 'accepted'];

            $data = [
                'name' => $faker->word,
                'course_id' => rand(1, 10),
                'url' => 'https://example.com/' . Str::random(10),
                'type_id' => random_int(1, 2),
                'status' => $statuses[random_int(0, 1)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('contents')->insert($data);
        }
    }
}
