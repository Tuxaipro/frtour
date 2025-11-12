@extends('layouts.admin')

@section('title', 'Create New Blog Post')
@section('subtitle', 'Write and publish a new blog post')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Create New Blog Post</h1>
            <p class="text-sm text-slate-600 mt-1.5 font-medium">Write and publish a new blog post</p>
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

            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('title') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Enter blog post title">
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
                        
                        <!-- Image preview -->
                        <div id="new-image-preview" class="mb-4 hidden">
                            <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-xl border-2 border-blue-200">
                                <img id="preview-new" src="" alt="New image" class="w-32 h-20 object-cover rounded-xl border-2 border-blue-200 shadow-sm flex-shrink-0">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-blue-700">New Image Preview</p>
                                    <p class="text-xs text-blue-600 mt-1" id="filename"></p>
                                    <p class="text-xs text-blue-500 mt-1" id="file-size"></p>
                                    <div class="mt-3">
                                        <button type="button" onclick="clearNewImage()" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 border-2 border-red-200 rounded-xl hover:bg-red-100 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" name="featured_image" id="featured_image" accept="image/*" onchange="previewImage(this)" class="block w-full text-sm text-slate-600 bg-white border-2 border-slate-200 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 @error('featured_image') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        <p class="text-slate-500 text-xs mt-2 px-1">Upload a featured image for this blog post (jpg, png, gif - max 5MB)</p>
                        @error('featured_image')
                            <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-2">Excerpt (Short Description)</label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('excerpt') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Brief description of the blog post">{{ old('excerpt') }}</textarea>
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
                        <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">Content</label>
                        <textarea name="content" id="content" rows="15" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('content') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('content') }}</textarea>
                        <p class="text-slate-500 text-xs mt-2 px-1">Main blog content (HTML supported)</p>
                        @error('content')
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
                        <textarea name="meta_description" id="meta_description" rows="3" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('meta_description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('meta_description') }}</textarea>
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
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <span class="text-sm font-semibold text-slate-700">Published</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.blogs.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">Cancel</a>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
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