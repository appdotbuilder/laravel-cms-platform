import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/react';

interface BlogPost {
    id: number;
    title: string;
    slug: string;
    excerpt?: string;
    featured_image?: string;
    published_at: string;
    views_count: number;
    author: {
        name: string;
    };
    category?: {
        name: string;
        color: string;
        slug: string;
    };
    tags: Array<{
        name: string;
        slug: string;
    }>;
}

interface Category {
    id: number;
    name: string;
    slug: string;
    color: string;
    blog_posts_count: number;
}

interface Tag {
    id: number;
    name: string;
    slug: string;
    blog_posts_count: number;
}

interface Props {
    posts: {
        data: BlogPost[];
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    categories: Category[];
    tags: Tag[];
    filters: {
        category?: string;
        tag?: string;
        search?: string;
    };
    [key: string]: unknown;
}

export default function BlogIndex({ posts, categories, tags, filters }: Props) {
    const handleSearch = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget);
        const search = formData.get('search') as string;
        
        router.get(route('blog.index'), { ...filters, search }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const handleCategoryFilter = (categorySlug: string) => {
        router.get(route('blog.index'), { 
            ...filters, 
            category: filters.category === categorySlug ? undefined : categorySlug 
        }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const handleTagFilter = (tagSlug: string) => {
        router.get(route('blog.index'), { 
            ...filters, 
            tag: filters.tag === tagSlug ? undefined : tagSlug 
        }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    const clearFilters = () => {
        router.get(route('blog.index'));
    };

    return (
        <AppShell>
            <div className="min-h-screen bg-gray-50 dark:bg-gray-900">
                <div className="container mx-auto px-4 py-8">
                    {/* Header */}
                    <div className="text-center mb-12">
                        <h1 className="text-4xl font-bold mb-4">📰 Blog</h1>
                        <p className="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                            Discover insights, tutorials, and updates from our team
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
                                            placeholder="Search posts..."
                                            className="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                        />
                                        <Button type="submit" className="rounded-l-none">
                                            🔍
                                        </Button>
                                    </div>
                                </form>

                                {/* Active Filters */}
                                {(filters.category || filters.tag || filters.search) && (
                                    <div className="mb-6">
                                        <div className="flex justify-between items-center mb-2">
                                            <span className="text-sm font-medium">Active Filters</span>
                                            <Button variant="ghost" size="sm" onClick={clearFilters}>
                                                Clear All
                                            </Button>
                                        </div>
                                        <div className="space-y-1">
                                            {filters.search && (
                                                <div className="text-xs text-gray-600 dark:text-gray-400">
                                                    Search: "{filters.search}"
                                                </div>
                                            )}
                                            {filters.category && (
                                                <div className="text-xs text-gray-600 dark:text-gray-400">
                                                    Category: {categories.find(c => c.slug === filters.category)?.name}
                                                </div>
                                            )}
                                            {filters.tag && (
                                                <div className="text-xs text-gray-600 dark:text-gray-400">
                                                    Tag: {tags.find(t => t.slug === filters.tag)?.name}
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                )}

                                {/* Categories */}
                                <div className="mb-6">
                                    <h3 className="font-semibold mb-3">Categories</h3>
                                    <div className="space-y-2">
                                        {categories.map((category) => (
                                            <button
                                                key={category.id}
                                                onClick={() => handleCategoryFilter(category.slug)}
                                                className={`block w-full text-left px-3 py-2 rounded text-sm transition-colors ${
                                                    filters.category === category.slug
                                                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100'
                                                        : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                                                }`}
                                            >
                                                <div className="flex justify-between items-center">
                                                    <span>{category.name}</span>
                                                    <span className="text-xs text-gray-500">
                                                        {category.blog_posts_count}
                                                    </span>
                                                </div>
                                            </button>
                                        ))}
                                    </div>
                                </div>

                                {/* Tags */}
                                <div>
                                    <h3 className="font-semibold mb-3">Tags</h3>
                                    <div className="flex flex-wrap gap-2">
                                        {tags.map((tag) => (
                                            <button
                                                key={tag.id}
                                                onClick={() => handleTagFilter(tag.slug)}
                                                className={`px-2 py-1 text-xs rounded-full transition-colors ${
                                                    filters.tag === tag.slug
                                                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100'
                                                        : 'bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600'
                                                }`}
                                            >
                                                {tag.name} ({tag.blog_posts_count})
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Main Content */}
                        <div className="lg:col-span-3">
                            {posts.data.length === 0 ? (
                                <div className="text-center py-12">
                                    <div className="text-6xl mb-4">📭</div>
                                    <h3 className="text-xl font-semibold mb-2">No posts found</h3>
                                    <p className="text-gray-600 dark:text-gray-300">
                                        Try adjusting your search or filters
                                    </p>
                                </div>
                            ) : (
                                <>
                                    <div className="grid md:grid-cols-2 gap-6">
                                        {posts.data.map((post) => (
                                            <article
                                                key={post.id}
                                                className="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow cursor-pointer"
                                                onClick={() => router.visit(route('blog.post', post.slug))}
                                            >
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
                                                    <h2 className="font-semibold mb-2 line-clamp-2">
                                                        {post.title}
                                                    </h2>
                                                    {post.excerpt && (
                                                        <p className="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                                            {post.excerpt}
                                                        </p>
                                                    )}
                                                    <div className="flex justify-between items-center text-sm text-gray-500">
                                                        <span>by {post.author.name}</span>
                                                        <span>{new Date(post.published_at).toLocaleDateString()}</span>
                                                    </div>
                                                    <div className="flex justify-between items-center mt-2 text-xs text-gray-400">
                                                        <span>{post.views_count} views</span>
                                                        {post.tags.length > 0 && (
                                                            <div className="flex gap-1">
                                                                {post.tags.slice(0, 2).map((tag) => (
                                                                    <span key={tag.slug} className="bg-gray-100 dark:bg-gray-700 px-1 py-0.5 rounded">
                                                                        #{tag.name}
                                                                    </span>
                                                                ))}
                                                                {post.tags.length > 2 && <span>+{post.tags.length - 2}</span>}
                                                            </div>
                                                        )}
                                                    </div>
                                                </div>
                                            </article>
                                        ))}
                                    </div>

                                    {/* Pagination */}
                                    {posts.last_page > 1 && (
                                        <div className="flex justify-center mt-8">
                                            <div className="flex gap-2">
                                                {posts.current_page > 1 && (
                                                    <Button
                                                        variant="outline"
                                                        onClick={() => router.get(route('blog.index'), { 
                                                            ...filters, 
                                                            page: posts.current_page - 1 
                                                        })}
                                                    >
                                                        Previous
                                                    </Button>
                                                )}
                                                {posts.current_page < posts.last_page && (
                                                    <Button
                                                        variant="outline"
                                                        onClick={() => router.get(route('blog.index'), { 
                                                            ...filters, 
                                                            page: posts.current_page + 1 
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