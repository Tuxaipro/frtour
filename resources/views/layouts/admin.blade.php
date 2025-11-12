<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteName ?? 'Admin Panel' }} - Admin Panel</title>

    @if($siteFaviconUrl ?? false)
        <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
        <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @php
        $hasViteManifest = file_exists(public_path('build/manifest.json'));
    @endphp
    
    @if($hasViteManifest)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback for production without Vite build -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
            body { font-family: 'Inter', sans-serif; }
        </style>
    @endif
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Page Loader Styles */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999;
            transition: opacity 0.5s ease-out;
        }
        
        #page-loader.hide {
            opacity: 0;
            pointer-events: none;
        }
        
        .loader-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }
        
        .loader-dot {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            animation: bounce 1.4s ease-in-out infinite both;
        }
        
        .loader-dot:nth-child(1) {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            animation-delay: 0s;
        }
        
        .loader-dot:nth-child(2) {
            bottom: 0;
            left: 0;
            animation-delay: 0.16s;
        }
        
        .loader-dot:nth-child(3) {
            bottom: 0;
            right: 0;
            animation-delay: 0.32s;
        }
        
        @keyframes bounce {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        /* Enhanced Tooltip Styles */
        [title] {
            position: relative;
        }
        
        /* Native tooltip styling */
        [title]:hover::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 10px;
            background-color: rgba(0, 0, 0, 0.85);
            color: white;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            border-radius: 6px;
            pointer-events: none;
            z-index: 1000;
            margin-bottom: 8px;
            opacity: 0;
            animation: tooltipFadeIn 0.2s ease-out forwards;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        
        /* Arrow for tooltip */
        [title]:hover::before {
            content: '';
            position: absolute;
            bottom: calc(100% - 1px);
            left: 50%;
            transform: translateX(-50%);
            border: 6px solid transparent;
            border-top-color: rgba(0, 0, 0, 0.85);
            pointer-events: none;
            z-index: 1001;
            opacity: 0;
            animation: tooltipFadeIn 0.2s ease-out forwards;
            animation-delay: 0.05s;
        }
        
        @keyframes tooltipFadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(4px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-container">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>
    </div>

    <script>
        // Page Loader - Hide loader when page is fully loaded
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('page-loader');
                if (loader) {
                    loader.classList.add('hide');
                    // Remove loader from DOM after animation completes
                    setTimeout(function() {
                        loader.remove();
                    }, 500);
                }
            }, 300); // Minimum display time for loader
        });
    </script>
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-primary shadow-2xl border-r border-primary-dark/30">
            <!-- Logo -->
            <div class="p-6 border-b border-primary-dark/30 bg-primary-dark/20">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-all duration-300 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white tracking-tight">{{ $siteName ?? 'Admin Panel' }}</h1>
                        <p class="text-xs text-white font-medium">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-3">
                <div class="space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.destinations.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.destinations.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Destinations
                    </a>
                    
                    <a href="{{ route('admin.circuits.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.circuits.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Circuits
                    </a>
                    
                    <a href="{{ route('admin.blogs.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.blogs.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Blog Posts
                    </a>
                    
                    <a href="{{ route('admin.pages.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.pages.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Pages
                    </a>
                    
                <a href="{{ route('admin.heroes.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.heroes.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                    <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Hero Sections
                </a>
                    
                    <a href="{{ route('admin.galerie.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.galerie.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Galerie
                    </a>
                    
                    <a href="{{ route('admin.galerie-category.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.galerie-category.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Galerie Categories
                    </a>
                    
                    <a href="{{ route('admin.faq.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.faq.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        FAQ
                    </a>
                    
                    <a href="{{ route('admin.reviews.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.reviews.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Reviews
                    </a>
                    
                    <a href="{{ route('admin.contacts.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.contacts.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Messages de contact
                    </a>
                    
                    <a href="{{ route('admin.quote-requests.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.quote-requests.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Quote Requests
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-200 text-white {{ request()->routeIs('admin.settings.*') ? 'bg-white/20 shadow-lg' : 'hover:bg-white/10' }}">
                        <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </div>
            </nav>

        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-primary shadow-lg border-b border-primary-dark/30">
                <div class="px-8 py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-white tracking-tight">@yield('title', 'Dashboard')</h1>
                            @hasSection('subtitle')
                                <p class="text-sm text-white mt-1.5 font-medium">@yield('subtitle')</p>
                            @endif
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-white/10 border border-white/20 rounded-xl hover:bg-white/20 hover:shadow-lg transition-all duration-200 backdrop-blur-sm group">
                                <svg class="w-4 h-4 mr-2 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                View Site
                            </a>
                            
                            <!-- User Profile Dropdown -->
                            <div class="relative" id="user-dropdown">
                                <button onclick="toggleUserDropdown()" class="flex items-center space-x-3 p-2.5 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-all duration-200 shadow-md">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-white font-medium">{{ Auth::user()->email }}</p>
                                    </div>
                                    <svg class="w-4 h-4 text-white transition-transform duration-200 group-hover:text-white" id="dropdown-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                
                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-slate-200/50 opacity-0 invisible transition-all duration-300 z-50 backdrop-blur-sm" id="user-dropdown-menu">
                                    <div class="py-2">
                                        <div class="px-5 py-3 border-b border-slate-100 bg-slate-50/50">
                                            <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-slate-600 mt-0.5">{{ Auth::user()->email }}</p>
                                        </div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-5 py-3 text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200 flex items-center rounded-lg mx-2 my-1">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 bg-slate-50">
                <div class="p-6 pb-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            
            if (dropdown.classList.contains('opacity-0')) {
                // Show dropdown
                dropdown.classList.remove('opacity-0', 'invisible');
                dropdown.classList.add('opacity-100', 'visible');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                // Hide dropdown
                dropdown.classList.add('opacity-0', 'invisible');
                dropdown.classList.remove('opacity-100', 'visible');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('user-dropdown');
            const dropdownMenu = document.getElementById('user-dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            
            if (!dropdown.contains(event.target)) {
                dropdownMenu.classList.add('opacity-0', 'invisible');
                dropdownMenu.classList.remove('opacity-100', 'visible');
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    </script>
</body>
</html>