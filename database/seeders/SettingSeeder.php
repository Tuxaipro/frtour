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
            ['key' => 'site_name', 'value' => 'India Tourisme', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Votre spécialiste des voyages en Inde depuis plus de 15 ans. Découvrez l\'authenticité de l\'Inde avec nos circuits sur mesure et nos guides locaux expérimentés.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'contact@indiatourisme.fr', 'type' => 'string', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '+33 1 23 45 67 89', 'type' => 'string', 'group' => 'general'],
            ['key' => 'address', 'value' => '123 Rue de l\'Inde, 75001 Paris', 'type' => 'string', 'group' => 'general'],
            ['key' => 'business_hours', 'value' => 'Lun-Ven: 9h-18h, Sam: 9h-13h', 'type' => 'string', 'group' => 'general'],
            
            // SEO settings
            ['key' => 'meta_title', 'value' => 'India Tourisme - Voyages sur mesure en Inde', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Voyages sur mesure en Inde, Sri Lanka, Népal et Bhoutan. Circuits privés, chauffeurs anglophones/francophones, assistance 24/7.', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'voyage inde, circuit inde, tourisme inde, voyage sur mesure', 'type' => 'string', 'group' => 'seo'],
            
            // Social media settings
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/indiatourisme', 'type' => 'string', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/indiatourisme', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/indiatourisme', 'type' => 'string', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/indiatourisme', 'type' => 'string', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/indiatourisme', 'type' => 'string', 'group' => 'social'],
            
            // Business settings
            ['key' => 'currency', 'value' => 'EUR', 'type' => 'string', 'group' => 'business'],
            ['key' => 'timezone', 'value' => 'Europe/Paris', 'type' => 'string', 'group' => 'business'],
            ['key' => 'language', 'value' => 'fr', 'type' => 'string', 'group' => 'business'],
            
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}