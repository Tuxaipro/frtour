@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">{{ $circuit->name }}</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ $circuit->slug }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.circuits.edit', $circuit) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.circuits.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Status Badge -->
        <div class="px-6 py-3 bg-slate-50">
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $circuit->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    <span class="w-2 h-2 rounded-full mr-2 {{ $circuit->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                    {{ $circuit->is_active ? 'Active' : 'Inactive' }}
                </span>
                <span class="text-sm text-slate-500">
                    Sort Order: {{ $circuit->sort_order ?? 0 }}
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Basic Information</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Duration</label>
                            <p class="text-sm text-slate-900 font-medium">{{ $circuit->duration_days }} days</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Price From</label>
                            <p class="text-sm text-slate-900 font-medium">€{{ number_format($circuit->price_from, 2) }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-slate-500 mb-1">Destination</label>
                            <p class="text-sm text-slate-900">{{ $circuit->destination->name ?? 'No destination assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($circuit->description)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Description</h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $circuit->description }}</p>
                </div>
            </div>
            @endif

            <!-- Highlights -->
            @if($circuit->highlights)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Highlights</h2>
                </div>
                <div class="px-6 py-4">
                    <div class="text-sm text-slate-700 whitespace-pre-line leading-relaxed">{{ $circuit->highlights }}</div>
                </div>
            </div>
            @endif

            <!-- Itinerary -->
            @if($circuit->itinerary)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Itinerary</h2>
                </div>
                <div class="px-6 py-4">
                    <div class="text-sm text-slate-700 whitespace-pre-line leading-relaxed">{{ $circuit->itinerary }}</div>
                </div>
            </div>
            @endif

            <!-- Tags -->
            @if($circuit->tags)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Tags</h2>
                </div>
                <div class="px-6 py-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $circuit->tags) as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Metadata -->
        <div class="space-y-6">
            <!-- Metadata -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Metadata</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Created</label>
                        <p class="text-sm text-slate-900">{{ $circuit->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Updated</label>
                        <p class="text-sm text-slate-900">{{ $circuit->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            @if($circuit->featured_image)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Featured Image</h2>
                </div>
                <div class="px-6 py-4">
                    <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-full h-48 object-cover rounded-lg border border-slate-200">
                    <p class="text-xs text-slate-500 mt-2 text-center">{{ basename($circuit->featured_image) }}</p>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Actions</h2>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('admin.circuits.destroy', $circuit) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this circuit? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Circuit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
