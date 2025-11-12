@extends('layouts.admin')

@section('title', 'Gallery')
@section('subtitle', 'Manage gallery images')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Gallery</h1>
            <p class="text-sm text-slate-600 mt-1.5 font-medium">Manage your gallery images</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.galerie-category.index') }}" 
               class="bg-slate-600 text-white px-5 py-2.5 rounded-xl hover:bg-slate-700 transition-all duration-200 flex items-center shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                Categories
            </a>
            <a href="{{ route('admin.galerie.create') }}" 
               class="bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary-dark transition-all duration-200 flex items-center shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Image
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-xl shadow-md flex items-center">
            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter Bar -->
    <form method="GET" action="{{ route('admin.galerie.index') }}" class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, description..." class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400">
            @if($categories->count() > 0)
                <div class="flex space-x-3">
                    <select name="category_id" class="flex-1 px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-lg">Apply</button>
                    <a href="{{ route('admin.galerie.index') }}" class="bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-200 px-6 py-3 rounded-xl font-semibold transition-all duration-200 shadow-sm hover:shadow-md flex items-center">Clear</a>
                </div>
            @else
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-primary hover:bg-primary-dark text-white px-5 py-3 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-lg">Apply</button>
                    <a href="{{ route('admin.galerie.index') }}" class="flex-1 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-200 px-5 py-3 rounded-xl font-semibold transition-all duration-200 text-center shadow-sm hover:shadow-md">Clear</a>
                </div>
            @endif
        </div>
    </form>

    <!-- Old Category Filter (hidden for now, keeping for reference) -->
    @if(false && $categories->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
            <form method="GET" action="{{ route('admin.galerie.index') }}" class="flex items-center space-x-4">
                <label for="category_id" class="text-sm font-medium text-slate-700">Filter by category:</label>
                <select name="category_id" id="category_id" 
                        class="px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->galeries->count() }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Filter
                </button>
                @if(request('category_id'))
                    <a href="{{ route('admin.galerie.index') }}" 
                       class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors duration-200">
                        Clear
                    </a>
                @endif
            </form>
        </div>
    @endif

    <!-- Gallery Grid -->
    @if($galerie->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6">
            <div class="mb-6 pb-4 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">All Gallery Images</h2>
                <p class="text-xs text-slate-600 mt-1">Total: {{ $galerie->count() }} image(s)</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($galerie as $image)
                    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="aspect-w-16 aspect-h-12 bg-slate-100">
                        <img src="{{ Storage::url($image->image) }}" 
                             alt="{{ $image->title }}" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-800 mb-2">{{ $image->title }}</h3>
                        @if($image->category)
                            <div class="mb-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $image->category->name }}
                                </span>
                            </div>
                        @endif
                        @if($image->description)
                            <p class="text-sm text-slate-600 mb-3">{{ Str::limit($image->description, 100) }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $image->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $image->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.galerie.edit', $image) }}" 
                                   class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.galerie.destroy', $image) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No images found</h3>
                <p class="text-sm text-slate-600 mb-8">Start by adding an image to your gallery.</p>
                <a href="{{ route('admin.galerie.create') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-sm font-semibold rounded-xl text-white bg-primary hover:bg-primary-dark transition-all duration-200 hover:shadow-xl">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Image
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
