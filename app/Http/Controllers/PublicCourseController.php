<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::published()
            ->with('instructor')
            ->withCount('lessons');

        // Filter by level
        if ($request->level) {
            $query->where('level', $request->level);
        }

        // Filter by price
        if ($request->price_filter === 'free') {
            $query->where('price', 0);
        } elseif ($request->price_filter === 'paid') {
            $query->where('price', '>', 0);
        }

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
                $query->orderBy('enrolled_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $courses = $query->paginate(12);

        return Inertia::render('courses/index', [
            'courses' => $courses,
            'filters' => $request->only(['level', 'price_filter', 'search', 'sort'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        if (!$course->is_published) {
            abort(404);
        }

        $course->load(['instructor', 'lessons' => function ($query) {
            $query->published()->orderBy('order');
        }]);

        $isEnrolled = auth()->check() && 
            $course->enrollments()->where('user_id', auth()->id())->exists();

        return Inertia::render('courses/show', [
            'course' => $course,
            'isEnrolled' => $isEnrolled
        ]);
    }
}