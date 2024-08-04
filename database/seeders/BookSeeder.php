<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a few sample books
        Book::create([
            'specialization_id' => 1,
            'title' => 'Laravel Up and Running',
            'url' => 'https://example.com/laravel-up-and-running',
            'description' => 'A comprehensive guide to Laravel.',
            'image' => 'https://example.com/images/laravel.jpg',
            'xp' => 500,
        ]);

        Book::create([
            'specialization_id' => 2,
            'title' => 'Mastering django',
            'url' => 'https://example.com/mastering-php',
            'description' => 'Advanced techniques for django developers.',
            'image' => 'https://example.com/images/php.jpg',
            'xp' => 700,
        ]);

        Book::create([
            'specialization_id' => 4,
            'title' => 'Mastering node.js',
            'url' => 'https://example.com/mastering-php',
            'description' => 'Advanced techniques for node.js developers.',
            'image' => 'https://example.com/images/php.jpg',
            'xp' => 700,
        ]);
        Book::create([
            'specialization_id' => 3,
            'title' => 'Mastering bigdata ',
            'url' => 'https://example.com/mastering-php',
            'description' => 'Advanced techniques for bigdata developers.',
            'image' => 'https://example.com/images/php.jpg',
            'xp' => 700,

        ]); Book::create([
        'specialization_id' => 3,
        'title' => 'Mastering flask',
        'url' => 'https://example.com/mastering-php',
        'description' => 'Advanced techniques for flask developers.',
        'image' => 'https://example.com/images/php.jpg',
        'xp' => 700,
    ]);}
}
