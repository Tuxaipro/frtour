@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $destination->name }}</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.destinations.edit', $destination) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit Destination
                        </a>
                        <a href="{{ route('admin.destinations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Basic Information</h3>
                        <div class="space-y-2">
                            <div>
                                <label class="font-medium">Name:</label>
                                <p class="text-gray-700">{{ $destination->name }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Slug:</label>
                                <p class="text-gray-700">{{ $destination->slug }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Sort Order:</label>
                                <p class="text-gray-700">{{ $destination->sort_order ?? 0 }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Status:</label>
                                <p class="text-gray-700">
                                    @if($destination->is_active)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Active</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">SEO Information</h3>
                        <div class="space-y-2">
                            <div>
                                <label class="font-medium">Meta Title:</label>
                                <p class="text-gray-700">{{ $destination->meta_title ?? 'Not set' }}</p>
                            </div>
                            <div>
                                <label class="font-medium">Meta Description:</label>
                                <p class="text-gray-700">{{ $destination->meta_description ?? 'Not set' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <p class="text-gray-700">{{ $destination->description ?? 'No description provided' }}</p>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Hero Section</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="font-medium">Hero Title:</label>
                            <p class="text-gray-700">{{ $destination->hero_title ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="font-medium">Hero Description:</label>
                            <p class="text-gray-700">{{ $destination->hero_description ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Circuits</h3>
                    @if($destination->circuits->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($destination->circuits as $circuit)
                                <div class="border rounded-lg p-4">
                                    <h4 class="font-semibold">{{ $circuit->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ Str::limit($circuit->description, 100) }}</p>
                                    <div class="mt-2">
                                        <span class="text-xs {{ $circuit->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded">
                                            {{ $circuit->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No circuits found for this destination.</p>
                    @endif
                </div>

                <div class="mt-6 flex justify-between">
                    <div class="text-sm text-gray-500">
                        Created: {{ $destination->created_at->format('M d, Y H:i') }}
                    </div>
                    <div class="text-sm text-gray-500">
                        Updated: {{ $destination->updated_at->format('M d, Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
