<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            return;
        }

        $courses = [
            [
                'title' => 'Complete Laravel Development Course',
                'slug' => 'complete-laravel-development-course',
                'description' => 'Master Laravel framework from basics to advanced concepts. Build real-world applications with modern PHP development practices.',
                'content' => '<h2>Course Overview</h2><p>This comprehensive Laravel course will take you from beginner to expert level. You will learn to build modern web applications using Laravel\'s elegant syntax and powerful features.</p><h3>What You Will Learn</h3><ul><li>Laravel fundamentals and MVC architecture</li><li>Database design and Eloquent ORM</li><li>Authentication and authorization</li><li>API development</li><li>Testing and deployment</li></ul>',
                'price' => 99.99,
                'duration_hours' => 40,
                'level' => 'intermediate',
                'instructor_id' => $user->id,
                'is_published' => true,
                'enrolled_count' => random_int(50, 200),
                'rating' => 4.8
            ],
            [
                'title' => 'React for Beginners',
                'slug' => 'react-for-beginners',
                'description' => 'Learn React from scratch and build interactive user interfaces. Perfect for developers new to React.',
                'content' => '<h2>Welcome to React</h2><p>React is a powerful JavaScript library for building user interfaces. This course is designed for complete beginners who want to learn React development.</p><h3>Course Content</h3><ul><li>React basics and JSX</li><li>Components and props</li><li>State and event handling</li><li>Hooks and modern React</li><li>Building your first React app</li></ul>',
                'price' => 0.00,
                'duration_hours' => 20,
                'level' => 'beginner',
                'instructor_id' => $user->id,
                'is_published' => true,
                'enrolled_count' => random_int(100, 500),
                'rating' => 4.6
            ],
            [
                'title' => 'Advanced JavaScript Concepts',
                'slug' => 'advanced-javascript-concepts',
                'description' => 'Deep dive into advanced JavaScript concepts including closures, prototypes, async programming, and more.',
                'content' => '<h2>Master JavaScript</h2><p>Take your JavaScript skills to the next level with advanced concepts and patterns used in modern development.</p><h3>Advanced Topics</h3><ul><li>Closures and scope</li><li>Prototypes and inheritance</li><li>Async programming</li><li>Design patterns</li><li>Performance optimization</li></ul>',
                'price' => 79.99,
                'duration_hours' => 30,
                'level' => 'advanced',
                'instructor_id' => $user->id,
                'is_published' => true,
                'enrolled_count' => random_int(30, 150),
                'rating' => 4.9
            ],
            [
                'title' => 'Full-Stack Web Development',
                'slug' => 'full-stack-web-development',
                'description' => 'Become a full-stack developer by learning both frontend and backend technologies in this comprehensive course.',
                'content' => '<h2>Full-Stack Journey</h2><p>Learn everything you need to become a full-stack web developer. This course covers frontend, backend, databases, and deployment.</p><h3>Tech Stack</h3><ul><li>HTML, CSS, JavaScript</li><li>React frontend development</li><li>Node.js and Express backend</li><li>Database design and integration</li><li>Deployment and DevOps basics</li></ul>',
                'price' => 149.99,
                'duration_hours' => 60,
                'level' => 'intermediate',
                'instructor_id' => $user->id,
                'is_published' => true,
                'enrolled_count' => random_int(80, 300),
                'rating' => 4.7
            ]
        ];

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);
            
            // Create lessons for each course
            $this->createLessonsForCourse($course);
        }
    }

    /**
     * Create lessons for a course.
     */
    protected function createLessonsForCourse(Course $course): void
    {
        $lessonsCount = random_int(8, 15);
        
        for ($i = 1; $i <= $lessonsCount; $i++) {
            Lesson::create([
                'title' => "Lesson {$i}: " . $this->generateLessonTitle($course->level, $i),
                'slug' => "lesson-{$i}-" . \Illuminate\Support\Str::slug($this->generateLessonTitle($course->level, $i)),
                'content' => $this->generateLessonContent($i),
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Placeholder
                'duration_minutes' => random_int(15, 45),
                'order' => $i,
                'course_id' => $course->id,
                'is_published' => true,
                'is_free' => $i <= 2 // First 2 lessons are free preview
            ]);
        }
    }

    /**
     * Generate lesson title based on course level.
     */
    protected function generateLessonTitle(string $level, int $lessonNumber): string
    {
        $titles = [
            'beginner' => [
                'Introduction and Setup',
                'Basic Concepts',
                'Your First Project',
                'Understanding the Fundamentals',
                'Working with Components',
                'State Management Basics',
                'Event Handling',
                'Styling and Layout',
                'Forms and Validation',
                'Routing Basics',
                'API Integration',
                'Best Practices',
                'Debugging Tips',
                'Project Deployment',
                'Next Steps'
            ],
            'intermediate' => [
                'Advanced Setup and Configuration',
                'Architecture Patterns',
                'Advanced Components',
                'State Management Solutions',
                'Performance Optimization',
                'Testing Strategies',
                'Security Considerations',
                'API Design',
                'Database Integration',
                'Authentication Systems',
                'Caching Strategies',
                'Error Handling',
                'Monitoring and Logging',
                'Production Deployment',
                'Scaling Considerations'
            ],
            'advanced' => [
                'System Architecture',
                'Design Patterns',
                'Advanced Algorithms',
                'Performance Profiling',
                'Memory Management',
                'Concurrency Patterns',
                'Microservices Design',
                'Load Balancing',
                'Database Optimization',
                'Security Hardening',
                'Monitoring Solutions',
                'CI/CD Pipelines',
                'Container Orchestration',
                'Cloud Architecture',
                'Industry Best Practices'
            ]
        ];

        $levelTitles = $titles[$level] ?? $titles['beginner'];
        return $levelTitles[($lessonNumber - 1) % count($levelTitles)];
    }

    /**
     * Generate lesson content.
     */
    protected function generateLessonContent(int $lessonNumber): string
    {
        return "<h2>Lesson {$lessonNumber} Overview</h2>" .
               "<p>In this lesson, you will learn important concepts that build upon previous lessons. " .
               "We will cover practical examples and hands-on exercises to reinforce your understanding.</p>" .
               "<h3>Learning Objectives</h3>" .
               "<ul>" .
               "<li>Understand the key concepts presented</li>" .
               "<li>Apply knowledge through practical exercises</li>" .
               "<li>Build upon previous lesson foundations</li>" .
               "<li>Prepare for upcoming advanced topics</li>" .
               "</ul>" .
               "<h3>Key Takeaways</h3>" .
               "<p>By the end of this lesson, you will have a solid understanding of the topics covered " .
               "and be ready to move on to the next lesson in the sequence.</p>";
    }
}