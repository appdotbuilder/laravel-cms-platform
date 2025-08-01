<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user first
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create additional test users
        User::factory(5)->create();

        // Seed CMS data
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            PageSeeder::class,
            BlogPostSeeder::class,
            CourseSeeder::class,
        ]);
    }
}
