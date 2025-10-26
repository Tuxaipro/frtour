<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Destination::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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

        $destinations = $query->latest()->paginate(10)->withQueryString();

        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:destinations',
                'description' => 'nullable|string',
                'hero_title' => 'nullable|string|max:255',
                'hero_description' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

            $destination = Destination::create($validated);

            return redirect()->route('admin.destinations.index')
                ->with('success', "Destination '{$destination->name}' created successfully.");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating the destination: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:destinations,slug,'.$destination->id,
                'description' => 'nullable|string',
                'hero_title' => 'nullable|string|max:255',
                'hero_description' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

            $destination->update($validated);

            return redirect()->route('admin.destinations.index')
                ->with('success', "Destination '{$destination->name}' updated successfully.");
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the destination: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        try {
            $destinationName = $destination->name;
            $destination->delete();

            return redirect()->route('admin.destinations.index')
                ->with('success', "Destination '{$destinationName}' deleted successfully.");
        } catch (\Exception $e) {
            return redirect()->route('admin.destinations.index')
                ->with('error', 'An error occurred while deleting the destination: ' . $e->getMessage());
        }
    }

    /**
     * Duplicate a destination
     */
    public function duplicate(Destination $destination)
    {
        $newDestination = $destination->replicate();
        $newDestination->name = $destination->name . ' (Copy)';
        $newDestination->slug = $destination->slug . '-copy';
        $newDestination->is_active = false; // Set duplicate as inactive by default
        $newDestination->created_at = now();
        $newDestination->updated_at = now();
        $newDestination->save();

        return redirect()->route('admin.destinations.index')->with('success', 'Destination duplicated successfully. You can now edit the copy.');
    }
}
