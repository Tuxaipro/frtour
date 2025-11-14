@extends('layouts.admin')

@section('title', 'Quote Request Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Quote Request Details</h1>
            <p class="text-sm text-slate-600 mt-1.5 font-medium">View and manage quote request information</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.quote-requests.index') }}" class="inline-flex items-center px-4 py-2 bg-white border-2 border-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to List
            </a>
            <a href="{{ route('admin.quote-requests.edit', $quoteRequest) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-xl shadow-md flex items-center">
            <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Client Information -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-900">Client Information</h2>
                    <p class="text-xs text-slate-600 mt-1">Submitted on {{ $quoteRequest->created_at->format('d/m/Y at H:i') }}</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Full Name</label>
                            <p class="text-base font-medium text-slate-900">{{ $quoteRequest->first_name }} {{ $quoteRequest->last_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Email</label>
                            <a href="mailto:{{ $quoteRequest->email }}" class="text-base font-medium text-primary hover:text-primary-dark transition-colors">
                                {{ $quoteRequest->email }}
                            </a>
                        </div>
                        @if($quoteRequest->phone)
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Phone</label>
                            <a href="tel:{{ $quoteRequest->phone }}" class="text-base font-medium text-primary hover:text-primary-dark transition-colors">
                                {{ $quoteRequest->phone }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Trip Details -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-900">Trip Details</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Number of Travelers</label>
                                <p class="text-base text-slate-900">{{ $quoteRequest->number_of_travelers }} traveler{{ $quoteRequest->number_of_travelers > 1 ? 's' : '' }}</p>
                            </div>
                        </div>
                        @if($quoteRequest->travel_dates)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Travel Dates</label>
                                <p class="text-base text-slate-900">{{ is_string($quoteRequest->travel_dates) ? $quoteRequest->travel_dates : $quoteRequest->travel_dates->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        @endif
                        @if($selectedDestination)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Destination</label>
                                <p class="text-base text-slate-900">{{ $selectedDestination }}</p>
                            </div>
                        </div>
                        @endif
                        @if($duration)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Duration</label>
                                <p class="text-base text-slate-900">{{ $duration }}</p>
                            </div>
                        </div>
                        @endif
                        @if($country)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Country</label>
                                <p class="text-base text-slate-900">{{ $country }}</p>
                            </div>
                        </div>
                        @endif
                        @if($quoteRequest->travel_style)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Travel Style</label>
                                <p class="text-base text-slate-900">{{ ucfirst($quoteRequest->travel_style) }}</p>
                            </div>
                        </div>
                        @endif
                        @if($quoteRequest->budget_range)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <label class="block text-sm font-semibold text-slate-500 mb-1">Budget Range</label>
                                <p class="text-base text-slate-900">{{ $quoteRequest->budget_range }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Message, Preferences & Special Requests -->
            @if($message || $preferences || $specialRequests)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-900">Message, Preferences & Special Requests</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @if($message)
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Tell us about your project</label>
                            <p class="text-base text-slate-900 whitespace-pre-wrap">{{ $message }}</p>
                        </div>
                        @endif
                        @if($preferences)
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Preferences</label>
                            <p class="text-base text-slate-900 whitespace-pre-wrap">{{ $preferences }}</p>
                        </div>
                        @endif
                        @if($specialRequests)
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Special Requests</label>
                            <p class="text-base text-slate-900 whitespace-pre-wrap">{{ $specialRequests }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-900">Status</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <form action="{{ route('admin.quote-requests.update-status', $quoteRequest) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $quoteRequest->is_processed ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                    @if($quoteRequest->is_processed)
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Processed
                                    @else
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pending
                                    @endif
                                </button>
                            </form>
                            <p class="text-xs text-slate-500 mt-2 text-center">Click to toggle status</p>
                        </div>
                        <div class="pt-4 border-t border-slate-200">
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Submitted</label>
                            <p class="text-sm text-slate-900">{{ $quoteRequest->created_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-slate-500">{{ $quoteRequest->created_at->format('H:i') }}</p>
                        </div>
                        @if($quoteRequest->updated_at != $quoteRequest->created_at)
                        <div>
                            <label class="block text-sm font-semibold text-slate-500 mb-2">Last Updated</label>
                            <p class="text-sm text-slate-900">{{ $quoteRequest->updated_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-slate-500">{{ $quoteRequest->updated_at->format('H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-xl font-bold text-slate-900">Actions</h2>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.quote-requests.edit', $quoteRequest) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Request
                    </a>
                    <form action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
