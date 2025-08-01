import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';

interface Course {
    id: number;
    title: string;
    slug: string;
    description: string;
    featured_image?: string;
    price: number;
    level: 'beginner' | 'intermediate' | 'advanced';
    enrolled_count: number;
    rating: number;
    lessons_count: number;
    instructor: {
        name: string;
    };
}

interface Props {
    courses: {
        data: Course[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    filters: {
        level?: string;
        price_filter?: string;
        search?: string;
        sort?: string;
    };
    [key: string]: unknown;
}

export default function CoursesIndex({ courses, filters }: Props) {
    const handleSearch = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget);
        const search = formData.get('search') as string;
        
        router.get(route('courses.index'), { ...filters, search }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const handleFilter = (key: keyof typeof filters, value: string) => {
        const newFilters = { ...filters };
        if (newFilters[key] === value) {
            delete newFilters[key];
        } else {
            newFilters[key] = value;
        }
        
        router.get(route('courses.index'), newFilters, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const clearFilters = () => {
        router.get(route('courses.index'));
    };

    const getLevelColor = (level: string) => {
        switch (level) {
            case 'beginner':
                return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            case 'intermediate':
                return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
            case 'advanced':
                return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
            default:
                return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
        }
    };

    return (
        <AppShell>
            <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
                <div className="container mx-auto px-4 py-8">
                    {/* Header */}
                    <div className="text-center mb-12">
                        <h1 className="text-4xl font-bold mb-4">🎓 Online Courses</h1>
                        <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                            Learn new skills with our comprehensive online courses
                        </p>
                    </div>

                    <div className="grid lg:grid-cols-4 gap-8">
                        {/* Sidebar */}
                        <div className="lg:col-span-1">
                            <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 sticky top-4">
                                {/* Search */}
                                <form onSubmit={handleSearch} className="mb-6">
                                    <label className="block text-sm font-medium mb-2">Search</label>
                                    <div className="flex">
                                        <input
                                            type="text"
                                            name="search"
                                            defaultValue={filters.search || ''}
                                            placeholder="Search courses..."
                                            className="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        <Button type="submit" className="rounded-l-none">
                                            🔍
                                        </Button>
                                    </div>
                                </form>

                                {/* Clear Filters */}
                                {Object.keys(filters).length > 0 && (
                                    <div className="mb-6">
                                        <Button variant="outline" size="sm" onClick={clearFilters} className="w-full">
                                            Clear All Filters
                                        </Button>
                                    </div>
                                )}

                                {/* Level Filter */}
                                <div className="mb-6">
                                    <h3 className="font-semibold mb-3">Level</h3>
                                    <div className="space-y-2">
                                        {['beginner', 'intermediate', 'advanced'].map((level) => (
                                            <button
                                                key={level}
                                                onClick={() => handleFilter('level', level)}
                                                className={`block w-full text-left px-3 py-2 rounded text-sm transition-colors ${
                                                    filters.level === level
                                                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100'
                                                        : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                                }`}
                                            >
                                                {level.charAt(0).toUpperCase() + level.slice(1)}
                                            </button>
                                        ))}
                                    </div>
                                </div>

                                {/* Price Filter */}
                                <div className="mb-6">
                                    <h3 className="font-semibold mb-3">Price</h3>
                                    <div className="space-y-2">
                                        {[
                                            { key: 'free', label: 'Free' },
                                            { key: 'paid', label: 'Paid' }
                                        ].map((price) => (
                                            <button
                                                key={price.key}
                                                onClick={() => handleFilter('price_filter', price.key)}
                                                className={`block w-full text-left px-3 py-2 rounded text-sm transition-colors ${
                                                    filters.price_filter === price.key
                                                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100'
                                                        : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                                }`}
                                            >
                                                {price.label}
                                            </button>
                                        ))}
                                    </div>
                                </div>

                                {/* Sort */}
                                <div>
                                    <h3 className="font-semibold mb-3">Sort By</h3>
                                    <select
                                        value={filters.sort || 'latest'}
                                        onChange={(e) => handleFilter('sort', e.target.value)}
                                        className="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                    >
                                        <option value="latest">Latest</option>
                                        <option value="popular">Most Popular</option>
                                        <option value="rating">Highest Rated</option>
                                        <option value="price_low">Price: Low to High</option>
                                        <option value="price_high">Price: High to Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {/* Main Content */}
                        <div className="lg:col-span-3">
                            {courses.data.length === 0 ? (
                                <div className="text-center py-12">
                                    <div className="text-6xl mb-4">📚</div>
                                    <h3 className="text-xl font-semibold mb-2">No courses found</h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Try adjusting your search or filters
                                    </p>
                                </div>
                            ) : (
                                <>
                                    <div className="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
                                        {courses.data.map((course) => (
                                            <div
                                                key={course.id}
                                                className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow cursor-pointer"
                                                onClick={() => router.visit(route('courses.show', course.slug))}
                                            >
                                                {course.featured_image && (
                                                    <img
                                                        src={course.featured_image}
                                                        alt={course.title}
                                                        className="w-full h-48 object-cover"
                                                    />
                                                )}
                                                <div className="p-6">
                                                    <div className="flex justify-between items-start mb-2">
                                                        <span className={`px-2 py-1 text-xs rounded-full ${getLevelColor(course.level)}`}>
                                                            {course.level}
                                                        </span>
                                                        <span className="font-bold text-blue-600 dark:text-blue-400">
                                                            {course.price === 0 ? 'Free' : `$${course.price}`}
                                                        </span>
                                                    </div>
                                                    <h3 className="font-semibold mb-2 line-clamp-2">
                                                        {course.title}
                                                    </h3>
                                                    <p className="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                                        {course.description}
                                                    </p>
                                                    <div className="flex justify-between items-center mb-3 text-sm text-gray-500">
                                                        <span>by {course.instructor.name}</span>
                                                        <span>⭐ {course.rating}/5</span>
                                                    </div>
                                                    <div className="flex justify-between items-center text-xs text-gray-400">
                                                        <span>{course.lessons_count} lessons</span>
                                                        <span>{course.enrolled_count} students</span>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                    </div>

                                    {/* Pagination */}
                                    {courses.last_page > 1 && (
                                        <div className="flex justify-center mt-8">
                                            <div className="flex gap-2">
                                                {courses.current_page > 1 && (
                                                    <Button
                                                        variant="outline"
                                                        onClick={() => router.get(route('courses.index'), { 
                                                            ...filters, 
                                                            page: courses.current_page - 1 
                                                        })}
                                                    >
                                                        Previous
                                                    </Button>
                                                )}
                                                <span className="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                                    Page {courses.current_page} of {courses.last_page}
                                                </span>
                                                {courses.current_page < courses.last_page && (
                                                    <Button
                                                        variant="outline"
                                                        onClick={() => router.get(route('courses.index'), { 
                                                            ...filters, 
                                                            page: courses.current_page + 1 
                                                        })}
                                                    >
                                                        Next
                                                    </Button>
                                                )}
                                            </div>
                                        </div>
                                    )}
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}