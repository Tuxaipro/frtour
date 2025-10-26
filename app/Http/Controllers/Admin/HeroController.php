<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Hero::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%");
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

        $heroes = $query->ordered()->paginate(20)->withQueryString();
        
        return view('admin.heroes.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.heroes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'primary_button_text' => 'nullable|string|max:100',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:100',
            'secondary_button_url' => 'nullable|string|max:255',
            'tertiary_button_text' => 'nullable|string|max:100',
            'tertiary_button_url' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'badge_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ], [], [
            'primary_button_url' => 'Primary Button URL',
            'secondary_button_url' => 'Secondary Button URL',
            'tertiary_button_url' => 'Tertiary Button URL',
        ]);

        // Custom URL validation that allows #circuits and other hash fragments
        $this->validateUrls($request);

        $data = $request->all();
        
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('heroes', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        Hero::create($data);

        return redirect()->route('admin.heroes.index')->with('success', 'Hero section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        return view('admin.heroes.show', compact('hero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        return view('admin.heroes.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'primary_button_text' => 'nullable|string|max:100',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:100',
            'secondary_button_url' => 'nullable|string|max:255',
            'tertiary_button_text' => 'nullable|string|max:100',
            'tertiary_button_url' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:1024',
            'badge_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ], [], [
            'primary_button_url' => 'Primary Button URL',
            'secondary_button_url' => 'Secondary Button URL',
            'tertiary_button_url' => 'Tertiary Button URL',
        ]);

        // Custom URL validation that allows #circuits and other hash fragments
        $this->validateUrls($request);

        $data = $request->all();

        // Handle background image removal
        if ($request->has('remove_background_image') && $hero->background_image) {
            Storage::disk('public')->delete($hero->background_image);
            $data['background_image'] = null;
        } elseif ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($hero->background_image) {
                Storage::disk('public')->delete($hero->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('heroes', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $hero->update($data);

        return redirect()->route('admin.heroes.index')->with('success', 'Hero section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        // Delete background image if exists
        if ($hero->background_image) {
            Storage::disk('public')->delete($hero->background_image);
        }

        $hero->delete();

        return redirect()->route('admin.heroes.index')->with('success', 'Hero section deleted successfully.');
    }

    /**
     * Custom URL validation that allows hash fragments like #circuits
     */
    private function validateUrls(Request $request)
    {
        $urlFields = ['primary_button_url', 'secondary_button_url', 'tertiary_button_url'];
        
        foreach ($urlFields as $field) {
            $url = $request->input($field);
            
            if (!empty($url)) {
                // Allow hash fragments like #circuits, #devis, etc.
                if (str_starts_with($url, '#')) {
                    continue; // Hash fragments are always valid
                }
                
                // For full URLs, validate them
                if (!filter_var($url, FILTER_VALIDATE_URL)) {
                    throw new \Illuminate\Validation\ValidationException(
                        validator([], []),
                        [$field => ['The ' . str_replace('_', ' ', $field) . ' must be a valid URL or hash fragment (e.g., #circuits).']]
                    );
                }
            }
        }
    }

    /**
     * Duplicate a hero section
     */
    public function duplicate(Hero $hero)
    {
        $newHero = $hero->replicate();
        $newHero->title = $hero->title . ' (Copy)';
        $newHero->is_active = false; // Set duplicate as inactive by default
        $newHero->created_at = now();
        $newHero->updated_at = now();
        $newHero->save();

        // Copy the background image if it exists
        if ($hero->background_image) {
            $extension = pathinfo($hero->background_image, PATHINFO_EXTENSION);
            $newFilename = 'heroes/' . uniqid() . '_' . time() . '.' . $extension;
            
            if (Storage::disk('public')->exists($hero->background_image)) {
                Storage::disk('public')->copy($hero->background_image, $newFilename);
                $newHero->background_image = $newFilename;
                $newHero->save();
            }
        }

        return redirect()->route('admin.heroes.index')->with('success', 'Hero section duplicated successfully. You can now edit the copy.');
    }
}
