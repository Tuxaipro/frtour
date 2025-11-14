<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use App\Models\Destination;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = QuoteRequest::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('destinations', 'like', "%{$search}%")
                  ->orWhere('preferences', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('is_processed')) {
            $query->where('is_processed', $request->is_processed === 'processed');
        }

        // Get stats from all records (before filters)
        $totalCount = QuoteRequest::count();
        $pendingCount = QuoteRequest::where('is_processed', false)->count();
        $processedCount = QuoteRequest::where('is_processed', true)->count();
        $unreadCount = QuoteRequest::where('is_read', false)->count();
        
        $quoteRequests = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.quote-requests.index', compact('quoteRequests', 'totalCount', 'pendingCount', 'processedCount', 'unreadCount'));
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
        // Mark as read when viewed
        if (!$quoteRequest->is_read) {
            $quoteRequest->update(['is_read' => true]);
        }
        
        // Extract destination name from stored data
        $selectedDestination = null;
        if ($quoteRequest->destinations) {
            $destArray = json_decode($quoteRequest->destinations, true);
            if (is_array($destArray) && count($destArray) > 0) {
                $selectedDestination = is_numeric($destArray[0]) 
                    ? Destination::find($destArray[0])?->name 
                    : $destArray[0];
            }
        }
        
        // Extract duration, country from special_requests
        $duration = null;
        $country = null;
        $specialRequests = $quoteRequest->special_requests ?? '';
        if ($specialRequests) {
            if (preg_match('/Durée:\s*([^|]+)/', $specialRequests, $matches)) {
                $duration = trim($matches[1]);
            }
            if (preg_match('/Pays:\s*([^|]+)/', $specialRequests, $matches)) {
                $country = trim($matches[1]);
            }
            // Clean special requests (remove destination, duration, country parts)
            $specialRequests = preg_replace('/\s*\|\s*Destination:[^|]*/', '', $specialRequests);
            $specialRequests = preg_replace('/\s*\|\s*Durée:[^|]*/', '', $specialRequests);
            $specialRequests = preg_replace('/\s*\|\s*Pays:[^|]*/', '', $specialRequests);
            $specialRequests = trim($specialRequests);
        }
        
        // Extract message from preferences (message is stored in preferences)
        // If preferences contains "Préférences:" separator, split it
        $message = $quoteRequest->preferences ?? '';
        $preferences = '';
        if (strpos($message, "\n\nPréférences:\n") !== false) {
            $parts = explode("\n\nPréférences:\n", $message, 2);
            $message = $parts[0];
            $preferences = $parts[1] ?? '';
        }
        
        return view('admin.quote-requests.show', compact('quoteRequest', 'selectedDestination', 'duration', 'country', 'message', 'preferences', 'specialRequests'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuoteRequest $quoteRequest)
    {
        $destinations = Destination::where('is_active', true)->orderBy('name')->get();
        
        // Extract destination name from stored data
        $selectedDestination = null;
        if ($quoteRequest->destinations) {
            $destArray = json_decode($quoteRequest->destinations, true);
            if (is_array($destArray) && count($destArray) > 0) {
                $selectedDestination = is_numeric($destArray[0]) 
                    ? Destination::find($destArray[0])?->name 
                    : $destArray[0];
            }
        }
        
        // Extract duration, country from special_requests
        $duration = null;
        $country = null;
        if ($quoteRequest->special_requests) {
            if (preg_match('/Durée:\s*([^|]+)/', $quoteRequest->special_requests, $matches)) {
                $duration = trim($matches[1]);
            }
            if (preg_match('/Pays:\s*([^|]+)/', $quoteRequest->special_requests, $matches)) {
                $country = trim($matches[1]);
            }
        }
        
        // Extract message from preferences (message is stored in preferences)
        // If preferences contains "Préférences:" separator, split it
        $message = $quoteRequest->preferences ?? '';
        $preferences = '';
        if (strpos($message, "\n\nPréférences:\n") !== false) {
            $parts = explode("\n\nPréférences:\n", $message, 2);
            $message = $parts[0];
            $preferences = $parts[1] ?? '';
        }
        
        // Extract special requests (remove destination, duration, country parts)
        $specialRequests = $quoteRequest->special_requests ?? '';
        $specialRequests = preg_replace('/\s*\|\s*Destination:[^|]*/', '', $specialRequests);
        $specialRequests = preg_replace('/\s*\|\s*Durée:[^|]*/', '', $specialRequests);
        $specialRequests = preg_replace('/\s*\|\s*Pays:[^|]*/', '', $specialRequests);
        $specialRequests = trim($specialRequests);
        
        return view('admin.quote-requests.edit', compact('quoteRequest', 'destinations', 'selectedDestination', 'duration', 'country', 'message', 'preferences', 'specialRequests'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'travel_dates' => 'nullable|date',
            'number_of_travelers' => 'nullable|integer|min:1',
            'budget_range' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'preferences' => 'nullable|string|max:2000',
            'special_requests' => 'nullable|string|max:2000',
            'is_processed' => 'boolean',
        ]);

        // Prepare data for storage (matching frontend form structure)
        $data = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? '',
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'travel_dates' => $validated['travel_dates'] ?? null,
            'number_of_travelers' => $validated['number_of_travelers'] ?? 1,
            'budget_range' => $validated['budget_range'] ?? null,
            'destinations' => $validated['destination'] ? json_encode([$validated['destination']]) : null,
            'is_processed' => $request->has('is_processed') ? (bool)$request->is_processed : $quoteRequest->is_processed,
        ];
        
        // Store message in preferences (if preferences is empty, otherwise combine)
        if (empty($validated['preferences'])) {
            $data['preferences'] = $validated['message'];
        } else {
            $data['preferences'] = $validated['message'] . "\n\nPréférences:\n" . $validated['preferences'];
        }
        
        // Store special requests with destination, duration, country appended
        $specialRequests = $validated['special_requests'] ?? '';
        $specialRequests .= ($validated['destination'] ? ' | Destination: ' . $validated['destination'] : '');
        $specialRequests .= ($validated['duration'] ? ' | Durée: ' . $validated['duration'] : '');
        $specialRequests .= ($validated['country'] ? ' | Pays: ' . $validated['country'] : '');
        $data['special_requests'] = $specialRequests ?: null;

        $quoteRequest->update($data);

        return redirect()->route('admin.quote-requests.index')->with('success', 'Quote request updated successfully.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(QuoteRequest $quoteRequest)
    {
        $quoteRequest->update([
            'is_processed' => !$quoteRequest->is_processed
        ]);

        return redirect()->route('admin.quote-requests.index')->with('success', 'Quote request status updated successfully.');
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
