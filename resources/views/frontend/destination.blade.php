<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Circuits {{ $destination->name }} - {{ $siteName }}</title>
    <meta name="description" content="{{ $destination->meta_description ?? $destination->description }}">

    @if($siteFaviconUrl ?? false)
        <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
        <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
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
        
        /* 2025 Responsive Standards */
        @media (max-width: 430px) {
            .mobile-text-sm { font-size: 0.875rem; }
            .mobile-spacing { padding-left: 1rem; padding-right: 1rem; }
        }
        
        @media (min-width: 768px) and (max-width: 1024px) {
            .tablet-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (min-width: 1280px) {
            .desktop-spacing { padding-left: 3rem; padding-right: 3rem; }
        }
        
        @media (min-width: 1440px) {
            .large-desktop-spacing { padding-left: 4rem; padding-right: 4rem; }
        }
        
        @media (min-width: 1920px) {
            .ultra-wide-spacing { padding-left: 5rem; padding-right: 5rem; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Dynamic Header -->
        <div id="header-container"></div>

        <!-- Page Content -->
        <main>
<!-- Hero Section -->
<section class="relative py-16 sm:py-20 lg:py-24 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 via-red-500/30 to-amber-500/20"></div>
    
    <!-- Content Container -->
    <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20 w-full">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Main Heading -->
            <div class="mb-6">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 leading-tight tracking-tight">
                    <span class="block text-white mb-2">Découvrez</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-red-500 to-amber-400">
                        {{ $destination->name }}
                    </span>
                </h1>
                <div class="w-20 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto rounded-full"></div>
            </div>
            
            <!-- Description -->
            <p class="text-lg sm:text-xl lg:text-2xl text-slate-200 mb-8 leading-relaxed max-w-3xl mx-auto font-light">
                {{ $destination->hero_description ?? $destination->description }}
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#circuits" class="group relative bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-4 rounded-xl font-semibold text-base transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-orange-500/25">
                    <span class="relative z-10 flex items-center">
                        Voir nos circuits
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-700 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('home') }}#devis" class="group flex items-center text-slate-300 hover:text-white transition-colors duration-200 text-base font-medium">
                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Demander un devis
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Circuits Section -->
<section id="circuits" class="py-16 sm:py-20 lg:py-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                Circuits <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Populaires</span>
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Découvrez nos circuits sur-mesure dans {{ $destination->name }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($circuits as $circuit)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="h-64 bg-gradient-to-br from-red-500 to-pink-600 relative overflow-hidden">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $circuit->name }}</h3>
                            <p class="text-sm opacity-90">{{ $circuit->duration_days }} jours</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            @if($circuit->price_from)
                                <span class="text-lg font-bold text-amber-600">€{{ number_format($circuit->price_from, 0, ',', ' ') }}</span>
                            @endif
                            <a href="{{ route('circuit', $circuit->slug) }}" class="text-sm font-medium text-slate-900 hover:text-amber-600 transition-colors duration-200">
                                Voir le circuit
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Aucun circuit disponible</h3>
                    <p class="text-slate-600">Il n'y a actuellement aucun circuit disponible pour cette destination.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

        </main>

        <!-- Dynamic Footer -->
        <div id="footer-container"></div>
    </div>

    <!-- Load Header and Footer -->
    <script src="/components/header.js"></script>
    <script src="/components/footer.js"></script>
</body>
</html>