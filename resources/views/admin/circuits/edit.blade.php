@extends('layouts.admin')

@section('title', 'Edit Circuit')
@section('subtitle', 'Update circuit information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Circuit</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">Update circuit information</p>
                </div>
                <a href="{{ route('admin.circuits.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
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

            @if(session('error'))
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-xl shadow-md mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.circuits.update', $circuit) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('name', $circuit->name) }}" required placeholder="Enter circuit name">
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
                        <input type="text" name="slug" id="slug" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('slug') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('slug', $circuit->slug) }}" required placeholder="auto-generated-from-name">
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
                        <input type="number" name="sort_order" id="sort_order" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('sort_order', $circuit->sort_order ?? 0) }}" min="0">
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
                        <textarea name="description" id="description" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="4">{{ old('description', $circuit->description) }}</textarea>
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
                        <label for="duration_days" class="block text-sm font-semibold text-slate-700 mb-2">Duration (days) <span class="text-red-500">*</span></label>
                        <input type="number" name="duration_days" id="duration_days" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('duration_days') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('duration_days', $circuit->duration_days) }}" required min="1">
                        @error('duration_days')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="price_from" class="block text-sm font-semibold text-slate-700 mb-2">Price From (€)</label>
                        <input type="number" step="0.01" name="price_from" id="price_from" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('price_from') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('price_from', $circuit->price_from) }}" placeholder="0.00">
                        @error('price_from')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="destination_id" class="block text-sm font-semibold text-slate-700 mb-2">Destination</label>
                        <select name="destination_id" id="destination_id" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error('destination_id') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <option value="">Select Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" {{ old('destination_id', $circuit->destination_id) == $destination->id ? 'selected' : '' }}>
                                    {{ $destination->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="highlights" class="block text-sm font-semibold text-slate-700 mb-2">Highlights</label>
                        <textarea name="highlights" id="highlights" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('highlights') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="3" placeholder="Key highlights of this circuit...">{{ old('highlights', $circuit->highlights) }}</textarea>
                        @error('highlights')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="tags" class="block text-sm font-semibold text-slate-700 mb-2">Tags (séparés par des virgules)</label>
                        <input type="text" name="tags" id="tags" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('tags') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('tags', $circuit->tags) }}" placeholder="Ex: Culture, Nature, Aventure, Relaxation">
                        <p class="text-slate-500 text-xs mt-2 px-1">Séparez les tags par des virgules. Ex: Culture, Nature, Aventure</p>
                        @error('tags')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="itinerary" class="block text-sm font-semibold text-slate-700 mb-2">Itinerary</label>
                        <textarea name="itinerary" id="itinerary" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('itinerary') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" rows="5" placeholder="Day-by-day itinerary...">{{ old('itinerary', $circuit->itinerary) }}</textarea>
                        @error('itinerary')
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
                        
                        @if($circuit->featured_image)
                            <div id="current-image" class="mb-3">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-xl border-2 border-slate-200">
                                    <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-24 h-16 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0">
                                    <div class="flex-1 flex flex-col justify-between min-h-[96px]">
                                        <div>
                                            <p class="text-sm font-medium text-slate-700">Current Image</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ basename($circuit->featured_image) }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2 mt-auto">
                                            <a href="{{ asset('storage/' . $circuit->featured_image) }}" target="_blank" class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
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
                            <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="previewImage(this)" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark file:cursor-pointer cursor-pointer border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('featured_image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
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
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200" value="1" {{ old('is_active', $circuit->is_active) ? 'checked' : '' }}>
                            <span class="text-sm font-semibold text-slate-700">Active</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.circuits.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Circuit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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
    document.getElementById('current-image').classList.add('hidden');
    document.getElementById('featured_image').style.display = 'block';
}
</script>
@endsection
