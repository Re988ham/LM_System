<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get an array of country names
        $countryNames = [];
        for ($i = 0; $i < 200; $i++) {
            $countryNames[] = $faker->unique()->country;
        }

        // Insert the country names into the database
        foreach ($countryNames as $countryName) {
            DB::table('countries')->insert([
                'name' => $countryName,
            ]);
        }
    }
}
