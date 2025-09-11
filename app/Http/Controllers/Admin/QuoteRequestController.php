<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quoteRequests = QuoteRequest::orderBy('created_at', 'desc')->get();
        return view('admin.quote-requests.index', compact('quoteRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quote-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'travel_dates' => 'nullable|date',
            'number_of_travelers' => 'integer|min:1',
            'preferences' => 'nullable|string',
            'special_requests' => 'nullable|string',
            'budget_range' => 'nullable|string|max:255',
        ]);

        QuoteRequest::create($request->all());

        return redirect()->route('admin.quote-requests.index')->with('success', 'Quote request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteRequest $quoteRequest)
    {
        return view('admin.quote-requests.show', compact('quoteRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuoteRequest $quoteRequest)
    {
        return view('admin.quote-requests.edit', compact('quoteRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'travel_dates' => 'nullable|date',
            'number_of_travelers' => 'integer|min:1',
            'preferences' => 'nullable|string',
            'special_requests' => 'nullable|string',
            'budget_range' => 'nullable|string|max:255',
            'is_processed' => 'boolean',
        ]);

        $quoteRequest->update($request->all());

        return redirect()->route('admin.quote-requests.index')->with('success', 'Quote request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteRequest $quoteRequest)
    {
        $quoteRequest->delete();
        return redirect()->route('admin.quote-requests.index')->with('success', 'Quote request deleted successfully.');
    }
}
