<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $circuit->name }} — {{ $siteName }}</title>
  <meta name="description" content="{{ Str::limit($circuit->description, 160) }}">
  
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
    $heroBackground = $circuit->featured_image ? asset('storage/' . $circuit->featured_image) : null;
    $heroOverlay = $circuit->featured_image ? 'rgba(0, 0, 0, 0.5)' : 'rgba(0, 0, 0, 0.1)';
@endphp
<section class="relative py-16 sm:py-20 lg:py-32 text-white overflow-hidden" style="background-color: hsl(220, 70%, 25%); min-height: 500px;">
    @if($heroBackground)
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $heroBackground }}" alt="{{ $circuit->name }}" class="w-full h-full object-cover" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
    </div>
    @endif
    
    <!-- Background Pattern -->
    <div class="absolute inset-0 z-10 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 z-20" style="background-color: {{ $heroOverlay }};"></div>
    
    <!-- Content Container -->
    <div class="relative z-30 max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20 w-full">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            @if($circuit->destination)
            <nav class="flex items-center space-x-2 text-sm sm:text-base mb-6 text-white/80">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a>
                <span>/</span>
                <a href="{{ route('destination', $circuit->destination->slug) }}" class="hover:text-white transition-colors">{{ $circuit->destination->name }}</a>
                <span>/</span>
                <span class="text-white font-medium">{{ $circuit->name }}</span>
            </nav>
            @endif
            
            <!-- Main Heading -->
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold mb-6 leading-tight text-white">
                {{ $circuit->name }}
            </h1>
            
            <!-- Circuit Info -->
            <div class="flex flex-wrap gap-4 mb-8">
                <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $circuit->duration_days }} jours</span>
                </div>
                
                @if($circuit->price_from)
                <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>À partir de €{{ number_format($circuit->price_from, 0, ',', ' ') }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Circuit Details -->
<section class="py-16 sm:py-20 lg:py-24">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                @if($circuit->description)
                <div class="prose max-w-none mb-12">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">Description du circuit</h2>
                    <div class="text-slate-600 text-lg leading-relaxed">
                        {!! nl2br(e($circuit->description)) !!}
                    </div>
                </div>
                @endif
                
                @if($circuit->highlights)
                <div class="mb-12">
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">Points forts</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $highlights = explode("\n", $circuit->highlights);
                        @endphp
                        @foreach($highlights as $highlight)
                            @if(trim($highlight))
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-amber-500 to-red-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="ml-4 text-slate-600">{{ trim($highlight) }}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($circuit->itinerary)
                <div>
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">Itinéraire détaillé</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($circuit->itinerary)) !!}
                    </div>
                </div>
                @endif
            </div>
            
            <div>
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                    @if($circuit->featured_image)
                    <div class="mb-6 -mt-6 -mx-6">
                        <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-full h-48 object-cover">
                    </div>
                    @endif
                    <h3 class="text-2xl font-display font-bold text-slate-900 mb-6">Résumé du circuit</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between py-3 border-b border-slate-100">
                            <span class="text-slate-600">Destination</span>
                            <span class="font-medium">{{ $circuit->destination->name }}</span>
                        </div>
                        
                        <div class="flex justify-between py-3 border-b border-slate-100">
                            <span class="text-slate-600">Durée</span>
                            <span class="font-medium">{{ $circuit->duration_days }} jours</span>
                        </div>
                        
                        @if($circuit->price_from)
                        <div class="flex justify-between py-3 border-b border-slate-100">
                            <span class="text-slate-600">Prix à partir de</span>
                            <span class="font-medium text-lg text-amber-600">€{{ number_format($circuit->price_from, 0, ',', ' ') }}</span>
                        </div>
                        @endif
                    </div>
                    
                    
                    <p class="text-xs text-slate-500 text-center mt-4">
                        Prix indicatif - Nous vous proposons un devis personnalisé
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Circuits -->
<section class="py-16 sm:py-20 lg:py-24 bg-slate-50">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
                Autres circuits en <span class="gradient-text">{{ $circuit->destination->name }}</span>
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                Découvrez nos autres circuits sur-mesure dans cette destination
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $relatedCircuits = \App\Models\Circuit::where('destination_id', $circuit->destination_id)
                    ->where('id', '!=', $circuit->id)
                    ->where('is_active', true)
                    ->take(3)
                    ->get();
            @endphp
            
            @forelse($relatedCircuits as $relatedCircuit)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="h-64 relative overflow-hidden">
                        @if($relatedCircuit->featured_image)
                            <img src="{{ asset('storage/' . $relatedCircuit->featured_image) }}" alt="{{ $relatedCircuit->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="h-full bg-gradient-to-br from-red-500 to-pink-600">
                                <div class="absolute inset-0 bg-black/20"></div>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $relatedCircuit->name }}</h3>
                            <p class="text-sm opacity-90">{{ $relatedCircuit->duration_days }} jours</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            @if($relatedCircuit->price_from)
                                <span class="text-lg font-bold text-amber-600">€{{ number_format($relatedCircuit->price_from, 0, ',', ' ') }}</span>
                            @endif
                            <a href="{{ route('circuit', $relatedCircuit->slug) }}" class="text-sm font-medium text-slate-900 hover:text-amber-600 transition-colors duration-200">
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
                    <p class="text-slate-600 text-lg">Aucun autre circuit disponible dans cette destination pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
    </main>

    <!-- Footer -->
    <div id="footer-container"></div>
  </div>

  <!-- Load Footer -->
  <script src="/components/footer.js"></script>
</body>
</html>