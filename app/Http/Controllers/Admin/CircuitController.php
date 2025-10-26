<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circuit;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Circuit::with('destination');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Destination filter
        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        $circuits = $query->latest()->paginate(10)->withQueryString();
        
        $destinations = Destination::all();

        return view('admin.circuits.index', compact('circuits', 'destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = Destination::all();

        return view('admin.circuits.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:circuits',
                'description' => 'nullable|string',
                'duration_days' => 'required|integer|min:1',
                'price_from' => 'nullable|numeric|min:0',
                'highlights' => 'nullable|string',
                'tags' => 'nullable|string',
                'itinerary' => 'nullable|string',
                'destination_id' => 'nullable|exists:destinations,id',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $request->file('featured_image')->store('circuits', 'public');
            }

            $circuit = Circuit::create($validated);

            return redirect()->route('admin.circuits.index')->with('success', 'Circuit "' . $circuit->name . '" created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the circuit: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Circuit $circuit)
    {
        return view('admin.circuits.show', compact('circuit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Circuit $circuit)
    {
        $destinations = Destination::all();

        return view('admin.circuits.edit', compact('circuit', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Circuit $circuit)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:circuits,slug,'.$circuit->id,
                'description' => 'nullable|string',
                'duration_days' => 'required|integer|min:1',
                'price_from' => 'nullable|numeric|min:0',
                'highlights' => 'nullable|string',
                'tags' => 'nullable|string',
                'itinerary' => 'nullable|string',
                'destination_id' => 'nullable|exists:destinations,id',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'remove_featured_image' => 'nullable|boolean',
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

            // Handle featured image removal
            if ($request->boolean('remove_featured_image')) {
                if ($circuit->featured_image && Storage::disk('public')->exists($circuit->featured_image)) {
                    Storage::disk('public')->delete($circuit->featured_image);
                }
                $validated['featured_image'] = null;
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($circuit->featured_image && Storage::disk('public')->exists($circuit->featured_image)) {
                    Storage::disk('public')->delete($circuit->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')->store('circuits', 'public');
            }

            $circuit->update($validated);

            return redirect()->route('admin.circuits.index')->with('success', 'Circuit "' . $circuit->name . '" updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the circuit: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Circuit $circuit)
    {
        try {
            // Delete featured image if exists
            if ($circuit->featured_image && Storage::disk('public')->exists($circuit->featured_image)) {
                Storage::disk('public')->delete($circuit->featured_image);
            }
            
            $circuitName = $circuit->name;
            $circuit->delete();

            return redirect()->route('admin.circuits.index')->with('success', 'Circuit "' . $circuitName . '" deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the circuit: ' . $e->getMessage());
        }
    }

    /**
     * Duplicate a circuit
     */
    public function duplicate(Circuit $circuit)
    {
        $newCircuit = $circuit->replicate();
        $newCircuit->name = $circuit->name . ' (Copy)';
        $newCircuit->slug = $circuit->slug . '-copy';
        $newCircuit->is_active = false; // Set duplicate as inactive by default
        $newCircuit->created_at = now();
        $newCircuit->updated_at = now();
        $newCircuit->save();

        // Copy the featured image if it exists
        if ($circuit->featured_image) {
            $extension = pathinfo($circuit->featured_image, PATHINFO_EXTENSION);
            $newFilename = 'circuits/' . uniqid() . '_' . time() . '.' . $extension;
            
            if (Storage::disk('public')->exists($circuit->featured_image)) {
                Storage::disk('public')->copy($circuit->featured_image, $newFilename);
                $newCircuit->featured_image = $newFilename;
                $newCircuit->save();
            }
        }

        return redirect()->route('admin.circuits.index')->with('success', 'Circuit duplicated successfully. You can now edit the copy.');
    }
}
