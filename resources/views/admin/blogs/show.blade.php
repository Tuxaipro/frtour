@extends('layouts.admin')

@section('title', 'View Blog Post')
@section('subtitle', 'Blog post details and preview')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $blog->title }}</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">View blog post details and preview</p>
                </div>
                <a href="{{ route('admin.blogs.index') }}" 
                   class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Featured Image -->
            @if($blog->featured_image)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-bold text-slate-900">Featured Image</h2>
                </div>
                <div class="p-6">
                    <div class="relative rounded-xl overflow-hidden border-2 border-slate-200 group">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                             alt="{{ $blog->title }}" 
                             class="w-full h-auto max-h-96 object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ asset('storage/' . $blog->featured_image) }}" target="_blank" 
                               class="bg-white/90 hover:bg-white text-slate-700 px-4 py-2 rounded-lg text-sm font-medium shadow-lg">
                                View Full Size
                            </a>
                        </div>
                    </div>
                    <p class="text-xs text-slate-500 mt-3">{{ basename($blog->featured_image) }}</p>
                </div>
            </div>
            @endif

            <!-- Content -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-bold text-slate-900">Content</h2>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-bold text-slate-900">Status</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-slate-700">Publication Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $blog->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    @if($blog->published_at)
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-700">Published At</span>
                        <span class="text-sm text-slate-600">{{ $blog->published_at->format('M d, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Meta Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-bold text-slate-900">Meta Information</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Slug</label>
                        <p class="text-sm text-slate-900 mt-1 font-mono bg-slate-50 px-3 py-2 rounded-lg">{{ $blog->slug }}</p>
                    </div>
                    
                    @if($blog->excerpt)
                    <div>
                        <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Excerpt</label>
                        <p class="text-sm text-slate-700 mt-1">{{ $blog->excerpt }}</p>
                    </div>
                    @endif
                    
                    @if($blog->meta_description)
                    <div>
                        <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Meta Description</label>
                        <p class="text-sm text-slate-700 mt-1">{{ $blog->meta_description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-bold text-slate-900">Statistics</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-700">Word Count</span>
                        <span class="text-sm font-bold text-slate-900">{{ str_word_count(strip_tags($blog->content)) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-700">Reading Time</span>
                        <span class="text-sm font-bold text-slate-900">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-700">Created</span>
                        <span class="text-sm text-slate-600">{{ $blog->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-700">Last Updated</span>
                        <span class="text-sm text-slate-600">{{ $blog->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
