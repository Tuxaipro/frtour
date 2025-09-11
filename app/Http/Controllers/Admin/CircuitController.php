<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circuit;
use App\Models\Destination;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $circuits = Circuit::with('destination')->latest()->paginate(10);

        return view('admin.circuits.index', compact('circuits'));
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
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

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
                'sort_order' => 'nullable|integer|min:0',
                'is_active' => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->boolean('is_active');

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
            $circuitName = $circuit->name;
            $circuit->delete();

            return redirect()->route('admin.circuits.index')->with('success', 'Circuit "' . $circuitName . '" deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the circuit: ' . $e->getMessage());
        }
    }
}
