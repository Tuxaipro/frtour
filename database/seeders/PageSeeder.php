<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'slug' => 'about-us',
                'content' => '<p>Welcome to our travel agency. We specialize in creating unforgettable journeys to India, offering personalized tours that showcase the rich culture, history, and natural beauty of this incredible country.</p>
                
                <h2>Our Story</h2>
                <p>Founded in 2010, our company began with a simple mission: to provide authentic and meaningful travel experiences to visitors from around the world. Our team of experienced guides and travel experts are passionate about sharing the wonders of India with you.</p>
                
                <h2>Why Choose Us?</h2>
                <ul>
                    <li>Local expertise and insider knowledge</li>
                    <li>Personalized itineraries tailored to your interests</li>
                    <li>24/7 support during your journey</li>
                    <li>Commitment to responsible and sustainable tourism</li>
                </ul>',
                'meta_title' => 'About Us - India Tourisme',
                'meta_description' => 'Learn about our travel agency and why we are the best choice for your India tour.',
                'is_active' => true,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => '<h2>Get in Touch</h2>
                <p>We\'d love to hear from you! Whether you have questions about our tours, need help planning your trip, or just want to say hello, our team is here to assist you.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <h3>Contact Information</h3>
                        <ul class="space-y-2">
                            <li><strong>Address:</strong> 123 Travel Street, Mumbai, India</li>
                            <li><strong>Phone:</strong> +91 98765 43210</li>
                            <li><strong>Email:</strong> info@indiatourisme.com</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3>Office Hours</h3>
                        <ul class="space-y-2">
                            <li>Monday - Friday: 9:00 AM - 6:00 PM</li>
                            <li>Saturday: 10:00 AM - 4:00 PM</li>
                            <li>Sunday: Closed</li>
                        </ul>
                    </div>
                </div>
                
                <h3 class="mt-8">Send us a Message</h3>
                <p>For tour inquiries, please use our <a href="/quote-requests" class="text-blue-600 hover:underline">quote request form</a>.</p>',
                'meta_title' => 'Contact Us - India Tourisme',
                'meta_description' => 'Contact our travel agency for inquiries about India tours and travel planning.',
                'is_active' => true,
            ],
            [
                'title' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
                'content' => '<h2>Terms and Conditions</h2>
                <p>Welcome to India Tourisme. These terms and conditions outline the rules and regulations for the use of our website and services.</p>
                
                <h3>1. Introduction</h3>
                <p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use India Tourisme if you do not agree to all of the terms and conditions stated on this page.</p>
                
                <h3>2. Intellectual Property Rights</h3>
                <p>Unless otherwise stated, India Tourisme and/or its licensors own the intellectual property rights for all material on this website.</p>
                
                <h3>3. Bookings and Payments</h3>
                <p>All bookings are subject to availability and confirmation. A deposit may be required at the time of booking, with the balance due prior to travel.</p>
                
                <h3>4. Cancellations and Refunds</h3>
                <p>Cancellation policies vary by tour. Please refer to the specific tour details for cancellation and refund information.</p>
                
                <h3>5. Limitation of Liability</h3>
                <p>India Tourisme shall not be held liable for any consequential, incidental, indirect, or special damages arising out of your use of our services.</p>',
                'meta_title' => 'Terms and Conditions - India Tourisme',
                'meta_description' => 'Read our terms and conditions for using our travel services and website.',
                'is_active' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2>
                <p>Your privacy is important to us. This privacy policy explains how we collect, use, and protect your personal information.</p>
                
                <h3>1. Information We Collect</h3>
                <p>We may collect personal information such as your name, email address, phone number, and travel preferences when you use our services.</p>
                
                <h3>2. How We Use Your Information</h3>
                <p>We use your information to:
                <ul>
                    <li>Process your bookings and provide our services</li>
                    <li>Communicate with you about your travel plans</li>
                    <li>Send you relevant travel information and updates</li>
                    <li>Improve our website and services</li>
                </ul></p>
                
                <h3>3. Information Sharing</h3>
                <p>We do not sell, trade, or rent your personal information to third parties. We may share information with trusted partners who assist us in operating our website or providing services.</p>
                
                <h3>4. Data Security</h3>
                <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p>
                
                <h3>5. Your Rights</h3>
                <p>You have the right to access, update, or delete your personal information. Contact us if you wish to exercise these rights.</p>',
                'meta_title' => 'Privacy Policy - India Tourisme',
                'meta_description' => 'Learn how we protect your privacy and handle your personal information.',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}