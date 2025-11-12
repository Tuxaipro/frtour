@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
            <h1 class="text-2xl font-bold text-slate-900">Edit Destination</h1>
            <p class="text-sm text-slate-600 mt-1">Update destination information</p>
        </div>
        <div class="p-6">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">There were some problems with your input:</strong>
                        <ul class="mt-2">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" id="destination-edit-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $destination->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                        <input type="text" name="slug" id="slug" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('slug', $destination->slug) }}" required>
                        @error('slug')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4">{{ old('description', $destination->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="hero_title" class="block text-gray-700 text-sm font-bold mb-2">Hero Title</label>
                        <input type="text" name="hero_title" id="hero_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('hero_title', $destination->hero_title) }}">
                        @error('hero_title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="hero_description" class="block text-gray-700 text-sm font-bold mb-2">Hero Description</label>
                        <textarea name="hero_description" id="hero_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('hero_description', $destination->hero_description) }}</textarea>
                        @error('hero_description')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_title" class="block text-gray-700 text-sm font-bold mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('meta_title', $destination->meta_title) }}">
                        @error('meta_title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_description" class="block text-gray-700 text-sm font-bold mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="2">{{ old('meta_description', $destination->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="sort_order" class="block text-gray-700 text-sm font-bold mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('sort_order', $destination->sort_order ?? 0) }}" min="0">
                        <p class="text-gray-500 text-xs mt-1">Lower numbers appear first. Default is 0.</p>
                        @error('sort_order')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.destinations.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg flex items-center">
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
    
    // Form submission debugging
    form.addEventListener('submit', function(e) {
        console.log('Edit form is being submitted...');
        console.log('Form data:', new FormData(form));
        
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
        
        console.log('Edit form validation passed, submitting...');
    });
});
</script>
@endsection
