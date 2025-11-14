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

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }
        
        /* Gradient Text Effect */
        .gradient-text {
            background: linear-gradient(135deg, hsl(201, 96%, 32%), hsl(142, 71%, 45%));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Ensure sticky positioning works */
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
<body class="bg-white text-slate-900 font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        @php
          include resource_path('views/includes/navigation.php');
        @endphp

        <!-- Page Content -->
        <main>
<!-- Hero Section -->
@php
    // Get the slug from the current URL to ensure we load the correct destination
    $currentSlug = request()->route('slug');
    
    // Force fresh data - reload destination by slug to avoid any variable conflicts
    $currentDestination = \App\Models\Destination::where('slug', $currentSlug)
        ->where('is_active', true)
        ->first();
    
    // Fallback to the passed destination if slug lookup fails
    if (!$currentDestination) {
        $currentDestination = $destination;
    }
    
    // Ensure we have the latest data
    $currentDestination->refresh();
    
    $heroBackground = !empty($currentDestination->cover_image) ? asset('storage/' . $currentDestination->cover_image) : null;
    $heroTitle = !empty($currentDestination->hero_title) ? $currentDestination->hero_title : $currentDestination->name;
    $heroDescription = !empty($currentDestination->hero_description) ? $currentDestination->hero_description : ($currentDestination->description ?? '');
@endphp
<section class="relative py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-primary via-primary-dark to-accent min-h-[500px] flex items-center justify-center overflow-hidden">
    @if($heroBackground)
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $heroBackground }}?v={{ $currentDestination->updated_at->timestamp }}" 
             alt="{{ $currentDestination->name }}" 
             class="w-full h-full object-cover"
             style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>
    @endif
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 z-10 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    
    <!-- Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto fade-in">
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
                {{ $heroTitle }}
            </h1>
            @if(!empty($heroDescription))
            <p class="text-xl text-white/90 max-w-3xl mx-auto font-light leading-relaxed">
                {{ $heroDescription }}
            </p>
            @endif
        </div>
    </div>
</section>


<!-- Circuits Section -->
<section id="circuits" class="py-16 sm:py-20 lg:py-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($circuits as $circuit)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="h-48 relative overflow-hidden">
                        @if($circuit->featured_image)
                            <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="h-full bg-gradient-to-br from-red-500 to-pink-600">
                                <div class="absolute inset-0 bg-black/20"></div>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold mb-1">{{ $circuit->name }}</h3>
                            <p class="text-sm text-white/90">{{ $circuit->duration_days }} jours</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 mb-4">
                            @if($circuit->description)
                                <p class="text-slate-600 text-sm line-clamp-2">{{ Str::limit($circuit->description, 80) }}</p>
                            @endif
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            @if($circuit->price_from)
                                <span class="text-lg font-bold text-amber-600">€{{ number_format($circuit->price_from, 0, ',', ' ') }}</span>
                            @endif
                            <a href="{{ route('circuit', $circuit->slug) }}" class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg transition-colors duration-200 text-sm">
                                Voir les détails
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        @if($circuit->tags)
                          @php
                            $circuitTags = explode(',', $circuit->tags);
                            $circuitTags = array_map('trim', $circuitTags);
                            $circuitTags = array_slice($circuitTags, 0, 3);
                            $colors = ['bg-blue-100 text-blue-700', 'bg-green-100 text-green-700', 'bg-amber-100 text-amber-700'];
                          @endphp
                          <div class="flex flex-wrap gap-2 mt-4">
                            @foreach($circuitTags as $index => $tag)
                              @php
                                $colorClass = $colors[$index % count($colors)];
                              @endphp
                              <span class="px-2 py-1 {{ $colorClass }} text-xs font-medium rounded-full">{{ $tag }}</span>
                            @endforeach
                          </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <h3 class="text-2xl font-display font-bold text-slate-900 mb-4">Aucun circuit disponible</h3>
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

    <!-- Load Footer -->
    <script src="/components/footer.js"></script>
</body>
</html>