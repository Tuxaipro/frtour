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
        $circuits = Circuit::where('is_active', true)->orderBy('sort_order')->take(3)->get();
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();

        return view('frontend.index', compact('circuits', 'destinations'));
    }

    public function destination($slug)
    {
        $destination = Destination::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $circuits = Circuit::where('destination_id', $destination->id)->where('is_active', true)->get();

        return view('frontend.destination', compact('destination', 'circuits'));
    }

    public function circuit($slug)
    {
        $circuit = Circuit::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        return view('frontend.circuit', compact('circuit'));
    }

    public function groupe()
    {
        return view('frontend.groupe');
    }

    public function nepal()
    {
        return view('frontend.nepal');
    }

    public function northIndia()
    {
        return view('frontend.north-india');
    }

    public function southIndia()
    {
        return view('frontend.south-india');
    }

    public function sriLanka()
    {
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