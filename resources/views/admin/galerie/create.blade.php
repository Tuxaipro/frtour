@extends('layouts.admin')

@section('title', 'Add Image')
@section('subtitle', 'Add a new image to the gallery')

@section('content')
<div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add Image to Gallery</h1>
                <p class="text-sm text-slate-600 mt-1.5 font-medium">Upload a new image to your gallery</p>
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

                <form action="{{ route('admin.galerie.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Enter image title" required>
                            @error('title')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">
                                Category
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error('category_id') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                                <option value="">Select a category (optional)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">
                                Display Order
                            </label>
                            <input type="number" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', 0) }}"
                                   min="0"
                                   class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Images with lower order will appear first</p>
                            @error('sort_order')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                      placeholder="Enter image description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">
                                Image <span class="text-red-500">*</span>
                            </label>
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   onchange="previewImage(this)"
                                   class="block w-full text-sm text-slate-600 bg-white border-2 border-slate-200 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 @error('image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <p class="text-slate-500 text-xs mt-2 px-1">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 5MB</p>
                            @error('image')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            
                            <!-- Image preview -->
                            <div id="new-image-preview" class="mt-4 hidden">
                                <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl border-2 border-blue-200">
                                    <img id="preview-new" src="" alt="New image" class="w-24 h-16 object-cover rounded-xl border-2 border-blue-200 shadow-sm flex-shrink-0">
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
                        </div>

                        <!-- Active Status -->
                        <div class="md:col-span-2">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200">
                                <span class="text-sm font-semibold text-slate-700">Active Image</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                        <a href="{{ route('admin.galerie.index') }}" 
                           class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Add Image
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
    document.getElementById('image').value = '';
    document.getElementById('preview-new').src = '';
    document.getElementById('filename').textContent = '';
}
</script>
@endsection
