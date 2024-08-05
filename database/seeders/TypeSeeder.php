<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the types
        $types = [
            ['type' => 'video'],
            ['type' => 'document'],
        ];

        // Insert the types into the database
        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
