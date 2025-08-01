<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Static Pages
Route::get('/page/{page}', [PublicPageController::class, 'show'])->name('page');

// Blog Routes
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost}', [PublicBlogController::class, 'show'])->name('blog.post');

// Course Routes
Route::get('/courses', [PublicCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [PublicCourseController::class, 'show'])->name('courses.show');

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return \Inertia\Inertia::render('dashboard');
    })->name('dashboard');
});

// Admin Routes (protected)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return \Inertia\Inertia::render('admin/dashboard');
    })->name('dashboard');

    // Page Management
    Route::resource('pages', PageController::class);

    // Blog Management
    Route::resource('blog-posts', BlogPostController::class);

    // Course Management
    Route::resource('courses', CourseController::class);

    // Order Management
    Route::resource('orders', OrderController::class)->except(['create', 'store']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
