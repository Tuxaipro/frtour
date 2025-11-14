<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
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

        $pages = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextSortOrder = (Page::max('sort_order') ?? 0) + 1;
        return view('admin.pages.create', compact('nextSortOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Auto-increment sort_order if not provided
        $sortOrder = $request->get('sort_order');
        if ($sortOrder === null || $sortOrder === '') {
            $maxSortOrder = Page::max('sort_order') ?? 0;
            $sortOrder = $maxSortOrder + 1;
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_active' => $request->is_active ?? false,
            'sort_order' => (int)$sortOrder,
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('page_images', 'public');
        }

        $page = Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_active' => $request->is_active ?? false,
            'sort_order' => $request->sort_order ?? $page->sort_order ?? 0,
        ];

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($page->featured_image) {
                \Storage::disk('public')->delete($page->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('page_images', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        // Delete featured image if exists
        if ($page->featured_image) {
            \Storage::disk('public')->delete($page->featured_image);
        }
        
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    /**
     * Duplicate a page
     */
    public function duplicate(Page $page)
    {
        $newPage = $page->replicate();
        $newPage->title = $page->title . ' (Copy)';
        $newPage->slug = $page->slug . '-copy';
        $newPage->is_active = false; // Set duplicate as inactive by default
        $newPage->created_at = now();
        $newPage->updated_at = now();
        $newPage->save();

        // Copy the featured image if it exists
        if ($page->featured_image) {
            $extension = pathinfo($page->featured_image, PATHINFO_EXTENSION);
            $newFilename = 'page_images/' . uniqid() . '_' . time() . '.' . $extension;
            
            if (\Storage::disk('public')->exists($page->featured_image)) {
                \Storage::disk('public')->copy($page->featured_image, $newFilename);
                $newPage->featured_image = $newFilename;
                $newPage->save();
            }
        }

        return redirect()->route('admin.pages.index')->with('success', 'Page duplicated successfully. You can now edit the copy.');
    }
}