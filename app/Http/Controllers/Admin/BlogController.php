<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $nextSortOrder = (Blog::max('sort_order') ?? 0) + 1;
        return view('admin.blogs.create', compact('nextSortOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        // Auto-increment sort_order if not provided
        $sortOrder = $request->get('sort_order');
        if ($sortOrder === null || $sortOrder === '') {
            $maxSortOrder = Blog::max('sort_order') ?? 0;
            $sortOrder = $maxSortOrder + 1;
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'meta_description' => $request->meta_description,
            'is_published' => $request->is_published ?? false,
            'sort_order' => (int)$sortOrder,
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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'remove_featured_image' => 'nullable|boolean',
                'excerpt' => 'nullable|string',
                'content' => 'required',
                'meta_description' => 'nullable|string|max:255',
                'is_published' => 'boolean',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'excerpt' => $validated['excerpt'] ?? null,
                'content' => $validated['content'],
                'meta_description' => $validated['meta_description'] ?? null,
                'is_published' => $request->boolean('is_published'),
                'sort_order' => $validated['sort_order'] ?? $blog->sort_order ?? 0,
            ];

            // Handle featured image removal (only if no new file is being uploaded)
            if ($request->boolean('remove_featured_image') && !$request->hasFile('featured_image')) {
                if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                $data['featured_image'] = null;
            }

            // Handle featured image upload (takes precedence over removal)
            if ($request->hasFile('featured_image')) {
                $file = $request->file('featured_image');
                
                // Log file info for debugging
                \Log::info('Blog image upload attempt', [
                    'blog_id' => $blog->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_mime' => $file->getMimeType(),
                    'is_valid' => $file->isValid(),
                    'error' => $file->getError()
                ]);
                
                // Validate file is valid
                if ($file->isValid()) {
                    // Delete old image if exists
                    if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                        Storage::disk('public')->delete($blog->featured_image);
                    }
                    // Store new image
                    $data['featured_image'] = $file->store('blog_images', 'public');
                    
                    \Log::info('Blog image uploaded successfully', [
                        'blog_id' => $blog->id,
                        'stored_path' => $data['featured_image']
                    ]);
                } else {
                    $errorMessage = 'The uploaded file is not valid.';
                    if ($file->getError() === UPLOAD_ERR_INI_SIZE || $file->getError() === UPLOAD_ERR_FORM_SIZE) {
                        $errorMessage = 'The file size exceeds the maximum allowed size (2MB).';
                    } elseif ($file->getError() === UPLOAD_ERR_PARTIAL) {
                        $errorMessage = 'The file was only partially uploaded.';
                    } elseif ($file->getError() === UPLOAD_ERR_NO_FILE) {
                        $errorMessage = 'No file was uploaded.';
                    }
                    
                    return redirect()->back()
                        ->withErrors(['featured_image' => $errorMessage])
                        ->withInput();
                }
            } else {
                // Log if file is expected but not present
                if ($request->has('featured_image')) {
                    \Log::warning('Blog image upload: hasFile returned false', [
                        'blog_id' => $blog->id,
                        'request_has_featured_image' => $request->has('featured_image')
                    ]);
                }
            }

            $blog->update($data);

            return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Blog update error: ' . $e->getMessage(), [
                'blog_id' => $blog->id,
                'error' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withErrors(['error' => 'An error occurred while updating the blog post. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete featured image if exists
        if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
            Storage::disk('public')->delete($blog->featured_image);
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
            
            if (Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->copy($blog->featured_image, $newFilename);
                $newBlog->featured_image = $newFilename;
                $newBlog->save();
            }
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog duplicated successfully. You can now edit the copy.');
    }
}