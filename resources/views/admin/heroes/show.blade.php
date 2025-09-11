@extends('layouts.admin')

@section('title', 'View Hero Section')
@section('subtitle', 'Preview the hero section details')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">View Hero Section</h1>
                        <p class="text-sm text-gray-600 mt-1">Preview the hero section details</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.heroes.edit', $hero) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('admin.heroes.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Hero Sections
                        </a>
                    </div>
                </div>

                <!-- Status and Order -->
                <div class="flex items-center space-x-4 mb-6">
                    @if($hero->is_active)
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                            Inactive
                        </span>
                    @endif
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                        Order: {{ $hero->sort_order }}
                    </span>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                        Created: {{ $hero->created_at->format('M d, Y') }}
                    </span>
                </div>

                <!-- Basic Information -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $hero->title }}</p>
                        </div>
                        
                        @if($hero->subtitle)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                                <p class="text-gray-900">{{ $hero->subtitle }}</p>
                            </div>
                        @endif
                        
                        
                        @if($hero->badge_text)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Badge Text</label>
                                <p class="text-gray-900">{{ $hero->badge_text }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Call-to-Action Buttons -->
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Call-to-Action Buttons</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if($hero->primary_button_text)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Primary Button</label>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded text-sm">{{ $hero->primary_button_text }}</span>
                                    @if($hero->primary_button_url)
                                        <a href="{{ $hero->primary_button_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                            {{ $hero->primary_button_url }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        @if($hero->secondary_button_text)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Secondary Button</label>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm">{{ $hero->secondary_button_text }}</span>
                                    @if($hero->secondary_button_url)
                                        <a href="{{ $hero->secondary_button_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                            {{ $hero->secondary_button_url }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        @if($hero->tertiary_button_text)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tertiary Button</label>
                                <div class="flex items-center space-x-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded text-sm">{{ $hero->tertiary_button_text }}</span>
                                    @if($hero->tertiary_button_url)
                                        <a href="{{ $hero->tertiary_button_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                            {{ $hero->tertiary_button_url }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Background Image -->
                @if($hero->background_image)
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Background Image</h3>
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $hero->background_image) }}" alt="{{ $hero->title }}" class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">Image path: {{ $hero->background_image }}</p>
                                <a href="{{ asset('storage/' . $hero->background_image) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">View full size</a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Preview -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview</h3>
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <div class="text-center">
                            @if($hero->badge_text)
                                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 border border-blue-200 text-blue-800 font-medium text-sm mb-4">
                                    {{ $hero->badge_text }}
                                </div>
                            @endif
                            
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $hero->title }}</h2>
                            
                            @if($hero->subtitle)
                                <p class="text-xl text-gray-600 mb-4">{{ $hero->subtitle }}</p>
                            @endif
                            
                            
                            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                                @if($hero->primary_button_text)
                                    <a href="{{ $hero->primary_button_url ?: '#' }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                                        {{ $hero->primary_button_text }}
                                    </a>
                                @endif
                                
                                @if($hero->secondary_button_text)
                                    <a href="{{ $hero->secondary_button_url ?: '#' }}" class="bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-600 px-6 py-3 rounded-lg font-semibold">
                                        {{ $hero->secondary_button_text }}
                                    </a>
                                @endif
                                
                                @if($hero->tertiary_button_text)
                                    <a href="{{ $hero->tertiary_button_url ?: '#' }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-lg font-semibold">
                                        {{ $hero->tertiary_button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
