@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $circuit->name }}</h1>
                    <div class="space-x-2">
                        <a href="{{ route('admin.circuits.edit', $circuit) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit Circuit
                        </a>
                        <a href="{{ route('admin.circuits.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $circuit->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Slug</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $circuit->slug }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Duration</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $circuit->duration_days }} days</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price From</label>
                                <p class="mt-1 text-sm text-gray-900">€{{ number_format($circuit->price_from, 2) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Destination</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $circuit->destination->name ?? 'No destination assigned' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <p class="mt-1">
                                    @if($circuit->is_active)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Active</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Inactive</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sort Order</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $circuit->sort_order ?? 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Content</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1 text-sm text-gray-900">
                                    @if($circuit->description)
                                        {{ $circuit->description }}
                                    @else
                                        <span class="text-gray-500 italic">No description provided</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($circuit->highlights)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-4">Highlights</h3>
                    <div class="text-sm text-gray-900 whitespace-pre-line">{{ $circuit->highlights }}</div>
                </div>
                @endif

                @if($circuit->itinerary)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-4">Itinerary</h3>
                    <div class="text-sm text-gray-900 whitespace-pre-line">{{ $circuit->itinerary }}</div>
                </div>
                @endif

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Created: {{ $circuit->created_at->format('M d, Y H:i') }}<br>
                            Updated: {{ $circuit->updated_at->format('M d, Y H:i') }}
                        </div>
                        <form action="{{ route('admin.circuits.destroy', $circuit) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this circuit? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Circuit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
