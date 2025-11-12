@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Welcome back! Here\'s what\'s happening with your travel business.')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="group bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16"></div>
        <div class="relative flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-primary/20 to-primary/10 rounded-2xl shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Destinations</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['destinations'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="group bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16"></div>
        <div class="relative flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-green-100 to-green-50 rounded-2xl shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Circuits</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['circuits'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="group bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full -mr-16 -mt-16"></div>
        <div class="relative flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-amber-100 to-amber-50 rounded-2xl shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">Blog Posts</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['blogs'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="group bg-white rounded-2xl shadow-lg border border-slate-200/50 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16"></div>
        <div class="relative flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-red-100 to-red-50 rounded-2xl shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">New Requests</p>
                    <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['quote_requests'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Quick Actions -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <h2 class="text-xl font-bold text-slate-900">Quick Actions</h2>
                <p class="text-sm text-slate-600 mt-1">Manage your content and settings</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.destinations.index') }}" class="group relative p-5 border-2 border-slate-200 rounded-xl hover:border-primary hover:shadow-xl transition-all duration-300 bg-white hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center">
                            <div class="p-3 bg-gradient-to-br from-primary/20 to-primary/10 rounded-xl group-hover:from-primary/30 group-hover:to-primary/20 transition-all duration-300 shadow-sm group-hover:shadow-md">
                                <svg class="w-6 h-6 text-primary transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors duration-300">Manage Destinations</h3>
                                <p class="text-xs text-slate-500 mt-1">Add and edit travel destinations</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('admin.circuits.index') }}" class="group relative p-5 border-2 border-slate-200 rounded-xl hover:border-primary hover:shadow-xl transition-all duration-300 bg-white hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center">
                            <div class="p-3 bg-gradient-to-br from-green-100 to-green-50 rounded-xl group-hover:from-green-200 group-hover:to-green-100 transition-all duration-300 shadow-sm group-hover:shadow-md">
                                <svg class="w-6 h-6 text-green-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors duration-300">Manage Circuits</h3>
                                <p class="text-xs text-slate-500 mt-1">Create and organize travel circuits</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('admin.blogs.index') }}" class="group relative p-5 border-2 border-slate-200 rounded-xl hover:border-primary hover:shadow-xl transition-all duration-300 bg-white hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center">
                            <div class="p-3 bg-gradient-to-br from-amber-100 to-amber-50 rounded-xl group-hover:from-amber-200 group-hover:to-amber-100 transition-all duration-300 shadow-sm group-hover:shadow-md">
                                <svg class="w-6 h-6 text-amber-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors duration-300">Manage Blog Posts</h3>
                                <p class="text-xs text-slate-500 mt-1">Write and publish travel articles</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('admin.quote-requests.index') }}" class="group relative p-5 border-2 border-slate-200 rounded-xl hover:border-primary hover:shadow-xl transition-all duration-300 bg-white hover:-translate-y-1 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center">
                            <div class="p-3 bg-gradient-to-br from-red-100 to-red-50 rounded-xl group-hover:from-red-200 group-hover:to-red-100 transition-all duration-300 shadow-sm group-hover:shadow-md">
                                <svg class="w-6 h-6 text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-primary transition-colors duration-300">View Quote Requests</h3>
                                <p class="text-xs text-slate-500 mt-1">Manage customer inquiries</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                <h2 class="text-xl font-bold text-slate-900">Recent Activity</h2>
                <p class="text-sm text-slate-600 mt-1">Latest updates and changes</p>
            </div>
            <div class="p-6">
                <div class="space-y-5">
                    <div class="flex items-start space-x-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="w-3 h-3 bg-green-500 rounded-full mt-2 shadow-lg shadow-green-500/50"></div>
                            <div class="absolute inset-0 w-3 h-3 bg-green-500 rounded-full mt-2 animate-ping opacity-75"></div>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold text-slate-900 group-hover:text-primary transition-colors">System initialized</p>
                            <p class="text-xs text-slate-500 mt-1">Just now</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="w-3 h-3 bg-primary rounded-full mt-2 shadow-lg shadow-primary/50"></div>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold text-slate-900 group-hover:text-primary transition-colors">Admin panel updated</p>
                            <p class="text-xs text-slate-500 mt-1">A few minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="w-3 h-3 bg-amber-500 rounded-full mt-2 shadow-lg shadow-amber-500/50"></div>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold text-slate-900 group-hover:text-primary transition-colors">Frontend pages created</p>
                            <p class="text-xs text-slate-500 mt-1">Recently</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection