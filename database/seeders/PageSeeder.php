<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about',
                'content' => '<h2>About Our Company</h2><p>We are a leading platform for online learning and content management. Our mission is to make quality education accessible to everyone through innovative technology and engaging content.</p><p>Founded in 2024, we have helped thousands of students and content creators build successful online presences.</p>',
                'excerpt' => 'Learn more about our mission and vision for online education',
                'meta_title' => 'About Us - Learn About Our Mission',
                'meta_description' => 'Discover our story, mission, and commitment to providing quality online education and content management solutions.',
                'is_published' => true,
                'has_contact_form' => false
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'content' => '<h2>Get in Touch</h2><p>We would love to hear from you! Whether you have questions about our platform, need support, or want to discuss partnership opportunities, do not hesitate to reach out.</p><h3>Our Office</h3><p>123 Learning Street<br>Education City, EC 12345<br>Phone: (555) 123-4567<br>Email: hello@cmsplatform.com</p>',
                'excerpt' => 'Contact us for support, partnerships, or general inquiries',
                'meta_title' => 'Contact Us - Get in Touch',
                'meta_description' => 'Contact our team for support, partnerships, or any questions about our CMS platform and online courses.',
                'is_published' => true,
                'has_contact_form' => true
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'content' => '<h2>Privacy Policy</h2><p>Last updated: January 2024</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you create an account, enroll in courses, or contact us.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.</p><h3>Information Sharing</h3><p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p>',
                'excerpt' => 'Our commitment to protecting your privacy and personal data',
                'meta_title' => 'Privacy Policy - Your Data Protection',
                'meta_description' => 'Learn how we collect, use, and protect your personal information on our platform.',
                'is_published' => true,
                'has_contact_form' => false
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms',
                'content' => '<h2>Terms of Service</h2><p>Last updated: January 2024</p><h3>Acceptance of Terms</h3><p>By accessing and using our platform, you accept and agree to be bound by the terms and provision of this agreement.</p><h3>User Accounts</h3><p>You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p><h3>Course Content</h3><p>All course content is protected by copyright and other intellectual property laws. You may not redistribute or resell access to our courses.</p>',
                'excerpt' => 'Terms and conditions for using our platform and services',
                'meta_title' => 'Terms of Service - Platform Usage Terms',
                'meta_description' => 'Read our terms of service to understand your rights and responsibilities when using our CMS platform.',
                'is_published' => true,
                'has_contact_form' => false
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}