<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'India Tourisme')</title>
    <meta name="description" content="@yield('description', 'Voyages sur mesure en Inde, Sri Lanka, Népal et Bhoutan. Circuits privés, chauffeurs anglophones/francophones, assistance 24/7.')">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
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
        body { font-family: 'Inter', sans-serif; }
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
