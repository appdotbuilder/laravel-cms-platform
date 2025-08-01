import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';

interface Props {
    featuredCourses?: Array<{
        id: number;
        title: string;
        description: string;
        slug: string;
        price: number;
        featured_image?: string;
        instructor: {
            name: string;
        };
        enrolled_count: number;
        rating: number;
    }>;
    latestPosts?: Array<{
        id: number;
        title: string;
        excerpt?: string;
        slug: string;
        featured_image?: string;
        author: {
            name: string;
        };
        category?: {
            name: string;
            color: string;
        };
        published_at: string;
    }>;
    [key: string]: unknown;
}

export default function Welcome({ featuredCourses = [], latestPosts = [] }: Props) {
    const handleGetStarted = () => {
        router.visit(route('login'));
    };

    const handleViewCourses = () => {
        router.visit(route('courses.index'));
    };

    const handleViewBlog = () => {
        router.visit(route('blog.index'));
    };

    return (
        <AppShell>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-blue-900 dark:to-indigo-900">
                {/* Hero Section */}
                <section className="container mx-auto px-4 py-16 text-center">
                    <div className="max-w-4xl mx-auto">
                        <h1 className="text-5xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            🚀 Professional CMS Platform
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                            Create and manage your website content with our comprehensive content management system. 
                            Build pages, publish blog posts, create online courses, and manage everything from one powerful dashboard.
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Button 
                                onClick={handleGetStarted}
                                size="lg" 
                                className="px-8 py-3 text-lg bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700"
                            >
                                Get Started Free
                            </Button>
                            <Button 
                                variant="outline" 
                                size="lg" 
                                className="px-8 py-3 text-lg"
                                onClick={() => router.visit('#features')}
                            >
                                Learn More
                            </Button>
                        </div>
                    </div>
                </section>

                {/* Features Grid */}
                <section id="features" className="container mx-auto px-4 py-16">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold mb-4">✨ Powerful Features</h2>
                        <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                            Everything you need to build and manage a professional website
                        </p>
                    </div>
                    
                    <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                            <div className="text-3xl mb-4">📄</div>
                            <h3 className="font-semibold mb-2">Page Management</h3>
                            <p className="text-sm text-gray-600 dark:text-gray-300">
                                Create static pages with rich content, images, videos, and contact forms
                            </p>
                        </div>
                        
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                            <div className="text-3xl mb-4">📝</div>
                            <h3 className="font-semibold mb-2">Blog System</h3>
                            <p className="text-sm text-gray-600 dark:text-gray-300">
                                Publish blog posts with categories, tags, and comment moderation
                            </p>
                        </div>
                        
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                            <div className="text-3xl mb-4">🎓</div>
                            <h3 className="font-semibold mb-2">Course Platform</h3>
                            <p className="text-sm text-gray-600 dark:text-gray-300">
                                Create online courses with lessons, videos, and progress tracking
                            </p>
                        </div>
                        
                        <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                            <div className="text-3xl mb-4">🛒</div>
                            <h3 className="font-semibold mb-2">Order Management</h3>
                            <p className="text-sm text-gray-600 dark:text-gray-300">
                                Handle course purchases with complete order and payment tracking
                            </p>
                        </div>
                    </div>
                </section>

                {/* Featured Courses */}
                {featuredCourses.length > 0 && (
                    <section className="container mx-auto px-4 py-16">
                        <div className="flex justify-between items-center mb-8">
                            <h2 className="text-3xl font-bold">🌟 Featured Courses</h2>
                            <Button variant="outline" onClick={handleViewCourses}>
                                View All Courses
                            </Button>
                        </div>
                        
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {featuredCourses.map((course) => (
                                <div key={course.id} className="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                    {course.featured_image && (
                                        <img 
                                            src={course.featured_image} 
                                            alt={course.title}
                                            className="w-full h-48 object-cover"
                                        />
                                    )}
                                    <div className="p-6">
                                        <h3 className="font-semibold mb-2 line-clamp-2">{course.title}</h3>
                                        <p className="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                            {course.description}
                                        </p>
                                        <div className="flex justify-between items-center mb-4">
                                            <span className="text-sm text-gray-500">
                                                by {course.instructor.name}
                                            </span>
                                            <span className="font-bold text-blue-600">
                                                ${course.price}
                                            </span>
                                        </div>
                                        <div className="flex justify-between items-center text-sm text-gray-500">
                                            <span>⭐ {course.rating}/5</span>
                                            <span>{course.enrolled_count} students</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </section>
                )}

                {/* Latest Blog Posts */}
                {latestPosts.length > 0 && (
                    <section className="container mx-auto px-4 py-16">
                        <div className="flex justify-between items-center mb-8">
                            <h2 className="text-3xl font-bold">📰 Latest Blog Posts</h2>
                            <Button variant="outline" onClick={handleViewBlog}>
                                View All Posts
                            </Button>
                        </div>
                        
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {latestPosts.map((post) => (
                                <div key={post.id} className="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                    {post.featured_image && (
                                        <img 
                                            src={post.featured_image} 
                                            alt={post.title}
                                            className="w-full h-48 object-cover"
                                        />
                                    )}
                                    <div className="p-6">
                                        {post.category && (
                                            <span 
                                                className="inline-block px-2 py-1 text-xs rounded-full text-white mb-2"
                                                style={{ backgroundColor: post.category.color }}
                                            >
                                                {post.category.name}
                                            </span>
                                        )}
                                        <h3 className="font-semibold mb-2 line-clamp-2">{post.title}</h3>
                                        {post.excerpt && (
                                            <p className="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                                {post.excerpt}
                                            </p>
                                        )}
                                        <div className="flex justify-between items-center text-sm text-gray-500">
                                            <span>by {post.author.name}</span>
                                            <span>{new Date(post.published_at).toLocaleDateString()}</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </section>
                )}

                {/* CTA Section */}
                <section className="container mx-auto px-4 py-16">
                    <div className="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-center text-white">
                        <h2 className="text-3xl font-bold mb-4">Ready to Get Started? 🚀</h2>
                        <p className="text-xl mb-8 opacity-90">
                            Join thousands of content creators using our platform to build amazing websites
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Button 
                                onClick={handleGetStarted}
                                size="lg" 
                                variant="secondary"
                                className="px-8 py-3 text-lg bg-white text-gray-900 hover:bg-gray-100"
                            >
                                Start Creating Today
                            </Button>
                            <Button 
                                variant="outline" 
                                size="lg" 
                                className="px-8 py-3 text-lg border-white text-white hover:bg-white hover:text-gray-900"
                                onClick={() => router.visit(route('register'))}
                            >
                                Sign Up Free
                            </Button>
                        </div>
                    </div>
                </section>

                {/* Footer */}
                <footer className="border-t border-gray-200 dark:border-gray-700 py-8">
                    <div className="container mx-auto px-4 text-center text-gray-600 dark:text-gray-300">
                        <p>&copy; 2024 CMS Platform. Built with Laravel & React.</p>
                    </div>
                </footer>
            </div>
        </AppShell>
    );
}