<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Circuit;
use App\Models\Destination;
use App\Models\QuoteRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinations' => Destination::count(),
            'circuits' => Circuit::count(),
            'blogs' => Blog::count(),
            'quote_requests' => QuoteRequest::where('is_processed', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
