@extends('layouts.admin')

@section('title', 'Edit Blog Post')
@section('subtitle', 'Update blog post information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Blog Post</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">Update blog post information</p>
                </div>
                <a href="{{ route('admin.blogs.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-xl shadow-md mb-6" role="alert">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <strong class="font-bold">There were some problems with your input:</strong>
                    </div>
                    <ul class="mt-2 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" required>
                        @error('title')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="featured_image" class="block text-sm font-semibold text-slate-700 mb-2">Featured Image</label>
                        
                        @if($blog->featured_image)
                            <div id="current-image" class="mb-4">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-xl border-2 border-slate-200">
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0" id="preview-current">
                                    <div class="flex-1 flex flex-col justify-between min-h-[96px]">
                                        <div>
                                            <p class="text-sm font-medium text-slate-700">Current Image</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ basename($blog->featured_image) }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2 mt-auto">
                                            <a href="{{ asset('storage/' . $blog->featured_image) }}" target="_blank" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <button type="button" onclick="clearCurrentImage()" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="relative">
                            <input type="file" name="featured_image" id="featured_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(this)" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark file:cursor-pointer cursor-pointer border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('featured_image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        </div>
                        <input type="hidden" name="remove_featured_image" id="remove-featured-image" value="0">
                        <p class="text-slate-500 text-xs mt-2 px-1">Upload a new featured image or leave empty to keep the current one (max 2MB)</p>
                        @error('featured_image')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        
                        <!-- New image preview -->
                        <div id="new-image-preview" class="mt-4 hidden">
                            <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-xl border-2 border-slate-200">
                                <img id="preview-new" src="" alt="New image" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-700">New Image Preview</p>
                                    <p class="text-xs text-slate-500 mt-1" id="filename"></p>
                                    <div class="mt-3">
                                        <button type="button" onclick="clearNewImage()" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-2">Excerpt (Short Description)</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('excerpt') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Brief description of the blog post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        <p class="text-slate-500 text-xs mt-2 px-1">A short preview of the blog post (optional)</p>
                        @error('excerpt')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Content <span class="text-red-500">*</span></label>
                        <div class="border-2 border-slate-200 rounded-xl overflow-hidden @error('content') border-red-300 @enderror">
                            <div id="content" style="min-height: 400px;">{!! old('content', $blog->content) !!}</div>
                        </div>
                        <textarea name="content" id="content-textarea" style="display: none;">{{ old('content', $blog->content) }}</textarea>
                        <p class="text-slate-500 text-xs mt-2 px-1">Main blog content - Use the rich text editor toolbar to format your content</p>
                        @error('content')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Display Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('sort_order', $blog->sort_order ?? 0) }}" min="0">
                        <p class="text-slate-500 text-xs mt-2 px-1">Lower numbers appear first</p>
                        @error('sort_order')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('meta_description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center space-x-3 cursor-pointer pt-8">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                            <span class="text-sm font-semibold text-slate-700">Published</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.blogs.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Blog Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quill Rich Text Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
// Initialize Quill Editor
document.addEventListener('DOMContentLoaded', function() {
    const quill = new Quill('#content', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['blockquote', 'code-block'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your blog post...',
    });
    
    // Get the textarea element
    const textarea = document.querySelector('textarea[name="content"]');
    
    // Update textarea on text change
    quill.on('text-change', function() {
        textarea.value = quill.root.innerHTML;
    });
    
    // Set initial content if exists
    if (textarea.value) {
        quill.root.innerHTML = textarea.value;
    }
    
    // Update textarea before form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            textarea.value = quill.root.innerHTML;
        });
    }
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-new').src = e.target.result;
            document.getElementById('filename').textContent = input.files[0].name;
            document.getElementById('new-image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function clearNewImage() {
    document.getElementById('featured_image').value = '';
    document.getElementById('new-image-preview').classList.add('hidden');
}

function clearCurrentImage() {
    document.getElementById('remove-featured-image').value = '1';
    const currentImageDiv = document.getElementById('current-image');
    if (currentImageDiv) {
        currentImageDiv.style.opacity = '0.5';
        currentImageDiv.style.pointerEvents = 'none';
    }
    // Clear any new image selection if user had selected one
    const fileInput = document.getElementById('featured_image');
    if (fileInput && fileInput.files.length > 0) {
        fileInput.value = '';
        const newPreview = document.getElementById('new-image-preview');
        if (newPreview) {
            newPreview.classList.add('hidden');
        }
    }
}
</script>
@endsection
