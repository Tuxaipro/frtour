<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share settings with all frontend views
        View::composer('*', function ($view) {
            // Only load settings for frontend views (not admin views)
            if (!str_contains($view->getName(), 'admin') && !str_contains($view->getName(), 'auth')) {
                $settings = Setting::all()->pluck('value', 'key')->toArray();
                $view->with('settings', $settings);
            }
        });

        // Share specific settings with all views for common usage
        View::composer('*', function ($view) {
            $view->with([
                'siteName' => Setting::get('site_name', config('app.name', 'Laravel')),
                'siteDescription' => Setting::get('site_description', 'Travel website'),
                'contactEmail' => Setting::get('contact_email', 'info@example.com'),
                'contactPhone' => Setting::get('contact_phone', '+1 (555) 123-4567'),
                'contactWhatsapp' => Setting::get('contact_whatsapp', ''),
                'contactWhatsappUrl' => Setting::get('contact_whatsapp_url', ''),
                'businessHours' => Setting::get('business_hours', ''),
                'siteLogo' => Setting::get('site_logo', ''),
                'siteLogoUrl' => $this->getImageUrl(Setting::get('site_logo', '')),
                'logoLight' => Setting::get('logo_light', ''),
                'logoLightUrl' => $this->getImageUrl(Setting::get('logo_light', '')),
                'siteFavicon' => Setting::get('site_favicon', ''),
                'siteFaviconUrl' => $this->getImageUrl(Setting::get('site_favicon', '')),
                'metaTitle' => Setting::get('meta_title', 'Travel Agency'),
                'metaDescription' => Setting::get('meta_description', 'Discover amazing travel destinations'),
                'facebookUrl' => Setting::get('facebook_url', '#'),
                'twitterUrl' => Setting::get('twitter_url', '#'),
                'instagramUrl' => Setting::get('instagram_url', '#'),
                'linkedinUrl' => Setting::get('linkedin_url', '#'),
                'youtubeUrl' => Setting::get('youtube_url', '#'),
                'currency' => Setting::get('currency', 'EUR'),
                'timezone' => Setting::get('timezone', 'UTC'),
                'language' => Setting::get('language', 'en'),
            ]);
        });
    }
    
    /**
     * Get proper image URL for different path formats
     */
    private function getImageUrl($path)
    {
        if (empty($path)) {
            return '';
        }
        
        // Clean the path: remove quotes, trim whitespace, fix double slashes
        $path = trim($path);
        $path = trim($path, '"\'');
        $path = preg_replace('#/+#', '/', $path); // Replace multiple slashes with single slash
        $path = ltrim($path, '/'); // Remove only leading slashes (keep trailing if needed)
        
        if (empty($path)) {
            return '';
        }
        
        // If path starts with storage/, it's already a storage path
        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }
        
        // If path starts with /images/, it's a public path
        if (str_starts_with($path, '/images/')) {
            return asset($path);
        }
        
        // If path starts with images/, it's a public path
        if (str_starts_with($path, 'images/')) {
            return asset('/' . $path);
        }
        
        // Default: treat as storage path
        return asset('storage/' . $path);
    }
}
