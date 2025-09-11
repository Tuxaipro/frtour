<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General settings
            ['key' => 'site_name', 'value' => 'OnePage CMS', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'A modern CMS for travel agencies', 'type' => 'string', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@example.com', 'type' => 'string', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+1 (555) 123-4567', 'type' => 'string', 'group' => 'general'],
            
            // SEO settings
            ['key' => 'meta_title', 'value' => 'OnePage CMS - Travel Agency', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Discover amazing travel destinations with our expertly crafted tours.', 'type' => 'string', 'group' => 'seo'],
            
            // Social media settings
            ['key' => 'facebook_url', 'value' => 'https://facebook.com', 'type' => 'string', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com', 'type' => 'string', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}