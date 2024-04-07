<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specializations = [
            'Web Development',
            'Mobile App Development',
            'Data Science',
            'Artificial Intelligence',
            'Cybersecurity',
            'Cloud Computing',
            'Database Administration',
            'Network Administration',
            'Software Engineering',
            'UI/UX Design',
            'BackEnd Developer',
            'FrontEnd Developer',
        ];

        foreach ($specializations as $specialization) {
            DB::table('specializations')->insert([
                'name' => $specialization,
            ]);
        }
    }
}
