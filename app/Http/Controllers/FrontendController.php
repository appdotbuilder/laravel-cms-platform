<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Course;
use Inertia\Inertia;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $featuredCourses = Course::published()
            ->with('instructor')
            ->orderBy('enrolled_count', 'desc')
            ->take(3)
            ->get();

        $latestPosts = BlogPost::published()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        return Inertia::render('welcome', [
            'featuredCourses' => $featuredCourses,
            'latestPosts' => $latestPosts
        ]);
    }
}