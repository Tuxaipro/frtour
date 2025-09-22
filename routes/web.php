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
    $destinations = \App\Models\Destination::where('is_active', true)->orderBy('name')->get();
    return response()->json($destinations);
})->name('api.destinations');

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

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('destinations', DestinationController::class);
    Route::resource('circuits', CircuitController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('pages', PageController::class);
    Route::resource('galerie', GalerieController::class);
    Route::resource('galerie-category', GalerieCategoryController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('heroes', HeroController::class);
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