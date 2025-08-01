<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();
        $tags = Tag::all();

        if (!$user || $categories->isEmpty()) {
            return;
        }

        $posts = [
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-11',
                'content' => '<h2>Introduction to Laravel 11</h2><p>Laravel 11 brings exciting new features and improvements to the popular PHP framework. In this comprehensive guide, we will explore the key changes and how to get started with your first Laravel 11 project.</p><h3>What is New in Laravel 11?</h3><p>Laravel 11 introduces several enhancements including improved performance, new Artisan commands, and better testing utilities. The framework continues to evolve while maintaining its elegant syntax and developer-friendly approach.</p><h3>Installation</h3><p>To get started with Laravel 11, you will need PHP 8.2 or higher and Composer installed on your system. Run the following command to create a new Laravel project:</p><pre><code>composer create-project laravel/laravel my-project</code></pre><p>This will create a new Laravel application with all the necessary dependencies.</p>',
                'excerpt' => 'Learn how to get started with Laravel 11 and explore its new features and improvements.',
                'category_id' => $categories->where('slug', 'web-development')->first()?->id,
                'author_id' => $user->id,
                'published_at' => now()->subDays(1),
                'is_published' => true,
                'views_count' => random_int(100, 500)
            ],
            [
                'title' => 'Modern React Development Best Practices',
                'slug' => 'modern-react-development-best-practices',
                'content' => '<h2>React Development in 2024</h2><p>React continues to be one of the most popular frontend frameworks. This article covers the latest best practices for developing React applications in 2024.</p><h3>Component Architecture</h3><p>Building maintainable React applications starts with good component architecture. We recommend using functional components with hooks for most use cases.</p><h3>State Management</h3><p>Choose the right state management solution for your application. For simple apps, React built-in state might be enough. For complex applications, consider Redux Toolkit or Zustand.</p><h3>Performance Optimization</h3><p>Use React.memo, useMemo, and useCallback judiciously to optimize performance. Remember that premature optimization can lead to complex code without meaningful benefits.</p>',
                'excerpt' => 'Discover the latest best practices for building modern React applications with optimal performance.',
                'category_id' => $categories->where('slug', 'web-development')->first()?->id,
                'author_id' => $user->id,
                'published_at' => now()->subDays(3),
                'is_published' => true,
                'views_count' => random_int(150, 600)
            ],
            [
                'title' => 'The Future of Web Design Trends',
                'slug' => 'future-of-web-design-trends',
                'content' => '<h2>Web Design Trends to Watch</h2><p>The web design landscape is constantly evolving. Here are the key trends shaping the future of web design and user experience.</p><h3>Minimalist Design</h3><p>Less is more. Clean, minimalist designs continue to dominate, focusing on essential elements and improved user experience.</p><h3>Dark Mode</h3><p>Dark mode is no longer optional. Users expect the ability to switch between light and dark themes for better accessibility and reduced eye strain.</p><h3>Micro-interactions</h3><p>Small animations and micro-interactions enhance user engagement and provide feedback for user actions.</p>',
                'excerpt' => 'Explore the latest web design trends that are shaping the future of digital experiences.',
                'category_id' => $categories->where('slug', 'design')->first()?->id,
                'author_id' => $user->id,
                'published_at' => now()->subDays(5),
                'is_published' => true,
                'views_count' => random_int(80, 300)
            ],
            [
                'title' => 'Building Scalable APIs with Laravel',
                'slug' => 'building-scalable-apis-with-laravel',
                'content' => '<h2>API Development with Laravel</h2><p>Laravel provides excellent tools for building robust and scalable APIs. This guide covers the essential patterns and practices for API development.</p><h3>RESTful Design</h3><p>Follow RESTful principles when designing your API endpoints. Use appropriate HTTP methods and status codes to create intuitive interfaces.</p><h3>Authentication</h3><p>Implement secure authentication using Laravel Sanctum for SPA authentication or Laravel Passport for OAuth2 implementation.</p><h3>Rate Limiting</h3><p>Protect your API from abuse by implementing rate limiting. Laravel provides built-in throttling middleware for this purpose.</p>',
                'excerpt' => 'Learn how to build scalable and secure APIs using Laravel framework and industry best practices.',
                'category_id' => $categories->where('slug', 'technology')->first()?->id,
                'author_id' => $user->id,
                'published_at' => now()->subWeek(),
                'is_published' => true,
                'views_count' => random_int(200, 700)
            ],
            [
                'title' => 'Digital Marketing Strategies for 2024',
                'slug' => 'digital-marketing-strategies-2024',
                'content' => '<h2>Marketing in the Digital Age</h2><p>Digital marketing continues to evolve rapidly. Stay ahead of the competition with these proven strategies for 2024.</p><h3>Content Marketing</h3><p>Quality content remains king. Focus on creating valuable, relevant content that addresses your audience needs and pain points.</p><h3>Social Media Marketing</h3><p>Leverage social media platforms to build community and engage with your audience. Each platform has its unique characteristics and best practices.</p><h3>SEO and Search Marketing</h3><p>Search engine optimization is crucial for organic visibility. Focus on user intent and create content that genuinely helps your audience.</p>',
                'excerpt' => 'Discover effective digital marketing strategies to grow your business and reach your target audience.',
                'category_id' => $categories->where('slug', 'marketing')->first()?->id,
                'author_id' => $user->id,
                'published_at' => now()->subDays(2),
                'is_published' => true,
                'views_count' => random_int(120, 400)
            ]
        ];

        foreach ($posts as $postData) {
            $post = BlogPost::create($postData);
            
            // Attach random tags to each post
            $randomTags = $tags->random(random_int(2, 5));
            $post->tags()->attach($randomTags->pluck('id'));
        }
    }
}