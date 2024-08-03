<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'country_id' => 1,
            'mobile_number' => '0994436747',
            'birth_date' => '1998-12-16',
            'gender' => 'male',
            'image' => 'default.jpg',
            'google_id' => null,
            'role_id' => 1,
            'remember_token' => null,
        ]);
    }
}
