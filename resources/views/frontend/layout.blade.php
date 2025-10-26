<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $metaTitle)</title>

    <meta name="description" content="@yield('meta_description', $metaDescription)">
    
    @if($siteFaviconUrl)
        <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        'primary-dark': '#1E40AF',
                        'primary-light': '#DBEAFE'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        html { scroll-behavior: smooth; }
        
        /* Enhanced sticky header with backdrop blur */
        .sticky-header {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }
        
        /* Scroll offset for anchor links */
        section[id] {
            scroll-margin-top: 4rem;
        }
        
        /* Smooth transitions for navigation */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #3B82F6;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Ensure sticky positioning works */
        nav {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 50 !important;
        }
        
        /* 2025 Responsive Standards */
        @media (max-width: 430px) {
            /* Mobile phones optimization */
            .mobile-text-sm { font-size: 0.875rem; }
            .mobile-spacing { padding-left: 1rem; padding-right: 1rem; }
        }
        
        @media (min-width: 768px) and (max-width: 1024px) {
            /* Tablet optimization */
            .tablet-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (min-width: 1280px) {
            /* Small laptop optimization */
            .desktop-spacing { padding-left: 3rem; padding-right: 3rem; }
        }
        
        @media (min-width: 1440px) {
            /* Standard desktop optimization */
            .large-desktop-spacing { padding-left: 4rem; padding-right: 4rem; }
        }
        
        @media (min-width: 1920px) {
            /* Large desktop/wide monitor optimization */
            .ultra-wide-spacing { padding-left: 5rem; padding-right: 5rem; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div style="position: sticky !important; top: 0 !important; z-index: 50 !important; width: 100% !important;">
            @include('frontend.partials.header')
        </div>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('frontend.partials.footer')
    </div>
</body>
</html>