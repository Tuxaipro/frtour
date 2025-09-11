@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $page->title }}</h1>
                    <div>
                        <a href="{{ route('admin.pages.edit', $page) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Edit
                        </a>
                        <a href="{{ route('admin.pages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Pages
                        </a>
                    </div>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Slug:</strong>
                    <span class="text-gray-900">{{ $page->slug }}</span>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Status:</strong>
                    @if($page->is_active)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactive
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Meta Title:</strong>
                    <div class="text-gray-900">{{ $page->meta_title ?? 'N/A' }}</div>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Meta Description:</strong>
                    <div class="text-gray-900">{{ $page->meta_description ?? 'N/A' }}</div>
                </div>

                <div class="mb-4">
                    <strong class="text-gray-700">Content:</strong>
                    <div class="text-gray-900 mt-2 prose max-w-none">
                        {!! $page->content !!}
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('page', $page->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                        View Page on Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection