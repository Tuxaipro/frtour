@extends('layouts.admin')

@section('title', 'Edit Hero Section')
@section('subtitle', 'Update the hero section details')

@section('content')
<div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Hero Section</h1>
                        <p class="text-sm text-slate-600 mt-1.5 font-medium">Update the hero section details</p>
                    </div>
                    <a href="{{ route('admin.heroes.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-xl shadow-md">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold">Please fix the following errors:</p>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.heroes.update', $hero) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Hidden fields for default values --}}
                    <input type="hidden" name="layout_type" value="{{ old('layout_type', $hero->layout_type ?? 'minimal') }}">
                    <input type="hidden" name="content_alignment" value="{{ old('content_alignment', $hero->content_alignment ?? 'center') }}">
                    <input type="hidden" name="overlay_color" value="{{ old('overlay_color', $hero->overlay_color ?? '#000000') }}">
                    <input type="hidden" name="overlay_opacity" value="{{ old('overlay_opacity', $hero->overlay_opacity ?? 0.5) }}">
                    <input type="hidden" name="animation_type" value="{{ old('animation_type', $hero->animation_type ?? 'fade') }}">
                    <input type="hidden" name="animation_duration" value="{{ old('animation_duration', $hero->animation_duration ?? 500) }}">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                    
                    <!-- Basic Information -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Basic Information</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure the hero section details</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <div class="flex items-center justify-between mb-2">
                                    <label for="title" class="block text-sm font-semibold text-slate-700">Title <span class="text-red-500">*</span></label>
                                    <div class="flex items-center space-x-2">
                                        <input type="hidden" name="show_title" value="0">
                                        <input type="checkbox" name="show_title" id="show_title" value="1" {{ old('show_title', $hero->show_title ?? true) ? 'checked' : '' }} 
                                               class="w-4 h-4 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary transition-colors duration-200">
                                        <label for="show_title" class="text-sm font-medium text-slate-700 cursor-pointer">Show Title</label>
                                    </div>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title', $hero->title) }}" required 
                                       class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Enter hero title">
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
                                <label for="subtitle" class="block text-sm font-semibold text-slate-700 mb-2">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $hero->subtitle) }}" 
                                       class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('subtitle') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Enter hero subtitle">
                                @error('subtitle')
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
                                <textarea name="description" id="description" rows="3" 
                                          class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" 
                                          placeholder="Enter a longer description for the hero section">{{ old('description', $hero->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="badge_text" class="block text-sm font-semibold text-slate-700 mb-2">Badge Text</label>
                                <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" 
                                       class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('badge_text') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="e.g., New">
                                @error('badge_text')
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
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $hero->sort_order) }}" min="0" 
                                       class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
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
                        </div>
                    </div>

                    <!-- Media -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Background Image</h2>
                            <p class="text-xs text-slate-500 mt-1">Upload a background image for the hero section</p>
                        </div>
                        
                        <!-- Hidden input for remove flag - always present -->
                        <input type="hidden" name="remove_background_image" id="remove-background-image" value="0">
                        
                        <!-- Current Image Display -->
                        @if($hero->background_image)
                            <div id="current-image" class="mb-4">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-xl border-2 border-slate-200">
                                    <img src="{{ asset('storage/' . $hero->background_image) }}" alt="{{ $hero->title }}" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0" id="preview-current">
                                    <div class="flex-1 flex flex-col justify-between min-h-[96px]">
                                        <div>
                                            <p class="text-sm font-medium text-slate-700">Current Image</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ basename($hero->background_image) }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2 mt-auto">
                                            <a href="{{ asset('storage/' . $hero->background_image) }}" target="_blank" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
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
                            
                            <!-- Message when image is removed -->
                            <div id="image-removed-message" class="mb-4 hidden p-4 bg-yellow-50 border-2 border-yellow-200 rounded-xl">
                                <p class="text-sm text-yellow-800 flex items-center">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    The current image will be removed when you save.
                                </p>
                            </div>
                        @endif
                        
                        <!-- New Image Preview -->
                        <div id="new-image-preview" class="mb-4 hidden">
                            <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl border-2 border-blue-200">
                                <img id="preview-new" src="" alt="New background image" class="w-24 h-16 object-cover rounded-xl border-2 border-blue-200 shadow-sm flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-blue-700">New Image Preview</p>
                                    <p class="text-xs text-blue-600 mt-1" id="filename"></p>
                                    <div class="mt-3">
                                        <button type="button" onclick="clearNewImage()" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 border-2 border-red-200 rounded-xl hover:bg-red-100 transition-all duration-200">
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
                            <label for="background_image" class="block text-sm font-semibold text-slate-700 mb-2">
                                @if($hero->background_image)
                                    Replace Background Image
                                @else
                                    Background Image
                                @endif
                            </label>
                            <input type="file" name="background_image" id="background_image" accept="image/*" onchange="previewImage(this)" 
                                   class="block w-full text-sm text-slate-600 bg-white border-2 border-slate-200 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 @error('background_image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Upload an image for the hero background. Recommended size: 1920x1080px. Max file size: 5MB</p>
                            @error('background_image')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                    <!-- Buttons -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Call-to-Action Buttons</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure the hero section buttons</p>
                        </div>
                        
                        <div class="space-y-6">
                        <div>
                            <label for="primary_button_text" class="block text-sm font-semibold text-slate-700 mb-2">Primary Button Text</label>
                            <input type="text" name="primary_button_text" id="primary_button_text" value="{{ old('primary_button_text', $hero->primary_button_text) }}" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('primary_button_text') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="e.g., Explore">
                            @error('primary_button_text')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="primary_button_url" class="block text-sm font-semibold text-slate-700 mb-2">Primary Button URL</label>
                            <input type="text" name="primary_button_url" id="primary_button_url" value="{{ old('primary_button_url', $hero->primary_button_url) }}" 
                                   placeholder="https://example.com or #circuits" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('primary_button_url') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            @error('primary_button_url')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="secondary_button_text" class="block text-sm font-semibold text-slate-700 mb-2">Secondary Button Text</label>
                            <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text', $hero->secondary_button_text) }}" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('secondary_button_text') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="e.g., Learn More">
                            @error('secondary_button_text')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="secondary_button_url" class="block text-sm font-semibold text-slate-700 mb-2">Secondary Button URL</label>
                            <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url', $hero->secondary_button_url) }}" 
                                   placeholder="https://example.com or #circuits" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('secondary_button_url') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            @error('secondary_button_url')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="tertiary_button_text" class="block text-sm font-semibold text-slate-700 mb-2">Tertiary Button Text</label>
                            <input type="text" name="tertiary_button_text" id="tertiary_button_text" value="{{ old('tertiary_button_text', $hero->tertiary_button_text) }}" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('tertiary_button_text') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="e.g., Contact">
                            @error('tertiary_button_text')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="tertiary_button_url" class="block text-sm font-semibold text-slate-700 mb-2">Tertiary Button URL</label>
                            <input type="text" name="tertiary_button_url" id="tertiary_button_url" value="{{ old('tertiary_button_url', $hero->tertiary_button_url) }}" 
                                   placeholder="https://example.com or #circuits" 
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('tertiary_button_url') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Enter a full URL or hash fragment (e.g., #circuits, #devis)</p>
                            @error('tertiary_button_url')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Settings</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure the hero section visibility</p>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $hero->is_active) ? 'checked' : '' }} 
                                   class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200">
                            <label for="is_active" class="text-sm font-semibold text-slate-700 cursor-pointer">
                                Active (display this hero section on the homepage)
                            </label>
                        </div>
                    </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                        <a href="{{ route('admin.heroes.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
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
        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('File size exceeds 5MB. Please choose a smaller file.');
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
            
            // Hide removal message if showing
            const removedMessage = document.getElementById('image-removed-message');
            if (removedMessage) {
                removedMessage.style.display = 'none';
                removedMessage.classList.add('hidden');
            }
            
            // Check if current image was explicitly removed by user
            const currentImageDiv = document.getElementById('current-image');
            const wasExplicitlyRemoved = currentImageDiv && currentImageDiv.getAttribute('data-removed') === 'true';
            
            // If a new image is selected, handle the remove flag based on whether old image was removed
            const removeInput = document.getElementById('remove-background-image');
            if (removeInput) {
                // If user explicitly removed the old image, keep it marked for removal
                // The new image will replace it
                if (wasExplicitlyRemoved) {
                    removeInput.value = '1';
                    removeInput.setAttribute('value', '1');
                } else {
                    // If old image wasn't removed, just replacing it
                    removeInput.value = '0';
                    removeInput.setAttribute('value', '0');
                }
            }
            
            // IMPORTANT: Do NOT show current image if it was explicitly removed
            // Only show it if the user didn't remove it (just replacing)
            if (currentImageDiv && !wasExplicitlyRemoved) {
                currentImageDiv.style.display = 'block';
                currentImageDiv.classList.remove('hidden');
            } else if (currentImageDiv && wasExplicitlyRemoved) {
                // Keep it hidden if user removed it
                currentImageDiv.style.display = 'none';
                currentImageDiv.classList.add('hidden');
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
</script>
@endsection
