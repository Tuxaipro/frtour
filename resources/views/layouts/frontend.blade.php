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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
                        primary: {
                            DEFAULT: 'hsl(201, 96%, 32%)',
                            light: 'hsl(201, 96%, 42%)',
                            dark: 'hsl(201, 96%, 22%)',
                            50: 'hsl(201, 96%, 95%)',
                            100: 'hsl(201, 96%, 90%)',
                            500: 'hsl(201, 96%, 32%)',
                            600: 'hsl(201, 96%, 22%)',
                        },
                        accent: {
                            DEFAULT: 'hsl(142, 71%, 45%)',
                            light: 'hsl(142, 71%, 55%)',
                            dark: 'hsl(142, 71%, 35%)',
                            50: 'hsl(142, 71%, 95%)',
                            500: 'hsl(142, 71%, 45%)',
                        },
                        sunset: {
                            DEFAULT: 'hsl(25, 95%, 53%)',
                            light: 'hsl(25, 95%, 63%)',
                            dark: 'hsl(25, 95%, 43%)',
                        },
                        sand: {
                            DEFAULT: 'hsl(45, 55%, 85%)',
                            light: 'hsl(45, 55%, 95%)',
                            dark: 'hsl(45, 55%, 75%)',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>
    @endif
    <style>
        html { scroll-behavior: smooth; }
        
        /* Scroll Offset */
        section[id] { scroll-margin-top: 5rem; }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, hsl(201, 96%, 32%), hsl(142, 71%, 45%));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Card Hover Effects */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Image Zoom Effect */
        .img-zoom {
            overflow: hidden;
        }
        
        .img-zoom img {
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .img-zoom:hover img {
            transform: scale(1.1);
        }
        
        /* Fade In On Scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Button Shimmer Effect */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        
        .btn-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-shimmer:hover::before {
            left: 100%;
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
<body class="bg-white text-slate-900 font-sans antialiased">
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

    <!-- Navigation -->
    @php
        include resource_path('views/includes/navigation.php');
    @endphp

    <!-- Main Content -->
    <main class="overflow-hidden min-h-screen">
        @yield('content')
    </main>

    <!-- Footer Container -->
    <div id="footer-container"></div>

    <!-- Scripts -->
    <script src="/components/footer.js"></script>
    <script>
        // Load footer
        document.addEventListener('DOMContentLoaded', function() {
            loadFooter();
            
            // Fade In On Scroll
            const fadeElements = document.querySelectorAll('.fade-in');
            const fadeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            fadeElements.forEach(el => fadeObserver.observe(el));
        });
    </script>
    
    @yield('scripts')
</body>
</html>
