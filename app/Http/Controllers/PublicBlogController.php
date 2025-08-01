<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::published()
            ->with(['author', 'category', 'tags']);

        // Filter by category
        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->tag) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest('published_at')->paginate(9);
        $categories = Category::withCount('blogPosts')->get();
        $tags = Tag::withCount('blogPosts')->get();

        return Inertia::render('blog/index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'filters' => $request->only(['category', 'tag', 'search'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogPost)
    {
        if (!$blogPost->is_published) {
            abort(404);
        }

        $blogPost->increment('views_count');
        $blogPost->load(['author', 'category', 'tags', 'comments' => function ($query) {
            $query->approved()
                  ->with('author')
                  ->whereNull('parent_id')
                  ->latest();
        }]);

        $relatedPosts = BlogPost::published()
            ->with(['author', 'category'])
            ->where('id', '!=', $blogPost->id)
            ->where('category_id', $blogPost->category_id)
            ->take(3)
            ->get();

        return Inertia::render('blog/show', [
            'post' => $blogPost,
            'relatedPosts' => $relatedPosts
        ]);
    }
}