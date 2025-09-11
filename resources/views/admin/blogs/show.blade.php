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