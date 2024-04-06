<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

<<<<<<< HEAD
use App\Models\Specialization;
=======
>>>>>>> ed1f74a1f0c876f204dcb737ef14993d567efc72
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
       
        $this->call([

            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            SpecializationSeeder::class,
            CountrySeeder::class,
=======
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([

            CategorySeeder::class,
            UserSeeder::class,
//            RoleAndPermissionSeeder::class,

>>>>>>> ed1f74a1f0c876f204dcb737ef14993d567efc72
        ]);
    }
}
