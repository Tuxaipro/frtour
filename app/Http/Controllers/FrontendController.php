<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Circuit;
use App\Models\Destination;
use App\Models\Galerie;
use App\Models\GalerieCategory;
use App\Models\Page;

class FrontendController extends Controller
{
    public function index()
    {
        $circuits = Circuit::with('destination')->where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();

        return view('welcome', compact('circuits', 'destinations'));
    }

    public function destination($slug)
    {
        // Load destination with all necessary fields - explicitly refresh to avoid caching
        $destination = Destination::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Refresh the model to ensure we have latest data
        $destination->refresh();
        
        // Load circuits for this destination
        $circuits = Circuit::where('destination_id', $destination->id)
            ->where('is_active', true)
            ->get();

        // Debug: Log the destination being loaded
        \Log::info('Loading destination', [
            'slug' => $slug,
            'id' => $destination->id,
            'name' => $destination->name,
            'hero_title' => $destination->hero_title,
            'cover_image' => $destination->cover_image
        ]);

        // Pass destination data to view
        return view('frontend.destination', compact('destination', 'circuits'));
    }

    public function circuit($slug)
    {
        $circuit = Circuit::with('destination')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return view('frontend.circuit', compact('circuit'));
    }

    public function groupe()
    {
        return view('frontend.groupe');
    }

    public function nepal()
    {
        // Redirect to dynamic destination route
        $destination = Destination::where('slug', 'nepal')->where('is_active', true)->first();
        if ($destination) {
            return redirect()->route('destination', $destination->slug);
        }
        return view('frontend.nepal');
    }

    public function northIndia()
    {
        // Redirect to dynamic destination route
        $destination = Destination::where('slug', 'north-india')->where('is_active', true)->first();
        if ($destination) {
            return redirect()->route('destination', $destination->slug);
        }
        return view('frontend.north-india');
    }

    public function southIndia()
    {
        // Redirect to dynamic destination route
        $destination = Destination::where('slug', 'south-india')->where('is_active', true)->first();
        if ($destination) {
            return redirect()->route('destination', $destination->slug);
        }
        return view('frontend.south-india');
    }

    public function sriLanka()
    {
        // Redirect to dynamic destination route
        $destination = Destination::where('slug', 'sri-lanka')->where('is_active', true)->first();
        if ($destination) {
            return redirect()->route('destination', $destination->slug);
        }
        return view('frontend.sri-lanka');
    }

    public function blog()
    {
        $blogs = Blog::where('is_published', true)->orderBy('created_at', 'desc')->get();
        return view('frontend.blog', compact('blogs'));
    }

    public function blogDetail()
    {
        return view('frontend.blog-detail');
    }

    public function blogPost($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('frontend.blog-post', compact('blog'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('frontend.page', compact('page'));
    }

    public function galerie(Request $request)
    {
        $query = Galerie::with('category')->where('is_active', true)->orderBy('sort_order');
        
        // Filter by category if provided
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $galerie = $query->get();
        $categories = GalerieCategory::where('is_active', true)->orderBy('sort_order')->get();
        
        return view('frontend.galerie', compact('galerie', 'categories'));
    }

}