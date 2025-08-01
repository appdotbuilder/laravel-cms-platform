<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Course;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return Inertia::render('search', [
                'results' => [],
                'query' => $query
            ]);
        }

        $results = collect();

        // Search pages
        $pages = Page::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->take(5)
            ->get()
            ->map(function ($page) {
                return [
                    'type' => 'page',
                    'title' => $page->title,
                    'excerpt' => $page->excerpt,
                    'url' => route('page', $page->slug)
                ];
            });

        // Search blog posts
        $posts = BlogPost::published()
            ->with(['author', 'category'])
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%');
            })
            ->take(5)
            ->get()
            ->map(function ($post) {
                return [
                    'type' => 'blog_post',
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'url' => route('blog.post', $post->slug),
                    'author' => $post->author->name,
                    'category' => $post->category?->name
                ];
            });

        // Search courses
        $courses = Course::published()
            ->with('instructor')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->take(5)
            ->get()
            ->map(function ($course) {
                return [
                    'type' => 'course',
                    'title' => $course->title,
                    'excerpt' => $course->description,
                    'url' => route('courses.show', $course->slug),
                    'instructor' => $course->instructor->name,
                    'price' => $course->price
                ];
            });

        $results = $results->merge($pages)->merge($posts)->merge($courses);

        return Inertia::render('search', [
            'results' => $results,
            'query' => $query
        ]);
    }
}