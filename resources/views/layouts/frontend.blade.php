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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    </style>
</head>
<body class="bg-slate-50">
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
