@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
                    <div>
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Edit
                        </a>
                        <a href="{{ route('admin.blogs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Blog Posts
                        </a>
                    </div>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Slug:</strong>
                    <span class="text-gray-900">{{ $blog->slug }}</span>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Status:</strong>
                    @if($blog->is_published)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Published
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Draft
                        </span>
                    @endif
                </div>

                @if($blog->featured_image)
                <div class="mb-4">
                    <strong class="text-gray-700 block mb-2">Featured Image:</strong>
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                        <div class="p-4 bg-slate-50 border-b border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-700">Image Preview</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <div class="relative w-48 h-32 rounded-lg overflow-hidden border border-slate-200 shadow-sm group flex-shrink-0">
                                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <a href="{{ asset('storage/' . $blog->featured_image) }}" target="_blank" class="bg-white/90 hover:bg-white text-slate-700 px-3 py-2 rounded text-sm font-medium">
                                            View Full Size
                                        </a>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-slate-600 mb-2">{{ basename($blog->featured_image) }}</p>
                                    <a href="{{ asset('storage/' . $blog->featured_image) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Open full size image
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mb-4">
                    <strong class="text-gray-700">Meta Description:</strong>
                    <div class="text-gray-900">{{ $blog->meta_description ?? 'N/A' }}</div>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Created At:</strong>
                    <span class="text-gray-900">{{ $blog->created_at->format('F d, Y \a\t g:i A') }}</span>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Content:</strong>
                    <div class="text-gray-900 mt-2 prose max-w-none">
                        {!! $blog->content !!}
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('blog') }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                        View Blog Post on Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection