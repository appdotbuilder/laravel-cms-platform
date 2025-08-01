<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology trends and tutorials',
                'color' => '#3B82F6'
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Web development tips and tutorials',
                'color' => '#10B981'
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'UI/UX design and creative resources',
                'color' => '#F59E0B'
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business strategies and insights',
                'color' => '#EF4444'
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'description' => 'Digital marketing and growth strategies',
                'color' => '#8B5CF6'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}