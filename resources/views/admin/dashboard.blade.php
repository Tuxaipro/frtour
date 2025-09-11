@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Welcome back! Here\'s what\'s happening with your travel business.')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-600">Destinations</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['destinations'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-600">Circuits</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['circuits'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 bg-amber-100 rounded-lg">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-600">Blog Posts</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['blogs'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-lg">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-slate-600">New Requests</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['quote_requests'] ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Quick Actions -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Quick Actions</h2>
                <p class="text-sm text-slate-500">Manage your content and settings</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.destinations.index') }}" class="group p-4 border border-slate-200 rounded-lg hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-primary group-hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-slate-900 group-hover:text-primary">Manage Destinations</h3>
                                <p class="text-xs text-slate-500">Add and edit travel destinations</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.circuits.index') }}" class="group p-4 border border-slate-200 rounded-lg hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg group-hover:bg-primary group-hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-slate-900 group-hover:text-primary">Manage Circuits</h3>
                                <p class="text-xs text-slate-500">Create and organize travel circuits</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.blogs.index') }}" class="group p-4 border border-slate-200 rounded-lg hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-amber-100 rounded-lg group-hover:bg-primary group-hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5 text-amber-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-slate-900 group-hover:text-primary">Manage Blog Posts</h3>
                                <p class="text-xs text-slate-500">Write and publish travel articles</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.quote-requests.index') }}" class="group p-4 border border-slate-200 rounded-lg hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center">
                            <div class="p-2 bg-red-100 rounded-lg group-hover:bg-primary group-hover:text-white transition-colors duration-200">
                                <svg class="w-5 h-5 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-slate-900 group-hover:text-primary">View Quote Requests</h3>
                                <p class="text-xs text-slate-500">Manage customer inquiries</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Recent Activity</h2>
                <p class="text-sm text-slate-500">Latest updates and changes</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900">System initialized</p>
                            <p class="text-xs text-slate-500">Just now</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900">Admin panel updated</p>
                            <p class="text-xs text-slate-500">A few minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-amber-400 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-slate-900">Frontend pages created</p>
                            <p class="text-xs text-slate-500">Recently</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection