@extends('layouts.admin')

@section('title', 'Create Hero Section')
@section('subtitle', 'Add a new hero section to your homepage')

@section('content')
<div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Create Hero Section</h1>
                <p class="text-sm text-slate-600 mt-1.5 font-medium">Add a new hero section to your homepage</p>
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

                <form action="{{ route('admin.heroes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Hidden fields for default values --}}
                    <input type="hidden" name="layout_type" value="minimal">
                    <input type="hidden" name="content_alignment" value="center">
                    <input type="hidden" name="overlay_color" value="#000000">
                    <input type="hidden" name="overlay_opacity" value="0.5">
                    <input type="hidden" name="animation_type" value="fade">
                    <input type="hidden" name="animation_duration" value="500">
                    
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
                                        <input type="checkbox" name="show_title" id="show_title" value="1" {{ old('show_title', true) ? 'checked' : '' }} 
                                               class="w-4 h-4 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary transition-colors duration-200">
                                        <label for="show_title" class="text-sm font-medium text-slate-700 cursor-pointer">Show Title</label>
                                    </div>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required 
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
                                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" 
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
                                          placeholder="Enter a longer description for the hero section">{{ old('description') }}</textarea>
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
                                <input type="text" name="badge_text" id="badge_text" value="{{ old('badge_text') }}" 
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
                                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0" 
                                       class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="0">
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

                    <!-- Buttons -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Call-to-Action Buttons</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure the hero section buttons</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="primary_button_text" class="block text-sm font-semibold text-slate-700 mb-2">Primary Button Text</label>
                                <input type="text" name="primary_button_text" id="primary_button_text" value="{{ old('primary_button_text') }}" 
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
                                <input type="text" name="primary_button_url" id="primary_button_url" value="{{ old('primary_button_url') }}" 
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
                                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text') }}" 
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
                                <input type="text" name="secondary_button_url" id="secondary_button_url" value="{{ old('secondary_button_url') }}" 
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
                                <input type="text" name="tertiary_button_text" id="tertiary_button_text" value="{{ old('tertiary_button_text') }}" 
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
                                <input type="text" name="tertiary_button_url" id="tertiary_button_url" value="{{ old('tertiary_button_url') }}" 
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
                    </div>

                    <!-- Media -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Background Image</h2>
                            <p class="text-xs text-slate-500 mt-1">Upload a background image for the hero section</p>
                        </div>
                        
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
                            <label for="background_image" class="block text-sm font-semibold text-slate-700 mb-2">Background Image</label>
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
                    <!-- Settings -->
                    <div class="mb-8">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900">Settings</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure the hero section visibility</p>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
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
                            Create Hero Section
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
            document.getElementById('new-image-preview').classList.remove('hidden');
            document.getElementById('preview-new').src = e.target.result;
            document.getElementById('filename').textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
}

function clearNewImage() {
    document.getElementById('new-image-preview').classList.add('hidden');
    document.getElementById('background_image').value = '';
    document.getElementById('preview-new').src = '';
    document.getElementById('filename').textContent = '';
}

</script>
@endsection
