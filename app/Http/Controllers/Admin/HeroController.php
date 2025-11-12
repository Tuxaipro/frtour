<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        
        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('heroes', 'public');
        }

        // Handle background video upload
        if ($request->hasFile('background_video')) {
            $data['background_video'] = $request->file('background_video')->store('heroes/videos', 'public');
        }

        // Handle video poster upload
        if ($request->hasFile('video_poster')) {
            $data['video_poster'] = $request->file('video_poster')->store('heroes', 'public');
        }

        // Set boolean fields
        $data['is_active'] = $request->has('is_active');
        $data['show_title'] = $request->input('show_title') == '1';
        $data['video_autoplay'] = $request->has('video_autoplay');
        $data['video_loop'] = $request->has('video_loop');
        $data['video_muted'] = $request->has('video_muted');
        $data['carousel_autoplay'] = $request->has('carousel_autoplay');
        $data['carousel_pause_on_hover'] = $request->has('carousel_pause_on_hover');

        // Set defaults for new fields
        $data['layout_type'] = $data['layout_type'] ?? 'full-width';
        $data['content_alignment'] = $data['content_alignment'] ?? 'center';
        $data['overlay_color'] = $data['overlay_color'] ?? '#000000';
        $data['overlay_opacity'] = $data['overlay_opacity'] ?? 0.50;
        $data['animation_type'] = $data['animation_type'] ?? 'fade';
        $data['animation_duration'] = $data['animation_duration'] ?? 500;
        $data['carousel_interval'] = $data['carousel_interval'] ?? 5000;

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
            'description' => 'nullable|string|max:1000',
            'primary_button_text' => 'nullable|string|max:100',
            'primary_button_url' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:100',
            'secondary_button_url' => 'nullable|string|max:255',
            'tertiary_button_text' => 'nullable|string|max:100',
            'tertiary_button_url' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'badge_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            // Layout & Design
            'layout_type' => 'nullable|in:full-width,split,minimal,video,carousel',
            'content_alignment' => 'nullable|in:left,center,right',
            'overlay_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'overlay_opacity' => 'nullable|numeric|min:0|max:1',
            // Media
            'background_video' => 'nullable|mimes:mp4,webm,ogg|max:10240',
            'video_poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_autoplay' => 'boolean',
            'video_loop' => 'boolean',
            'video_muted' => 'boolean',
            // Animation
            'animation_type' => 'nullable|in:none,fade,slide,zoom',
            'animation_duration' => 'nullable|integer|min:100|max:3000',
            // Carousel Settings
            'carousel_autoplay' => 'boolean',
            'carousel_interval' => 'nullable|integer|min:1000|max:30000',
            'carousel_pause_on_hover' => 'boolean',
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            // Advanced
            'custom_css' => 'nullable|string|max:5000',
            'custom_js' => 'nullable|string|max:5000',
        ], [], [
            'primary_button_url' => 'Primary Button URL',
            'secondary_button_url' => 'Secondary Button URL',
            'tertiary_button_url' => 'Tertiary Button URL',
        ]);

        // Custom URL validation that allows #circuits and other hash fragments
        $this->validateUrls($request);

        // Get the remove flag BEFORE excluding fields
        $removeImage = $request->input('remove_background_image');
        $removeImage = ($removeImage === '1' || $removeImage === 1 || $removeImage === true || $removeImage === 'true');

        // Log for debugging
        \Log::info('Hero update - remove_background_image flag:', [
            'raw_value' => $request->input('remove_background_image'),
            'processed_value' => $removeImage,
            'has_file' => $request->hasFile('background_image'),
            'current_image' => $hero->background_image
        ]);
        
        $data = $request->except(['remove_background_image', 'remove_background_video', 'remove_video_poster', 'background_image', 'background_video', 'video_poster']);

        // Handle background image removal - check this FIRST before file upload
        if ($removeImage) {
            // Delete the file from storage if it exists
            if ($hero->background_image) {
                try {
            Storage::disk('public')->delete($hero->background_image);
                    \Log::info('Deleted hero background image from storage:', ['path' => $hero->background_image]);
                } catch (\Exception $e) {
                    // Log error but continue with database update
                    \Log::warning('Failed to delete hero background image: ' . $e->getMessage());
                }
            }
            // Explicitly set to null to remove from database
            $data['background_image'] = null;
            \Log::info('Setting background_image to null in update data');
        } elseif ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($hero->background_image) {
                try {
                Storage::disk('public')->delete($hero->background_image);
                } catch (\Exception $e) {
                    \Log::warning('Failed to delete old hero background image: ' . $e->getMessage());
                }
            }
            $data['background_image'] = $request->file('background_image')->store('heroes', 'public');
        } else {
            // Preserve existing background image if not being changed
            $data['background_image'] = $hero->background_image;
        }

        // Handle background video removal
        $removeVideo = $request->input('remove_background_video') === '1' || $request->input('remove_background_video') === 1;
        
        if ($removeVideo && $hero->background_video) {
            Storage::disk('public')->delete($hero->background_video);
            $data['background_video'] = null;
        } elseif ($request->hasFile('background_video')) {
            // Delete old video if exists
            if ($hero->background_video) {
                Storage::disk('public')->delete($hero->background_video);
            }
            $data['background_video'] = $request->file('background_video')->store('heroes/videos', 'public');
        } else {
            // Preserve existing background video if not being changed
            $data['background_video'] = $hero->background_video;
        }

        // Handle video poster removal
        $removePoster = $request->input('remove_video_poster') === '1' || $request->input('remove_video_poster') === 1;
        
        if ($removePoster && $hero->video_poster) {
            Storage::disk('public')->delete($hero->video_poster);
            $data['video_poster'] = null;
        } elseif ($request->hasFile('video_poster')) {
            // Delete old poster if exists
            if ($hero->video_poster) {
                Storage::disk('public')->delete($hero->video_poster);
            }
            $data['video_poster'] = $request->file('video_poster')->store('heroes', 'public');
        } else {
            // Preserve existing video poster if not being changed
            $data['video_poster'] = $hero->video_poster;
        }

        // Set boolean fields
        $data['is_active'] = $request->has('is_active');
        $data['show_title'] = $request->input('show_title') == '1';
        $data['video_autoplay'] = $request->has('video_autoplay');
        $data['video_loop'] = $request->has('video_loop');
        $data['video_muted'] = $request->has('video_muted');
        $data['carousel_autoplay'] = $request->has('carousel_autoplay');
        $data['carousel_pause_on_hover'] = $request->has('carousel_pause_on_hover');

        // Log data before update
        \Log::info('Hero update data:', ['background_image' => $data['background_image'] ?? 'not set']);
        
        // Use fill and save to ensure null values are properly handled
        $hero->fill($data);
        $hero->save();
        
        // Double-check: if remove flag was set, explicitly set to null using DB
        if ($removeImage) {
            DB::table('heroes')
                ->where('id', $hero->id)
                ->update(['background_image' => null]);
            \Log::info('Explicitly set background_image to NULL in database');
        }
        
        // Refresh the model to ensure we have the latest data
        $hero->refresh();
        
        \Log::info('Hero after update:', ['background_image' => $hero->background_image]);

        return redirect()->route('admin.heroes.edit', $hero)->with('success', 'Hero section updated successfully.');
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
