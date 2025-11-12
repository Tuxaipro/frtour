<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $metaTitle)</title>
    <meta name="description" content="@yield('description', $metaDescription)">
    @if($siteFaviconUrl)
        <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS via Vite -->
    @php
        $hasViteManifest = file_exists(public_path('build/manifest.json'));
    @endphp
    
    @if($hasViteManifest)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback for development without Vite build - should not be used in production -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'hsl(220, 70%, 25%)',
                        'primary-dark': 'hsl(220, 70%, 20%)',
                        'primary-light': 'hsl(220, 60%, 35%)',
                        accent: 'hsl(75, 45%, 40%)',
                        'accent-light': 'hsl(80, 50%, 45%)',
                        background: 'hsl(0, 0%, 98%)',
                        foreground: 'hsl(215, 25%, 27%)'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    @endif
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        
        /* Smooth scrolling for anchor links */
        html {
            scroll-behavior: smooth;
        }
        
        /* Enhanced sticky header with backdrop blur */
        .sticky-header {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }
        
        /* Ensure sticky positioning works for galerie page */
        #header-container {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 50 !important;
            width: 100% !important;
        }
        
        #header-container > nav {
            position: -webkit-sticky !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 50 !important;
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
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

    <!-- Header Container -->
    <div id="header-container"></div>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Container -->
    <div id="footer-container"></div>

    <!-- Scripts -->
    <script src="/components/header.js"></script>
    <script src="/components/footer.js"></script>
    
    @yield('scripts')
</body>
</html>
