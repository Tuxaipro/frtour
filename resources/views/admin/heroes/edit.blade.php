@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('subtitle', 'Update the hero section details')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">Edit Hero Section</h1>
                        <p class="text-sm text-gray-600 mt-1">Update the hero section details</p>
                    </div>
                    <a href="{{ route('admin.heroes.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Hero Sections
                    </a>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.heroes.update', $hero) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $hero->title) }}" required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $hero->subtitle) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="3" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $hero->description) }}</textarea>
                            </div>
                            
                            <div>
                                <label for="badge_text" class="block text-sm font-medium text-gray-700 mb-2">Badge Text</label>
                                <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $hero->sort_order) }}" min="0" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Call-to-Action Buttons</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="primary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Primary Button Text</label>
                                <input type="text" name="primary_button_text" id="primary_button_text" value="{{ old('primary_button_text', $hero->primary_button_text) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="primary_button_url" class="block text-sm font-medium text-gray-700 mb-2">Primary Button URL</label>
                                <input type="text" name="primary_button_url" id="primary_button_url" value="{{ old('primary_button_url', $hero->primary_button_url) }}" 
                                       placeholder="https://example.com or #circuits" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            </div>
                            <div></div>
                            
                            <div>
                                <label for="secondary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text</label>
                                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text', $hero->secondary_button_text) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="secondary_button_url" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button URL</label>
                                <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url', $hero->secondary_button_url) }}" 
                                       placeholder="https://example.com or #circuits" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            </div>
                            <div></div>
                            
                            <div>
                                <label for="tertiary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Tertiary Button Text</label>
                                <input type="text" name="tertiary_button_text" id="tertiary_button_text" value="{{ old('tertiary_button_text', $hero->tertiary_button_text) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="tertiary_button_url" class="block text-sm font-medium text-gray-700 mb-2">Tertiary Button URL</label>
                                <input type="text" name="tertiary_button_url" id="tertiary_button_url" value="{{ old('tertiary_button_url', $hero->tertiary_button_url) }}" 
                                       placeholder="https://example.com or #circuits" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            </div>
                            <div></div>
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Background Image</h3>
                        
                        <!-- Hidden input for remove flag - always present -->
                        <input type="hidden" name="remove_background_image" id="remove-background-image" value="0">
                        
                        <!-- Current Image Display -->
                        @if($hero->background_image)
                            <div id="current-image" class="mb-4">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <img src="{{ asset('storage/' . $hero->background_image) }}" alt="{{ $hero->title }}" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0" id="preview-current">
                                    <div class="flex-1 flex flex-col justify-between min-h-[96px]">
                                        <div>
                                            <p class="text-sm font-medium text-slate-700">Current Image</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ basename($hero->background_image) }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2 mt-auto">
                                            <a href="{{ asset('storage/' . $hero->background_image) }}" target="_blank" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded hover:bg-blue-100 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <button type="button" onclick="clearCurrentImage()" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Message when image is removed -->
                            <div id="image-removed-message" class="mb-4 hidden p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-sm text-yellow-800">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    The current image will be removed when you save.
                                </p>
                            </div>
                        @endif
                        
                        <!-- New Image Preview -->
                        <div id="new-image-preview" class="mb-4 hidden">
                            <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <img id="preview-new" src="" alt="New background image" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-700">New Image Preview</p>
                                    <p class="text-xs text-slate-500 mt-1" id="filename"></p>
                                    <div class="mt-3">
                                        <button type="button" onclick="clearNewImage()" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="background_image" class="block text-sm font-medium text-gray-700 mb-2">
                                @if($hero->background_image)
                                    Replace Background Image
                                @else
                                    Background Image
                                @endif
                            </label>
                            <input type="file" name="background_image" id="background_image" accept="image/*" onchange="previewImage(this)" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">Upload an image for the hero background. Recommended size: 1920x1080px. Max file size: 2MB</p>
                            @error('background_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                        
                    <!-- Layout & Design -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Layout & Design</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="layout_type" class="block text-sm font-medium text-gray-700 mb-2">Layout Type</label>
                                <select name="layout_type" id="layout_type" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="full-width" {{ old('layout_type', $hero->layout_type ?? 'full-width') === 'full-width' ? 'selected' : '' }}>Full Width</option>
                                    <option value="split" {{ old('layout_type', $hero->layout_type ?? 'full-width') === 'split' ? 'selected' : '' }}>Split (50/50)</option>
                                    <option value="minimal" {{ old('layout_type', $hero->layout_type ?? 'full-width') === 'minimal' ? 'selected' : '' }}>Minimal</option>
                                    <option value="video" {{ old('layout_type', $hero->layout_type ?? 'full-width') === 'video' ? 'selected' : '' }}>Video Background</option>
                                    <option value="carousel" {{ old('layout_type', $hero->layout_type ?? 'full-width') === 'carousel' ? 'selected' : '' }}>Carousel/Slider</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="content_alignment" class="block text-sm font-medium text-gray-700 mb-2">Content Alignment</label>
                                <select name="content_alignment" id="content_alignment" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="left" {{ old('content_alignment', $hero->content_alignment ?? 'center') === 'left' ? 'selected' : '' }}>Left</option>
                                    <option value="center" {{ old('content_alignment', $hero->content_alignment ?? 'center') === 'center' ? 'selected' : '' }}>Center</option>
                                    <option value="right" {{ old('content_alignment', $hero->content_alignment ?? 'center') === 'right' ? 'selected' : '' }}>Right</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="overlay_color" class="block text-sm font-medium text-gray-700 mb-2">Overlay Color</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" name="overlay_color" id="overlay_color" value="{{ old('overlay_color', $hero->overlay_color ?? '#000000') }}" 
                                           class="w-16 h-10 border border-gray-300 rounded cursor-pointer">
                                    <input type="text" name="overlay_color_text" id="overlay_color_text" value="{{ old('overlay_color', $hero->overlay_color ?? '#000000') }}" 
                                           pattern="^#[0-9A-Fa-f]{6}$"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="overlay_opacity" class="block text-sm font-medium text-gray-700 mb-2">Overlay Opacity: <span id="opacity_value">{{ old('overlay_opacity', $hero->overlay_opacity ?? 0.50) }}</span></label>
                                <input type="range" name="overlay_opacity" id="overlay_opacity" min="0" max="1" step="0.05" value="{{ old('overlay_opacity', $hero->overlay_opacity ?? 0.50) }}" 
                                       oninput="document.getElementById('opacity_value').textContent = this.value"
                                       class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Video Settings -->
                    <div class="bg-gray-50 p-6 rounded-lg" id="video-settings" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Video Background</h3>
                        
                        @if($hero->background_video)
                            <div class="mb-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-sm font-medium text-slate-700 mb-2">Current Video</p>
                                <p class="text-xs text-slate-500 mb-3">{{ basename($hero->background_video) }}</p>
                                <button type="button" onclick="document.getElementById('remove-background-video').value = '1'; this.parentElement.style.display = 'none';" 
                                        class="text-xs text-red-700 bg-red-50 border border-red-200 rounded px-2 py-1 hover:bg-red-100">
                                    Remove Video
                                </button>
                            </div>
                            <input type="hidden" name="remove_background_video" id="remove-background-video" value="0">
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="background_video" class="block text-sm font-medium text-gray-700 mb-2">Background Video</label>
                                <input type="file" name="background_video" id="background_video" accept="video/*" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Upload MP4, WebM, or OGG video. Max: 10MB</p>
                            </div>
                            
                            <div>
                                <label for="video_poster" class="block text-sm font-medium text-gray-700 mb-2">Video Poster Image</label>
                                <input type="file" name="video_poster" id="video_poster" accept="image/*" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Thumbnail shown before video loads</p>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="hidden" name="video_autoplay" value="0">
                                <input type="checkbox" name="video_autoplay" id="video_autoplay" value="1" {{ old('video_autoplay', $hero->video_autoplay ?? true) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="video_autoplay" class="ml-2 block text-sm text-gray-900">Autoplay video</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="hidden" name="video_loop" value="0">
                                <input type="checkbox" name="video_loop" id="video_loop" value="1" {{ old('video_loop', $hero->video_loop ?? true) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="video_loop" class="ml-2 block text-sm text-gray-900">Loop video</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="hidden" name="video_muted" value="0">
                                <input type="checkbox" name="video_muted" id="video_muted" value="1" {{ old('video_muted', $hero->video_muted ?? true) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="video_muted" class="ml-2 block text-sm text-gray-900">Muted (required for autoplay)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Animation Settings -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Animation</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="animation_type" class="block text-sm font-medium text-gray-700 mb-2">Animation Type</label>
                                <select name="animation_type" id="animation_type" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="none" {{ old('animation_type', $hero->animation_type ?? 'fade') === 'none' ? 'selected' : '' }}>None</option>
                                    <option value="fade" {{ old('animation_type', $hero->animation_type ?? 'fade') === 'fade' ? 'selected' : '' }}>Fade</option>
                                    <option value="slide" {{ old('animation_type', $hero->animation_type ?? 'fade') === 'slide' ? 'selected' : '' }}>Slide</option>
                                    <option value="zoom" {{ old('animation_type', $hero->animation_type ?? 'fade') === 'zoom' ? 'selected' : '' }}>Zoom</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="animation_duration" class="block text-sm font-medium text-gray-700 mb-2">Animation Duration (ms)</label>
                                <input type="number" name="animation_duration" id="animation_duration" value="{{ old('animation_duration', $hero->animation_duration ?? 500) }}" min="100" max="3000" step="100" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Duration in milliseconds (100-3000)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Settings -->
                    <div class="bg-gray-50 p-6 rounded-lg" id="carousel-settings" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Carousel Settings</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center">
                                <input type="hidden" name="carousel_autoplay" value="0">
                                <input type="checkbox" name="carousel_autoplay" id="carousel_autoplay" value="1" {{ old('carousel_autoplay', $hero->carousel_autoplay ?? true) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="carousel_autoplay" class="ml-2 block text-sm text-gray-900">Auto-play carousel</label>
                            </div>
                            
                            <div>
                                <label for="carousel_interval" class="block text-sm font-medium text-gray-700 mb-2">Auto-play Interval (ms)</label>
                                <input type="number" name="carousel_interval" id="carousel_interval" value="{{ old('carousel_interval', $hero->carousel_interval ?? 5000) }}" min="1000" max="30000" step="500" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Time between slides (1000-30000ms)</p>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="hidden" name="carousel_pause_on_hover" value="0">
                                <input type="checkbox" name="carousel_pause_on_hover" id="carousel_pause_on_hover" value="1" {{ old('carousel_pause_on_hover', $hero->carousel_pause_on_hover ?? true) ? 'checked' : '' }} 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="carousel_pause_on_hover" class="ml-2 block text-sm text-gray-900">Pause on hover</label>
                            </div>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings</h3>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $hero->is_active) ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Active (display this hero section on the homepage)
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.heroes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Hero Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size exceeds 2MB. Please choose a smaller file.');
            input.value = '';
            return;
        }
        
        // Validate file type
        if (!file.type.match('image.*')) {
            alert('Please select a valid image file.');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            // Show new image preview
            const newImagePreview = document.getElementById('new-image-preview');
            if (newImagePreview) {
                newImagePreview.classList.remove('hidden');
            }
            
            const previewNew = document.getElementById('preview-new');
            if (previewNew) {
                previewNew.src = e.target.result;
            }
            
            const filename = document.getElementById('filename');
            if (filename) {
                filename.textContent = file.name;
            }
            
            // If a new image is selected, reset the remove flag
            const removeInput = document.getElementById('remove-background-image');
            if (removeInput) {
                removeInput.value = '0';
                removeInput.setAttribute('value', '0');
            }
            
            // Hide removal message if showing
            const removedMessage = document.getElementById('image-removed-message');
            if (removedMessage) {
                removedMessage.style.display = 'none';
                removedMessage.classList.add('hidden');
            }
            
            // Show current image again if it was hidden
            const currentImageDiv = document.getElementById('current-image');
            if (currentImageDiv) {
                currentImageDiv.style.display = 'block';
                currentImageDiv.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    }
}

function clearNewImage() {
    // Hide new image preview
    const newImagePreview = document.getElementById('new-image-preview');
    if (newImagePreview) {
        newImagePreview.classList.add('hidden');
    }
    
    // Clear file input
    const fileInput = document.getElementById('background_image');
    if (fileInput) {
        fileInput.value = '';
    }
    
    // Clear preview image
    const previewNew = document.getElementById('preview-new');
    if (previewNew) {
        previewNew.src = '';
    }
    
    const filename = document.getElementById('filename');
    if (filename) {
        filename.textContent = '';
    }
    
    // DO NOT reset remove flag here - it should only be reset when a new image is actually selected
    // The remove flag should persist if the user intentionally marked the image for removal
}

function clearCurrentImage() {
    if (confirm('Are you sure you want to remove this image? The image will be deleted when you save the changes.')) {
        // Set remove flag FIRST before doing anything else
        const removeInput = document.getElementById('remove-background-image');
        if (removeInput) {
            removeInput.value = '1';
            removeInput.setAttribute('value', '1');
            // Also set it as a data attribute for extra safety
            removeInput.setAttribute('data-remove', '1');
            console.log('Remove flag set to:', removeInput.value);
            console.log('Remove input element:', removeInput);
        } else {
            console.error('Remove input not found!');
            return; // Don't continue if we can't set the flag
        }
        
        // Hide current image
        const currentImageDiv = document.getElementById('current-image');
        if (currentImageDiv) {
            currentImageDiv.style.display = 'none';
            currentImageDiv.classList.add('hidden');
            // Add a data attribute to mark it as removed
            currentImageDiv.setAttribute('data-removed', 'true');
        }
        
        // Show removal message
        const removedMessage = document.getElementById('image-removed-message');
        if (removedMessage) {
            removedMessage.style.display = 'block';
            removedMessage.classList.remove('hidden');
        }
        
        // Clear any new image preview if it exists
        clearNewImage();
        
        // Also clear any file input
        const fileInput = document.getElementById('background_image');
        if (fileInput) {
            fileInput.value = '';
        }
        
        // Verify the flag is still set after a short delay
        setTimeout(() => {
            const verifyInput = document.getElementById('remove-background-image');
            if (verifyInput && verifyInput.value !== '1') {
                console.error('WARNING: Remove flag was reset! Setting it again...');
                verifyInput.value = '1';
                verifyInput.setAttribute('value', '1');
            }
        }, 100);
    }
}

// Ensure remove flag is submitted with form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="heroes"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            const removeInput = document.getElementById('remove-background-image');
            if (removeInput) {
                // Check if the current image is hidden (meaning user wants to remove it)
                const currentImageDiv = document.getElementById('current-image');
                const isImageHidden = currentImageDiv && (
                    currentImageDiv.classList.contains('hidden') || 
                    currentImageDiv.style.display === 'none'
                );
                
                // If image is hidden, ensure remove flag is set to 1
                if (isImageHidden && removeInput.value !== '1') {
                    console.log('Image is hidden but flag is not set. Setting remove flag to 1');
                    removeInput.value = '1';
                    removeInput.setAttribute('value', '1');
                }
                
                // Log the final value being submitted
                console.log('Form submitting with remove_background_image =', removeInput.value);
                console.log('Remove input element:', removeInput);
                console.log('Remove input value attribute:', removeInput.getAttribute('value'));
            }
        });
    }
});

// Toggle video settings based on layout type
document.getElementById('layout_type').addEventListener('change', function() {
    const videoSettings = document.getElementById('video-settings');
    const carouselSettings = document.getElementById('carousel-settings');
    
    if (this.value === 'video') {
        videoSettings.style.display = 'block';
        carouselSettings.style.display = 'none';
    } else if (this.value === 'carousel') {
        videoSettings.style.display = 'none';
        carouselSettings.style.display = 'block';
    } else {
        videoSettings.style.display = 'none';
        carouselSettings.style.display = 'none';
    }
});

// Sync color picker with text input
document.getElementById('overlay_color').addEventListener('change', function() {
    document.getElementById('overlay_color_text').value = this.value;
});

document.getElementById('overlay_color_text').addEventListener('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
        document.getElementById('overlay_color').value = this.value;
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('layout_type').dispatchEvent(new Event('change'));
});
</script>
@endsection
