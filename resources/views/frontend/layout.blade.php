<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', setting('site_name', config('app.name', 'Laravel'))) - {{ setting('site_name', config('app.name', 'Laravel')) }}</title>

    <meta name="description" content="@yield('meta_description', setting('meta_description', 'Travel website'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
        @include('frontend.partials.header')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('frontend.partials.footer')
    </div>
</body>
</html>