@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">{{ $destination->name }}</h1>
                    <p class="text-sm text-slate-500 mt-1">{{ $destination->slug }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.destinations.edit', $destination) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.destinations.index') }}" 
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
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $destination->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    <span class="w-2 h-2 rounded-full mr-2 {{ $destination->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                    {{ $destination->is_active ? 'Active' : 'Inactive' }}
                </span>
                <span class="text-sm text-slate-500">
                    Sort Order: {{ $destination->sort_order ?? 0 }}
                </span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Description -->
            @if($destination->description)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Description</h2>
                </div>
                <div class="px-6 py-4">
                    <p class="text-sm text-slate-700 leading-relaxed">{{ $destination->description }}</p>
                </div>
            </div>
            @endif

            <!-- Hero Section -->
            @if($destination->hero_title || $destination->hero_description)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Hero Section</h2>
                </div>
                <div class="px-6 py-4 space-y-3">
                    @if($destination->hero_title)
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Title</label>
                            <p class="text-sm text-slate-900 font-medium">{{ $destination->hero_title }}</p>
                        </div>
                    @endif
                    @if($destination->hero_description)
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Description</label>
                            <p class="text-sm text-slate-700">{{ $destination->hero_description }}</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Circuits -->
            @if($destination->circuits->count() > 0)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-slate-900">Circuits</h2>
                        <span class="text-sm text-slate-500">{{ $destination->circuits->count() }} circuit(s)</span>
                    </div>
                </div>
                <div class="px-6 py-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($destination->circuits as $circuit)
                            <div class="border border-slate-200 rounded-lg p-4 hover:border-blue-300 transition-colors duration-200">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-sm font-semibold text-slate-900">{{ $circuit->name }}</h3>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $circuit->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $circuit->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                @if($circuit->description)
                                    <p class="text-xs text-slate-600 mb-2">{{ Str::limit($circuit->description, 100) }}</p>
                                @endif
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xs text-slate-500">{{ $circuit->duration_days }} days</span>
                                    @if($circuit->price_from)
                                        <span class="text-xs font-medium text-slate-900">€{{ number_format($circuit->price_from, 0) }}+</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
                <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                    <div class="px-6 py-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-slate-900">No circuits</h3>
                        <p class="mt-1 text-sm text-slate-500">No circuits found for this destination.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column - Metadata -->
        <div class="space-y-6">
            <!-- SEO Information -->
            @if($destination->meta_title || $destination->meta_description)
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">SEO Information</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    @if($destination->meta_title)
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Meta Title</label>
                            <p class="text-sm text-slate-900">{{ $destination->meta_title }}</p>
                        </div>
                    @endif
                    @if($destination->meta_description)
                        <div>
                            <label class="block text-sm font-medium text-slate-500 mb-1">Meta Description</label>
                            <p class="text-sm text-slate-700">{{ $destination->meta_description }}</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Metadata -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Metadata</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Created</label>
                        <p class="text-sm text-slate-900">{{ $destination->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Updated</label>
                        <p class="text-sm text-slate-900">{{ $destination->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-semibold text-slate-900">Actions</h2>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('admin.destinations.destroy', $destination) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this destination? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Destination
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
