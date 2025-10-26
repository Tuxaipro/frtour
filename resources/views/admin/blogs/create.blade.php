@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Create New Blog Post</h1>

                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                        
                        <!-- Image preview -->
                        <div id="new-image-preview" class="mb-4 hidden">
                            <div class="flex items-start space-x-3 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <img id="preview-new" src="" alt="New image" class="w-32 h-20 object-cover rounded-lg border border-slate-300 shadow-sm flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-700">New Image Preview</p>
                                    <p class="text-xs text-slate-500 mt-1" id="filename"></p>
                                    <p class="text-xs text-slate-400 mt-1" id="file-size"></p>
                                    <div class="mt-3">
                                        <button type="button" onclick="clearNewImage()" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="previewImage(this)" class="block w-full text-sm text-gray-900 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-gray-500 text-xs mt-2">Upload a featured image for this blog post (jpg, png, gif - max 2MB)</p>
                        @error('featured_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt (Short Description)</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Brief description of the blog post">{{ old('excerpt') }}</textarea>
                        <p class="text-gray-500 text-xs mt-1">A short preview of the blog post (optional)</p>
                        @error('excerpt')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" id="content" rows="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('content') }}</textarea>
                        <p class="text-gray-500 text-xs mt-1">Main blog content (HTML supported)</p>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ old('is_published') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600">Published</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.blogs.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Blog Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    console.log('previewImage function called');
    if (input.files && input.files[0]) {
        console.log('File selected:', input.files[0].name);
        const file = input.files[0];
        
        // Check file type
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid image file (JPG, PNG, GIF)');
            input.value = '';
            return;
        }
        
        // Check file size (2MB max)
        if (file.size > 2048000) {
            alert('File size exceeds 2MB limit. Please choose a smaller image.');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            console.log('File loaded successfully');
            document.getElementById('preview-new').src = e.target.result;
            document.getElementById('filename').textContent = file.name;
            // Show file size
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            document.getElementById('file-size').textContent = 'Size: ' + fileSizeMB + ' MB';
            document.getElementById('new-image-preview').classList.remove('hidden');
        };
        reader.onerror = function(error) {
            console.error('Error reading file:', error);
            alert('Error reading file. Please try again.');
        };
        reader.readAsDataURL(file);
    } else {
        console.log('No file selected');
    }
}

function clearNewImage() {
    console.log('clearNewImage function called');
    document.getElementById('featured_image').value = '';
    document.getElementById('new-image-preview').classList.add('hidden');
    document.getElementById('preview-new').src = '';
    document.getElementById('filename').textContent = '';
}

// Ensure functions are available globally
console.log('Image preview functions loaded');
</script>
@endsection