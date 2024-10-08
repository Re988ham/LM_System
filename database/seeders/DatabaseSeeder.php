<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();
        // Course::factory(10)->create();

        $this->call([
            RoleAndPermissionSeeder::class,
            SpecializationSeeder::class,
            CountrySeeder::class,
            TypeSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            ContentSeeder::class,
            WalletSeeder::class,
            BookSeeder::class,
            EnrollmentSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
