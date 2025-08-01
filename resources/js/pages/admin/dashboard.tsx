import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';

export default function AdminDashboard() {
    const adminSections = [
        {
            title: '📄 Page Management',
            description: 'Create and manage static pages with rich content, images, and videos',
            route: 'admin.pages.index',
            color: 'bg-blue-500'
        },
        {
            title: '📝 Blog Management',
            description: 'Publish and manage blog posts with categories, tags, and comments',
            route: 'admin.blog-posts.index',
            color: 'bg-green-500'
        },
        {
            title: '🎓 Course Management',
            description: 'Create online courses with lessons and track student progress',
            route: 'admin.courses.index',
            color: 'bg-purple-500'
        },
        {
            title: '🛒 Order Management',
            description: 'View and manage course purchases and customer orders',
            route: 'admin.orders.index',
            color: 'bg-orange-500'
        }
    ];

    const quickActions = [
        {
            title: 'Create New Page',
            route: 'admin.pages.create',
            icon: '➕'
        },
        {
            title: 'Write Blog Post',
            route: 'admin.blog-posts.create',
            icon: '✍️'
        },
        {
            title: 'Add New Course',
            route: 'admin.courses.create',
            icon: '🎯'
        },
        {
            title: 'View Frontend',
            route: 'home',
            icon: '🌐'
        }
    ];

    return (
        <AppShell>
            <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
                <div className="container mx-auto px-4 py-8">
                    {/* Header */}
                    <div className="mb-8">
                        <h1 className="text-3xl font-bold mb-2">🚀 CMS Admin Dashboard</h1>
                        <p className="text-gray-600 dark:text-gray-300">
                            Manage your website content, courses, and orders from this central hub
                        </p>
                    </div>

                    {/* Quick Actions */}
                    <div className="mb-8">
                        <h2 className="text-xl font-semibold mb-4">⚡ Quick Actions</h2>
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                            {quickActions.map((action) => (
                                <Button
                                    key={action.route}
                                    variant="outline"
                                    className="h-auto p-4 text-left"
                                    onClick={() => router.visit(route(action.route))}
                                >
                                    <div className="flex items-center space-x-3">
                                        <span className="text-2xl">{action.icon}</span>
                                        <span className="font-medium">{action.title}</span>
                                    </div>
                                </Button>
                            ))}
                        </div>
                    </div>

                    {/* Admin Sections */}
                    <div className="mb-8">
                        <h2 className="text-xl font-semibold mb-4">🛠️ Management Sections</h2>
                        <div className="grid md:grid-cols-2 gap-6">
                            {adminSections.map((section) => (
                                <div
                                    key={section.route}
                                    className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow cursor-pointer"
                                    onClick={() => router.visit(route(section.route))}
                                >
                                    <div className={`h-2 ${section.color}`}></div>
                                    <div className="p-6">
                                        <h3 className="text-lg font-semibold mb-2">{section.title}</h3>
                                        <p className="text-gray-600 dark:text-gray-300 mb-4">
                                            {section.description}
                                        </p>
                                        <Button variant="outline" size="sm">
                                            Manage →
                                        </Button>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* System Overview */}
                    <div className="grid lg:grid-cols-3 gap-6">
                        <div className="lg:col-span-2">
                            <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                                <h3 className="text-lg font-semibold mb-4">📊 Platform Overview</h3>
                                <div className="space-y-4">
                                    <div className="flex justify-between items-center">
                                        <span className="text-gray-600 dark:text-gray-300">Content Management</span>
                                        <span className="font-medium">✅ Active</span>
                                    </div>
                                    <div className="flex justify-between items-center">
                                        <span className="text-gray-600 dark:text-gray-300">Blog System</span>
                                        <span className="font-medium">✅ Active</span>
                                    </div>
                                    <div className="flex justify-between items-center">
                                        <span className="text-gray-600 dark:text-gray-300">Course Platform</span>
                                        <span className="font-medium">✅ Active</span>
                                    </div>
                                    <div className="flex justify-between items-center">
                                        <span className="text-gray-600 dark:text-gray-300">Order Management</span>
                                        <span className="font-medium">✅ Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                                <h3 className="text-lg font-semibold mb-4">🎯 Getting Started</h3>
                                <div className="space-y-3 text-sm">
                                    <div className="flex items-start space-x-2">
                                        <span className="text-green-500">✓</span>
                                        <span>CMS Platform installed</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-blue-500">1.</span>
                                        <span>Create your first page</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-blue-500">2.</span>
                                        <span>Write a blog post</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-blue-500">3.</span>
                                        <span>Create an online course</span>
                                    </div>
                                    <div className="flex items-start space-x-2">
                                        <span className="text-blue-500">4.</span>
                                        <span>Customize your theme</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Help Section */}
                    <div className="mt-8 text-center">
                        <div className="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900 dark:to-purple-900 rounded-lg p-6">
                            <h3 className="text-lg font-semibold mb-2">Need Help? 🤝</h3>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Check out our documentation or contact support for assistance with your CMS platform.
                            </p>
                            <div className="flex justify-center space-x-4">
                                <Button variant="outline" size="sm">
                                    📚 Documentation
                                </Button>
                                <Button variant="outline" size="sm">
                                    💬 Support
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}