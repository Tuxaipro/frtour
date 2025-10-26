@extends('layouts.admin')

@section('title', 'View Hero Section')
@section('subtitle', 'Preview the hero section details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">View Hero Section</h1>
            <p class="text-slate-600">Preview the hero section details</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.heroes.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
            <a href="{{ route('admin.heroes.edit', $hero) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <!-- Status and Order -->
    <div class="flex items-center space-x-3">
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $hero->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
            {{ $hero->is_active ? 'Active' : 'Inactive' }}
        </span>
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            Sort Order: {{ $hero->sort_order }}
        </span>
        <span class="text-xs text-slate-500">{{ $hero->created_at->format('M d, Y') }}</span>
    </div>

    <!-- Background Image Preview -->
    @if($hero->background_image)
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700">Background Image</h3>
            </div>
            <div class="p-4">
                <div class="flex items-center space-x-4">
                    <div class="relative w-24 h-16 rounded-lg overflow-hidden border border-slate-200 shadow-sm group flex-shrink-0">
                        <img src="{{ asset('storage/' . $hero->background_image) }}" alt="{{ $hero->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100">
                            <a href="{{ asset('storage/' . $hero->background_image) }}" target="_blank" class="bg-white/90 hover:bg-white text-slate-700 px-2 py-1 rounded text-xs font-medium">
                                View
                            </a>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-slate-500">{{ basename($hero->background_image) }}</p>
                        <a href="{{ asset('storage/' . $hero->background_image) }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 mt-1 inline-block">Open full size image</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700">Basic Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Title</label>
                    <p class="text-base font-semibold text-slate-900">{{ $hero->title }}</p>
                </div>
                
                @if($hero->subtitle)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Subtitle</label>
                        <p class="text-sm text-slate-700">{{ $hero->subtitle }}</p>
                    </div>
                @endif
                
                @if($hero->badge_text)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Badge Text</label>
                        <p class="text-sm text-slate-700">{{ $hero->badge_text }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Call-to-Action Buttons -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-slate-200">
                <h3 class="text-sm font-semibold text-slate-700">Call-to-Action Buttons</h3>
            </div>
            <div class="p-6 space-y-3">
                @if($hero->primary_button_text)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Primary Button</label>
                        <div class="space-y-1">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm font-medium">{{ $hero->primary_button_text }}</span>
                            @if($hero->primary_button_url)
                                <p class="text-xs text-slate-500 break-all">{{ $hero->primary_button_url }}</p>
                            @endif
                        </div>
                    </div>
                @endif
                
                @if($hero->secondary_button_text)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Secondary Button</label>
                        <div class="space-y-1">
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm font-medium">{{ $hero->secondary_button_text }}</span>
                            @if($hero->secondary_button_url)
                                <p class="text-xs text-slate-500 break-all">{{ $hero->secondary_button_url }}</p>
                            @endif
                        </div>
                    </div>
                @endif
                
                @if($hero->tertiary_button_text)
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Tertiary Button</label>
                        <div class="space-y-1">
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm font-medium">{{ $hero->tertiary_button_text }}</span>
                            @if($hero->tertiary_button_url)
                                <p class="text-xs text-slate-500 break-all">{{ $hero->tertiary_button_url }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
