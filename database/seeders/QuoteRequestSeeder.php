<?php

namespace Database\Seeders;

use App\Models\QuoteRequest;
use Illuminate\Database\Seeder;

class QuoteRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quoteRequests = [
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1 234 567 8900',
                'travel_dates' => '2025-12-15',
                'number_of_travelers' => 2,
                'preferences' => 'Rajasthan',
                'special_requests' => 'Interested in a 10-day tour of Rajasthan including Jaipur, Udaipur, and Jodhpur. Looking for luxury accommodations.',
                'budget_range' => 'Luxury',
                'is_processed' => false,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Johnson',
                'email' => 'emily.j@example.com',
                'phone' => '+44 1234 567890',
                'travel_dates' => '2026-01-20',
                'number_of_travelers' => 2,
                'preferences' => 'Kerala',
                'special_requests' => 'Planning a honeymoon trip to Kerala. Interested in houseboat stays in Alleppey and wildlife tours in Periyar.',
                'budget_range' => 'Mid-range',
                'is_processed' => true,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Chen',
                'email' => 'michael.chen@example.com',
                'phone' => '+86 138 0013 8000',
                'travel_dates' => '2025-11-30',
                'number_of_travelers' => 1,
                'preferences' => 'Goa and Mumbai',
                'special_requests' => 'Business trip combined with leisure. Need 5 days in Goa and 3 days in Mumbai. Looking for recommendations on beaches and business districts.',
                'budget_range' => 'Business',
                'is_processed' => false,
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Williams',
                'email' => 'sarah.w@example.com',
                'phone' => '+61 412 345 678',
                'travel_dates' => '2026-03-10',
                'number_of_travelers' => 1,
                'preferences' => 'Himalayan Trek',
                'special_requests' => 'Experienced trekker looking for challenging Himalayan treks. Interested in Ladakh and Himachal Pradesh. Need guidance on permits and best seasons.',
                'budget_range' => 'Adventure',
                'is_processed' => false,
            ],
        ];

        foreach ($quoteRequests as $quoteRequestData) {
            QuoteRequest::updateOrCreate(
                [
                    'email' => $quoteRequestData['email'],
                    'travel_dates' => $quoteRequestData['travel_dates'],
                ],
                $quoteRequestData
            );
        }
    }
}