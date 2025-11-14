@extends('layouts.admin')

@section('title', 'Edit Destination')
@section('subtitle', 'Update destination information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Destination</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">Update destination information</p>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
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

                <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" id="destination-edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('name', $destination->name) }}" required placeholder="Enter destination name">
                            @error('name')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="slug" class="block text-sm font-semibold text-slate-700 mb-2">Slug <span class="text-red-500">*</span></label>
                            <input type="text" name="slug" id="slug" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('slug') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('slug', $destination->slug) }}" required placeholder="auto-generated-from-name">
                            @error('slug')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('sort_order', $destination->sort_order ?? 0) }}" min="0">
                            <p class="text-slate-500 text-xs mt-2 px-1">Lower numbers appear first. Default is 0.</p>
                            @error('sort_order')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                            <textarea name="description" id="description" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="4">{{ old('description', $destination->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="cover_image" class="block text-sm font-semibold text-slate-700 mb-2">Cover Image</label>
                            @if($destination->cover_image)
                                <div id="current-image-container" class="mb-3">
                                    <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-xl border-2 border-slate-200">
                                        <img src="{{ asset('storage/' . $destination->cover_image) }}" 
                                             alt="Current cover image" 
                                             id="current-cover-image"
                                             class="w-32 h-24 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0">
                                        <div class="flex-1 flex flex-col justify-between min-h-[96px]">
                                            <div>
                                                <p class="text-sm font-medium text-slate-700">Current Cover Image</p>
                                                <p class="text-xs text-slate-500 mt-1">{{ basename($destination->cover_image) }}</p>
                                            </div>
                                            <div class="flex items-center space-x-2 mt-auto">
                                                <a href="{{ asset('storage/' . $destination->cover_image) }}" 
                                                   target="_blank" 
                                                   class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    View Full Size
                                                </a>
                                                <label class="flex items-center space-x-2 cursor-pointer">
                                                    <input type="checkbox" 
                                                           name="remove_cover_image" 
                                                           id="remove_cover_image" 
                                                           value="1" 
                                                           class="w-4 h-4 text-red-600 border-slate-300 rounded focus:ring-red-500">
                                                    <span class="text-xs font-medium text-red-600">Remove</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="relative">
                                <input type="file" name="cover_image" id="cover_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark file:cursor-pointer cursor-pointer border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('cover_image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            </div>
                            <p class="text-slate-500 text-xs mt-2 px-1">Recommended size: 1920x1080px. Max file size: 2MB. Formats: JPEG, PNG, GIF, WebP.</p>
                            @error('cover_image')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <div id="cover_image_preview" class="mt-4 hidden">
                                <img id="cover_image_preview_img" src="" alt="Cover image preview" class="max-w-full h-auto rounded-xl border-2 border-slate-200 max-h-64">
                            </div>
                        </div>
                        
                        <div>
                            <label for="hero_title" class="block text-sm font-semibold text-slate-700 mb-2">Hero Title</label>
                            <input type="text" name="hero_title" id="hero_title" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('hero_title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('hero_title', $destination->hero_title) }}">
                            @error('hero_title')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="meta_title" class="block text-sm font-semibold text-slate-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('meta_title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('meta_title', $destination->meta_title) }}">
                            @error('meta_title')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="hero_description" class="block text-sm font-semibold text-slate-700 mb-2">Hero Description</label>
                            <textarea name="hero_description" id="hero_description" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('hero_description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="3">{{ old('hero_description', $destination->hero_description) }}</textarea>
                            @error('hero_description')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="meta_description" class="block text-sm font-semibold text-slate-700 mb-2">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('meta_description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="2">{{ old('meta_description', $destination->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>
                                <span class="text-sm font-semibold text-slate-700">Active</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                        <a href="{{ route('admin.destinations.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Destination
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('destination-edit-form');
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    // Auto-generate slug from name (only if slug is empty)
    nameInput.addEventListener('input', function() {
        if (!slugInput.value.trim()) {
            const name = this.value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single
                .trim();
            slugInput.value = slug;
        }
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        // Basic validation
        const name = nameInput.value.trim();
        const slug = slugInput.value.trim();
        
        if (!name) {
            e.preventDefault();
            alert('Name is required');
            return false;
        }
        
        if (!slug) {
            e.preventDefault();
            alert('Slug is required');
            return false;
        }
        
        // Allow form to submit normally
        return true;
    });
    
    // Cover image preview
    const coverImageInput = document.getElementById('cover_image');
    const coverImagePreview = document.getElementById('cover_image_preview');
    const coverImagePreviewImg = document.getElementById('cover_image_preview_img');
    const removeCoverImageCheckbox = document.getElementById('remove_cover_image');
    
    if (coverImageInput) {
        coverImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverImagePreviewImg.src = e.target.result;
                    coverImagePreview.classList.remove('hidden');
                    if (removeCoverImageCheckbox) {
                        removeCoverImageCheckbox.checked = false;
                    }
                };
                reader.readAsDataURL(file);
            } else {
                coverImagePreview.classList.add('hidden');
            }
        });
    }
    
    if (removeCoverImageCheckbox) {
        const currentImageContainer = document.getElementById('current-image-container');
        removeCoverImageCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Hide current image container
                if (currentImageContainer) {
                    currentImageContainer.style.opacity = '0.5';
                    currentImageContainer.style.pointerEvents = 'none';
                }
                // Clear file input if a new image was selected
                if (coverImageInput) {
                    coverImageInput.value = '';
                    coverImagePreview.classList.add('hidden');
                }
            } else {
                // Show current image container again
                if (currentImageContainer) {
                    currentImageContainer.style.opacity = '1';
                    currentImageContainer.style.pointerEvents = 'auto';
                }
            }
        });
    }
});
</script>
@endsection
