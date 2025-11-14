<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('circuit', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }
        
        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
        
        // Order by
        $query->orderBy('sort_order', 'asc')
              ->orderBy('created_at', 'desc');
        
        // Paginate results
        $reviews = $query->paginate(15)->withQueryString();
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextSortOrder = (Review::max('sort_order') ?? 0) + 1;
        return view('admin.reviews.create', compact('nextSortOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'circuit' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_initials' => 'nullable|string|max:2',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate avatar initials from name if not provided
        if (empty($validated['avatar_initials'])) {
            $nameParts = explode(' ', $validated['name']);
            $initials = '';
            foreach ($nameParts as $part) {
                if (!empty($part)) {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
                if (strlen($initials) >= 2) break;
            }
            $validated['avatar_initials'] = $initials ?: 'U';
        } else {
            $validated['avatar_initials'] = strtoupper(substr($validated['avatar_initials'], 0, 2));
        }

        $validated['is_active'] = $request->has('is_active');
        
        // Auto-increment sort_order if not provided
        if (!isset($validated['sort_order']) || $validated['sort_order'] === null || $validated['sort_order'] === '') {
            $maxSortOrder = Review::max('sort_order') ?? 0;
            $validated['sort_order'] = $maxSortOrder + 1;
        } else {
            $validated['sort_order'] = (int)$validated['sort_order'];
        }

        Review::create($validated);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'circuit' => 'nullable|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar_initials' => 'nullable|string|max:2',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        // Generate avatar initials from name if not provided
        if (empty($validated['avatar_initials'])) {
            $nameParts = explode(' ', $validated['name']);
            $initials = '';
            foreach ($nameParts as $part) {
                if (!empty($part)) {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
                if (strlen($initials) >= 2) break;
            }
            $validated['avatar_initials'] = $initials ?: 'U';
        } else {
            $validated['avatar_initials'] = strtoupper(substr($validated['avatar_initials'], 0, 2));
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $review->update($validated);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
