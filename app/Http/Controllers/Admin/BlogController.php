<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

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
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'meta_description' => $request->meta_description,
            'is_published' => $request->is_published ?? false,
        ];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog = Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_featured_image' => 'nullable|boolean',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'meta_description' => $request->meta_description,
            'is_published' => $request->is_published ?? false,
        ];

        // Handle featured image removal
        if ($request->boolean('remove_featured_image')) {
            if ($blog->featured_image && \Storage::disk('public')->exists($blog->featured_image)) {
                \Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = null;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image && \Storage::disk('public')->exists($blog->featured_image)) {
                \Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete featured image if exists
        if ($blog->featured_image) {
            \Storage::disk('public')->delete($blog->featured_image);
        }
        
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Duplicate a blog
     */
    public function duplicate(Blog $blog)
    {
        $newBlog = $blog->replicate();
        $newBlog->title = $blog->title . ' (Copy)';
        $newBlog->slug = $blog->slug . '-copy';
        $newBlog->is_published = false; // Set duplicate as draft by default
        $newBlog->created_at = now();
        $newBlog->updated_at = now();
        $newBlog->save();

        // Copy the featured image if it exists
        if ($blog->featured_image) {
            $extension = pathinfo($blog->featured_image, PATHINFO_EXTENSION);
            $newFilename = 'blog_images/' . uniqid() . '_' . time() . '.' . $extension;
            
            if (\Storage::disk('public')->exists($blog->featured_image)) {
                \Storage::disk('public')->copy($blog->featured_image, $newFilename);
                $newBlog->featured_image = $newFilename;
                $newBlog->save();
            }
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog duplicated successfully. You can now edit the copy.');
    }
}