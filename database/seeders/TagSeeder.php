<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Laravel',
            'React',
            'Vue.js',
            'PHP',
            'JavaScript',
            'TypeScript',
            'CSS',
            'HTML',
            'Tailwind CSS',
            'MySQL',
            'PostgreSQL',
            'API',
            'REST',
            'GraphQL',
            'Docker',
            'AWS',
            'Git',
            'Testing',
            'Performance',
            'Security',
            'SEO',
            'Mobile',
            'Frontend',
            'Backend',
            'Full-stack'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => \Illuminate\Support\Str::slug($tag)
            ]);
        }
    }
}