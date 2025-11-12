<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CircuitController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalerieController;
use App\Http\Controllers\Admin\GalerieCategoryController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuoteRequestController as AdminQuoteRequestController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteRequestController;
use Illuminate\Support\Facades\Route;

// Frontend routes
Route::match(['GET', 'HEAD'], '/', function () {
    $heroes = \App\Models\Hero::active()->ordered()->get();
    $circuits = \App\Models\Circuit::where('is_active', true)->inRandomOrder()->take(6)->get();
    $categories = \App\Models\GalerieCategory::where('is_active', true)->inRandomOrder()->take(6)->get();
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('sort_order')->get();
    $blogs = \App\Models\Blog::where('is_published', true)->orderBy('created_at', 'desc')->take(3)->get();
    $destinations = \App\Models\Destination::where('is_active', true)->orderBy('name')->get();
    return view('welcome', compact('heroes', 'circuits', 'categories', 'faqs', 'blogs', 'destinations'));
})->name('home');
Route::get('/destinations/{slug}', [FrontendController::class, 'destination'])->name('destination');
Route::get('/circuits/{slug}', [FrontendController::class, 'circuit'])->name('circuit');
// Submenu pages
Route::get('/groupe', [FrontendController::class, 'groupe'])->name('groupe');
Route::get('/nepal', [FrontendController::class, 'nepal'])->name('nepal');
Route::get('/north-india', [FrontendController::class, 'northIndia'])->name('north-india');
Route::get('/south-india', [FrontendController::class, 'southIndia'])->name('south-india');
Route::get('/sri-lanka', [FrontendController::class, 'sriLanka'])->name('sri-lanka');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogPost'])->name('blog.show');
Route::get('/blog-detail', [FrontendController::class, 'blogDetail'])->name('blog-detail');
Route::get('/galerie', [FrontendController::class, 'galerie'])->name('galerie');
Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page');
Route::post('/quote-requests', [QuoteRequestController::class, 'store'])->name('quote-requests.store');


// Contact form routes
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/captcha', [ContactController::class, 'refreshCaptcha'])->name('contact.captcha');
Route::get('/api/destinations', function() {
    try {
    $destinations = \App\Models\Destination::where('is_active', true)->orderBy('name')->get();
        return response()->json($destinations, 200, [], JSON_UNESCAPED_UNICODE);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Database error in destinations API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Database error',
            'message' => 'Unable to load destinations'
        ], 500);
    } catch (\Exception $e) {
        \Log::error('Error in destinations API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Failed to load destinations',
            'message' => 'An error occurred'
        ], 500);
    }
})->name('api.destinations');

Route::get('/api/logo-settings', function() {
    try {
        // Helper function to get image URL
        $getImageUrl = function($path) {
            if (empty($path)) {
                return '';
            }
            
            // Handle array values (if cast as array)
            if (is_array($path)) {
                $path = $path[0] ?? '';
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
        };
        
        // Helper to decode Unicode escape sequences
        $decodeUnicode = function($str) {
            if (!is_string($str)) {
                return $str;
            }
            // Decode Unicode escape sequences like \u00e9
            return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $str);
        };
        
        // Helper to safely get setting value
        $getSetting = function($key, $default = '') use ($decodeUnicode) {
            try {
                $setting = \App\Models\Setting::where('key', $key)->first();
                if (!$setting) {
                    return $default;
                }
                $value = $setting->getAttributes()['value'] ?? $default;
                
                // Clean the value: remove quotes and trim whitespace
                if (is_string($value) && !empty($value)) {
                    $value = trim($value);
                    $value = trim($value, '"\'');
                    // Decode Unicode escape sequences
                    $value = $decodeUnicode($value);
                }
                
                // Handle array cast - if it's an array with one element, return the element
                if (is_array($value) && count($value) === 1) {
                    $value = $value[0];
                    if (is_string($value)) {
                        $value = trim($value);
                        $value = trim($value, '"\'');
                        $value = $decodeUnicode($value);
                    }
                }
                
                return is_array($value) ? $default : $value;
            } catch (\Exception $e) {
                return $default;
            }
        };
        
    $settings = [
        'site_logo_url' => '',
        'logo_light_url' => '',
            'site_name' => $getSetting('site_name', 'India Tourisme'),
            'site_description' => $getSetting('site_description', 'Spécialiste des voyages sur-mesure'),
    ];
    
        $siteLogo = $getSetting('site_logo', '');
        $logoLight = $getSetting('logo_light', '');
    
    if ($siteLogo) {
            $settings['site_logo_url'] = $getImageUrl($siteLogo);
    }
    
    if ($logoLight) {
            $settings['logo_light_url'] = $getImageUrl($logoLight);
        }
        
        return response()->json($settings, 200, [], JSON_UNESCAPED_UNICODE);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Database error in logo-settings API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Database error',
            'message' => 'Unable to load logo settings'
        ], 500);
    } catch (\Exception $e) {
        \Log::error('Error in logo-settings API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Failed to load logo settings',
            'message' => 'An error occurred'
        ], 500);
    }
})->name('api.logo-settings');

Route::get('/api/social-settings', function() {
    try {
        // Helper to safely get setting value
        $getSetting = function($key, $default = '') {
            try {
                $setting = \App\Models\Setting::where('key', $key)->first();
                if (!$setting) {
                    return $default;
                }
                $value = $setting->getAttributes()['value'] ?? $default;
                
                // Clean the value: remove quotes and trim whitespace
                if (is_string($value) && !empty($value)) {
                    $value = trim($value);
                    $value = trim($value, '"\'');
                }
                
                // Handle array cast - if it's an array with one element, return the element
                if (is_array($value) && count($value) === 1) {
                    $value = $value[0];
                    if (is_string($value)) {
                        $value = trim($value);
                        $value = trim($value, '"\'');
                    }
                }
                
                return is_array($value) ? $default : $value;
            } catch (\Exception $e) {
                return $default;
            }
        };
        
    $settings = [
            'facebook_url' => $getSetting('facebook_url', '#'),
            'twitter_url' => $getSetting('twitter_url', '#'),
            'instagram_url' => $getSetting('instagram_url', '#'),
            'linkedin_url' => $getSetting('linkedin_url', '#'),
            'youtube_url' => $getSetting('youtube_url', '#'),
            'contact_whatsapp_url' => $getSetting('contact_whatsapp_url', ''),
            'contact_phone' => $getSetting('contact_phone', '+1 (555) 123-4567'),
            'contact_email' => $getSetting('contact_email', 'info@example.com'),
    ];
    
        return response()->json($settings, 200, [], JSON_UNESCAPED_UNICODE);
    } catch (\Illuminate\Database\QueryException $e) {
        \Log::error('Database error in social-settings API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Database error',
            'message' => 'Unable to load social settings'
        ], 500);
    } catch (\Exception $e) {
        \Log::error('Error in social-settings API: ' . $e->getMessage());
        return response()->json([
            'error' => 'Failed to load social settings',
            'message' => 'An error occurred'
        ], 500);
    }
})->name('api.social-settings');

// Sitemap Route
Route::get('/sitemap.xml', function() {
    $destinations = \App\Models\Destination::where('is_active', true)->get();
    $circuits = \App\Models\Circuit::where('is_active', true)->get();
    $blogs = \App\Models\Blog::where('is_published', true)->get();
    $pages = \App\Models\Page::where('is_active', true)->get();
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    // Homepage
    $sitemap .= '<url>';
    $sitemap .= '<loc>' . url('/') . '</loc>';
    $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
    $sitemap .= '<changefreq>weekly</changefreq>';
    $sitemap .= '<priority>1.0</priority>';
    $sitemap .= '</url>';
    
    // Static pages
    $staticPages = ['/groupe', '/nepal', '/north-india', '/south-india', '/sri-lanka', '/blog', '/galerie'];
    foreach($staticPages as $page) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . url($page) . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.8</priority>';
        $sitemap .= '</url>';
    }
    
    // Destinations
    foreach($destinations as $destination) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . route('destination', $destination->slug) . '</loc>';
        $sitemap .= '<lastmod>' . $destination->updated_at->format('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.7</priority>';
        $sitemap .= '</url>';
    }
    
    // Circuits
    foreach($circuits as $circuit) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . route('circuit', $circuit->slug) . '</loc>';
        $sitemap .= '<lastmod>' . $circuit->updated_at->format('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.7</priority>';
        $sitemap .= '</url>';
    }
    
    // Blog posts
    foreach($blogs as $blog) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . route('blog.show', $blog->slug) . '</loc>';
        $sitemap .= '<lastmod>' . $blog->updated_at->format('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.6</priority>';
        $sitemap .= '</url>';
    }
    
    // Pages
    foreach($pages as $page) {
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . route('page', $page->slug) . '</loc>';
        $sitemap .= '<lastmod>' . $page->updated_at->format('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>monthly</changefreq>';
        $sitemap .= '<priority>0.5</priority>';
        $sitemap .= '</url>';
    }
    
    $sitemap .= '</urlset>';
    
    return response($sitemap, 200)->header('Content-Type', 'text/xml');
})->name('sitemap');

// Redirect /admin to /admin/dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified', 'admin']);

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('destinations', DestinationController::class);
    Route::post('/destinations/{destination}/duplicate', [DestinationController::class, 'duplicate'])->name('destinations.duplicate');
    Route::resource('circuits', CircuitController::class);
    Route::post('/circuits/{circuit}/duplicate', [CircuitController::class, 'duplicate'])->name('circuits.duplicate');
    Route::resource('blogs', BlogController::class);
    Route::post('/blogs/{blog}/duplicate', [BlogController::class, 'duplicate'])->name('blogs.duplicate');
    Route::resource('pages', PageController::class);
    Route::post('/pages/{page}/duplicate', [PageController::class, 'duplicate'])->name('pages.duplicate');
    Route::resource('galerie', GalerieController::class);
    Route::resource('galerie-category', GalerieCategoryController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('heroes', HeroController::class);
    Route::post('/heroes/{hero}/duplicate', [HeroController::class, 'duplicate'])->name('heroes.duplicate');
    Route::resource('quote-requests', AdminQuoteRequestController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('/contacts/{contact}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('contacts.toggle-read');
    
    // Custom routes for settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';