<!doctype html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Additional SEO -->
  <meta name="author" content="{{ $siteName }}">
  <meta name="language" content="French">
  <meta name="revisit-after" content="7 days">
  <meta name="theme-color" content="hsl(201, 96%, 32%)">
  <meta name="msapplication-TileColor" content="hsl(201, 96%, 32%)">
  
  <!-- Dynamic SEO from settings -->
  <title>{{ $metaTitle }}</title>
  <meta name="description" content="{{ $metaDescription }}">
  @if($siteFaviconUrl)
    <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
    <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
  @else
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
  @endif
  <link rel="manifest" href="/site.webmanifest">
  
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
    /* Smooth Scrolling */
    html { scroll-behavior: smooth; }
    
    /* Scroll Offset */
    section[id] { scroll-margin-top: 5rem; }
    
    /* Navigation Link Effect */
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
      transform: translateY(-12px);
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
    
    /* Parallax Background */
    .parallax-bg {
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: hsl(201, 96%, 32%);
      border-radius: 5px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: hsl(201, 96%, 22%);
    }
    
    /* Responsive Navigation - Force hide/show elements */
    @media (min-width: 1024px) {
      /* Hide mobile menu elements on desktop */
      #mobile-menu-button-wrapper {
        display: none !important;
      }
      #mobile-menu {
        display: none !important;
      }
    }
    
    @media (max-width: 1023px) {
      /* Hide desktop menu on mobile/tablet */
      nav .hidden.lg\\:flex {
        display: none !important;
      }
    }
    
    /* Form Steps Transition */
    .form-step {
      transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }
    
    .form-step.hidden {
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
    }
    
    .form-step:not(.hidden) {
      opacity: 1;
      visibility: visible;
      pointer-events: auto;
    }
    
    /* Form Steps Scrollbar */
    .form-step .overflow-y-auto {
      scrollbar-width: thin;
      scrollbar-color: hsl(201, 96%, 32%) transparent;
    }
    
    .form-step .overflow-y-auto::-webkit-scrollbar {
      width: 6px;
    }
    
    .form-step .overflow-y-auto::-webkit-scrollbar-track {
      background: transparent;
    }
    
    .form-step .overflow-y-auto::-webkit-scrollbar-thumb {
      background-color: hsl(201, 96%, 32%);
      border-radius: 3px;
    }
    
    .form-step .overflow-y-auto::-webkit-scrollbar-thumb:hover {
      background-color: hsl(201, 96%, 22%);
    }
    
    /* Step 2 Form Field Spacing Fix */
    #step-2 label {
      display: block;
      word-wrap: break-word;
      overflow-wrap: break-word;
      hyphens: auto;
      line-height: 1.4;
      margin-bottom: 0.5rem;
    }
    
    #step-2 .flex.flex-col {
      min-width: 0;
      width: 100%;
    }
    
    #step-2 input,
    #step-2 select,
    #step-2 textarea {
      width: 100%;
      box-sizing: border-box;
    }
    
    @media (min-width: 1280px) {
      #step-2 .grid.grid-cols-1.sm\\:grid-cols-2.xl\\:grid-cols-4 > div {
        min-width: 0;
      }
    }
  </style>
</head>
<body class="bg-white text-slate-900 font-sans antialiased">
  
  <!-- Navigation -->
  @php
    include resource_path('views/includes/navigation.php');
  @endphp
  
  <main class="overflow-hidden">
    
    <!-- Hero Section -->
    @if($heroes->count() > 0)
      <x-hero.carousel :heroes="$heroes" />
    @else
      <!-- Default Hero Fallback -->
      <section class="relative flex items-center justify-center overflow-hidden min-h-[500px]">
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-dark to-accent opacity-90"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium text-sm mb-6">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            DMC certifié ISO 9001:2015
          </div>
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white leading-tight mb-4">
            Votre spécialiste des<br>voyages en Inde
          </h1>
          <p class="text-lg sm:text-xl text-white/90 mb-8 max-w-3xl mx-auto font-light">
            Découvrez l'authenticité de l'Inde avec nos circuits sur mesure et nos guides locaux expérimentés.
          </p>
          <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#devis" class="inline-flex items-center justify-center px-6 py-3 bg-white text-primary rounded-xl font-semibold text-base hover:bg-slate-100 transition-all duration-300 shadow-2xl hover:shadow-3xl btn-shimmer">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Demander un Devis Gratuit
            </a>
            <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 rounded-xl font-semibold text-base hover:bg-white/20 transition-all duration-300">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              Contactez-nous
            </a>
          </div>
        </div>
      </section>
    @endif
    
    <!-- Featured Destinations Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Explorez l'Inde
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            Destinations <span class="gradient-text">populaires</span>
          </h2>
          <p class="text-lg text-slate-600 max-w-3xl mx-auto">
            Découvrez les trésors cachés et les lieux incontournables de l'Inde
          </p>
        </div>
        
        <!-- Destinations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
          @foreach($destinations->take(6) as $destination)
          <a href="{{ route('destination', $destination->slug) }}" class="group card-hover">
            <div class="relative overflow-hidden rounded-3xl shadow-xl bg-slate-900 h-[400px]">
              <!-- Image with Overlay -->
              <div class="absolute inset-0 img-zoom">
                @if($destination->cover_image)
                  <img src="{{ asset('storage/' . $destination->cover_image) }}" alt="{{ $destination->name }}" class="w-full h-full object-cover" loading="lazy">
                @else
                  <div class="w-full h-full bg-gradient-to-br from-primary to-accent"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
              </div>
              
              <!-- Content -->
              <div class="absolute inset-0 p-8 flex flex-col justify-end">
                <div class="transform transition-transform duration-300 group-hover:translate-y-[-8px]">
                  <h3 class="text-3xl font-display font-bold text-white mb-2">{{ $destination->name }}</h3>
                  <p class="text-white/80 text-sm mb-4 line-clamp-2">{{ Str::limit($destination->description, 100) }}</p>
                  <div class="inline-flex items-center text-white font-semibold">
                    <span>Découvrir</span>
                    <svg class="w-5 h-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
        </div>
        
        <!-- View All Link -->
        <div class="text-center mt-8 fade-in">
          <a href="/destinations" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-xl font-semibold text-base hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
            Voir toutes les destinations
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
        
      </div>
    </section>
    
    <!-- Why Choose Us Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-slate-50 via-white to-primary-50/30">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
            </svg>
            Pourquoi nous choisir
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            Votre voyage de rêve, <span class="gradient-text">notre expertise</span>
          </h2>
          <p class="text-lg text-slate-600 max-w-3xl mx-auto">
            Nous nous engageons à créer des expériences de voyage inoubliables et authentiques
          </p>
        </div>
        
        <!-- Benefits Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
          
          <!-- Benefit 1 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">Agence certifiée</h3>
            <p class="text-slate-600 leading-relaxed">Membre certifié de l'IATO et agréée par le ministère du tourisme indien. Votre sécurité est notre priorité.</p>
          </div>
          
          <!-- Benefit 2 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-accent to-accent-dark rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Guides experts locaux</h3>
            <p class="text-slate-600 leading-relaxed">Des guides francophones passionnés qui partagent leur culture et leurs connaissances approfondies.</p>
          </div>
          
          <!-- Benefit 3 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-sunset to-sunset-dark rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">100% sur mesure</h3>
            <p class="text-slate-600 leading-relaxed">Chaque itinéraire est personnalisé selon vos envies, votre budget et vos centres d'intérêt.</p>
          </div>
          
          <!-- Benefit 4 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-dark rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Meilleur rapport qualité-prix</h3>
            <p class="text-slate-600 leading-relaxed">Nos tarifs directs et transparents vous garantissent le meilleur prix pour votre voyage.</p>
          </div>
          
          <!-- Benefit 5 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-primary to-accent rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Assistance 24/7</h3>
            <p class="text-slate-600 leading-relaxed">Une équipe dédiée à votre disposition pendant tout votre voyage pour une tranquillité totale.</p>
          </div>
          
          <!-- Benefit 6 -->
          <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8 hover:shadow-2xl transition-all duration-300 group">
            <div class="w-16 h-16 bg-gradient-to-br from-accent-dark to-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Expériences authentiques</h3>
            <p class="text-slate-600 leading-relaxed">Rencontres locales, artisanat, cuisine... Vivez l'Inde comme un véritable voyageur.</p>
          </div>
          
        </div>
        
      </div>
    </section>
    
    <!-- Reviews Carousel Section -->
    @if($reviews->count() > 0)
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-slate-50 to-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            Témoignages
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            Ce que disent nos <span class="gradient-text">clients</span>
          </h2>
          
          <!-- Overall Rating -->
          @php
            $avgRating = $reviews->avg('rating');
            $totalReviews = '500+';
          @endphp
          <div class="flex items-center justify-center gap-3 flex-wrap mb-4">
            <div class="flex items-center gap-1">
              @for($i = 1; $i <= 5; $i++)
                <svg class="w-6 h-6 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
              @endfor
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ number_format($avgRating, 1) }}/5</p>
            <span class="text-slate-400">•</span>
            <p class="text-slate-600 font-medium">Basé sur {{ $totalReviews }} avis vérifiés</p>
          </div>
        </div>
        
        <!-- Reviews Carousel -->
        <div class="relative">
          <div class="reviews-carousel-container overflow-hidden">
            <div class="reviews-carousel-wrapper">
              <div class="reviews-carousel-track flex transition-transform duration-500 ease-out">
                @foreach($reviews as $review)
                  <div class="reviews-carousel-slide flex-shrink-0 px-3">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 h-full flex flex-col hover:shadow-2xl transition-all duration-300">
                      <!-- Rating Stars -->
                      <div class="flex items-center gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                          <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                          </svg>
                        @endfor
                      </div>
                      
                      <!-- Review Text -->
                      <p class="text-slate-700 leading-relaxed mb-6 flex-grow text-base">
                        "{{ $review->comment }}"
                      </p>
                      
                      <!-- Reviewer Info -->
                      <div class="flex items-center pt-6 border-t border-slate-200">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center text-white font-bold text-lg mr-4 flex-shrink-0 shadow-md">
                          {{ $review->avatar_initials }}
                        </div>
                        <div class="flex-1 min-w-0">
                          <p class="font-bold text-slate-900 text-base truncate">{{ $review->name }}</p>
                          @if($review->circuit)
                            <p class="text-sm text-primary truncate">{{ $review->circuit }}</p>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          
          <!-- Navigation Buttons -->
          @if($reviews->count() > 3)
          <div class="flex justify-center gap-4 mt-6">
            <button onclick="prevReviewSlide()" class="w-12 h-12 rounded-full bg-white border-2 border-slate-200 flex items-center justify-center hover:border-primary hover:text-primary hover:bg-primary-50 transition-all duration-300 shadow-md hover:shadow-lg">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>
            <button onclick="nextReviewSlide()" class="w-12 h-12 rounded-full bg-white border-2 border-slate-200 flex items-center justify-center hover:border-primary hover:text-primary hover:bg-primary-50 transition-all duration-300 shadow-md hover:shadow-lg">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
          @endif
        </div>
        
      </div>
    </section>
    @endif
    
    <!-- Quote Form Section -->
    <section id="devis" class="pt-12 sm:pt-16 lg:pt-20 pb-6 sm:pb-8 lg:pb-10 bg-gradient-to-br from-primary via-primary-dark to-primary-600 parallax-bg scroll-mt-20 relative overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
      
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-5 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Gratuit et sans engagement
          </div>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-white mb-4">
            Demandez votre devis personnalisé
          </h2>
          <p class="text-lg text-white/90 max-w-2xl mx-auto font-light">
            Recevez une proposition sur-mesure adaptée à vos envies et votre budget
          </p>
        </div>
        
        <!-- Quote Form -->
        <div class="max-w-4xl mx-auto">
          <div class="fade-in">
            <div class="bg-white rounded-2xl shadow-2xl pt-4 lg:pt-5 px-4 lg:px-5 pb-2 lg:pb-2 border border-slate-100 flex flex-col">
          <form action="{{ route('quote-requests.store') }}" method="POST" id="quoteForm" class="flex flex-col">
            @csrf
            
            <!-- Form Content Container -->
            <div class="flex flex-col flex-1">
              <!-- Step Indicator with Labels -->
              <div class="mt-3 mb-3">
                <div class="flex items-center justify-between mb-1">
                  <div class="flex items-center flex-1">
                    <div class="flex flex-col items-center flex-1">
                      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary text-white font-bold text-xs step-indicator shadow-lg" data-step="1">1</div>
                      <span class="text-xs font-semibold text-slate-600 mt-1.5 hidden sm:block">Coordonnées</span>
                    </div>
                    <div class="flex-1 h-1 bg-primary mx-2 max-w-[50px]"></div>
                    <div class="flex flex-col items-center flex-1">
                      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 text-slate-600 font-bold text-xs step-indicator" data-step="2">2</div>
                      <span class="text-xs font-semibold text-slate-600 mt-1.5 hidden sm:block">Voyage</span>
                    </div>
                    <div class="flex-1 h-1 bg-slate-200 mx-2 max-w-[50px]"></div>
                    <div class="flex flex-col items-center flex-1">
                      <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 text-slate-600 font-bold text-xs step-indicator" data-step="3">3</div>
                      <span class="text-xs font-semibold text-slate-600 mt-1.5 hidden sm:block">Message</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Form Steps Container - Fixed Height -->
              <div class="relative flex-1 min-h-[400px] overflow-hidden">
              <!-- Step 1: Personal Info -->
              <div id="step-1" class="form-step absolute inset-0 w-full flex flex-col">
                <div class="flex-1 overflow-y-auto px-1">
                  <h3 class="text-lg font-bold text-slate-900 mb-3 pb-1.5 border-b border-slate-200">Vos coordonnées</h3>
                  <div class="space-y-3 mb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div>
                        <label for="first_name" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Prénom *</label>
                        <input type="text" id="first_name" name="first_name" required class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                      <div>
                        <label for="last_name" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Nom de famille</label>
                        <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                      <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Email *</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                      <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Téléphone *</label>
                        <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                      <div>
                        <label for="country" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Pays</label>
                        <input type="text" id="country" name="country" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                    </div>
                  </div>
                  <div class="bg-primary-50 border-l-4 border-primary rounded-lg p-2.5">
                    <div class="flex items-start">
                      <svg class="w-4 h-4 text-primary flex-shrink-0 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <p class="text-xs text-slate-700 leading-relaxed font-sans">
                        <strong class="font-sans">Astuce :</strong> Vos informations sont sécurisées et ne seront utilisées que pour vous contacter concernant votre demande de devis.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="flex justify-end mt-2 pt-2 border-t border-slate-100 bg-white flex-shrink-0">
                  <button type="button" onclick="nextFormStep()" class="px-5 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition-all duration-300 shadow-md hover:shadow-lg btn-shimmer text-sm flex items-center">
                    Suivant
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                </div>
              </div>
              
              <!-- Step 2: Trip Details -->
              <div id="step-2" class="form-step hidden absolute inset-0 w-full flex flex-col">
                <div class="flex-1 px-4 sm:px-6 flex flex-col">
                  <h3 class="text-lg font-bold text-slate-900 mb-3 pb-2 border-b border-slate-200">Détails du voyage</h3>
                  <div class="space-y-3 flex-1 flex flex-col">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div>
                        <label for="budget" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans leading-tight">Budget estimé (par personne)</label>
                        <select id="budget" name="budget" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 bg-white font-sans text-sm hover:border-slate-300">
                          <option value="">Sélectionnez un budget</option>
                          <option value="Moins de 1000€">Moins de 1000€</option>
                          <option value="1000€ - 2000€">1000€ - 2000€</option>
                          <option value="2000€ - 3000€">2000€ - 3000€</option>
                          <option value="Plus de 3000€">Plus de 3000€</option>
                        </select>
                      </div>
                      <div>
                        <label for="message" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans leading-tight">Parlez-nous de votre projet *</label>
                        <textarea id="message" name="message" rows="3" required placeholder="Décrivez vos envies, vos centres d'intérêt, vos attentes..." class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 resize-none font-sans text-sm hover:border-slate-300"></textarea>
                      </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-12 gap-3">
                      <div class="flex flex-col xl:col-span-5">
                        <label for="destination" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1.5 font-sans leading-snug">Destination souhaitée</label>
                        <select id="destination" name="destination" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 bg-white font-sans text-sm hover:border-slate-300">
                          <option value="">Sélectionnez une destination</option>
                          @foreach($destinations as $dest)
                            <option value="{{ $dest->name }}">{{ $dest->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="flex flex-col xl:col-span-2">
                        <label for="duration" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1.5 font-sans leading-snug">Durée du voyage</label>
                        <input type="text" id="duration" name="duration" placeholder="Ex: 10 jours" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                      <div class="flex flex-col xl:col-span-3">
                        <label for="travel_date" class="block text-xs sm:text-sm font-semibold text-slate-700 mb-1.5 font-sans leading-snug">Date de départ souhaitée</label>
                        <input type="date" id="travel_date" name="travel_date" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                      <div class="flex flex-col xl:col-span-2">
                        <label for="num_travelers" class="block text-xs font-semibold text-slate-700 mb-1.5 font-sans leading-tight whitespace-nowrap">Nombre de voyageurs</label>
                        <input type="number" id="num_travelers" name="num_travelers" min="1" placeholder="2" class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 font-sans text-sm hover:border-slate-300">
                      </div>
                    </div>
                  </div>
                  <div class="bg-primary-50 border-l-4 border-primary rounded-lg p-2.5 mt-3 mb-3">
                    <div class="flex items-start">
                      <svg class="w-4 h-4 text-primary flex-shrink-0 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <p class="text-xs text-slate-700 leading-relaxed font-sans">
                        <strong class="font-sans">Note :</strong> Plus vous nous donnez de détails, plus nous pourrons personnaliser votre voyage selon vos préférences et votre budget.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="flex justify-between items-center mt-2 pt-2 border-t border-slate-100 bg-white flex-shrink-0">
                  <button type="button" onclick="prevFormStep()" class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-300 transition-all duration-300 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                  </button>
                  <button type="button" onclick="nextFormStep()" class="px-5 py-2.5 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark transition-all duration-300 shadow-md hover:shadow-lg btn-shimmer text-sm flex items-center">
                    Suivant
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                </div>
              </div>
              
              <!-- Step 3: Message -->
              <div id="step-3" class="form-step hidden absolute inset-0 w-full flex flex-col">
                <div class="flex-1 overflow-y-auto px-1">
                  <h3 class="text-lg font-bold text-slate-900 mb-3 pb-1.5 border-b border-slate-200">Votre message</h3>
                  <div class="mb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      <div>
                        <label for="preferences" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Préférences</label>
                        <textarea id="preferences" name="preferences" rows="3" placeholder="Ex: Hôtels 4 étoiles, cuisine végétarienne, activités culturelles..." class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 resize-none font-sans text-sm hover:border-slate-300"></textarea>
                      </div>
                      <div>
                        <label for="special_requests" class="block text-sm font-semibold text-slate-700 mb-1.5 font-sans">Demandes spéciales</label>
                        <textarea id="special_requests" name="special_requests" rows="3" placeholder="Ex: Accessibilité, anniversaire, besoins particuliers..." class="w-full px-4 py-2 border-2 border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 resize-none font-sans text-sm hover:border-slate-300"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="bg-primary-50 border-l-4 border-primary rounded-lg p-2.5">
                    <div class="flex items-start">
                      <svg class="w-4 h-4 text-primary flex-shrink-0 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <p class="text-xs text-slate-700 leading-relaxed font-sans">
                        <strong class="font-sans">Réponse garantie sous 24-48h</strong> (jours ouvrés). Nos experts analysent votre demande pour vous proposer un itinéraire sur-mesure.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="flex justify-between items-center mt-2 pt-2 border-t border-slate-100 bg-white flex-shrink-0">
                  <button type="button" onclick="prevFormStep()" class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-lg font-semibold hover:bg-slate-300 transition-all duration-300 text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                  </button>
                  <button type="submit" class="px-5 py-2.5 bg-accent text-white rounded-lg font-semibold hover:bg-accent-dark transition-all duration-300 shadow-md hover:shadow-lg btn-shimmer text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Envoyer ma demande
                  </button>
                </div>
              </div>
            </div>
            </div>
            
          </form>
            </div>
          </div>
        </div>
        
      </div>
    </section>
    
    <!-- Popular Circuits Section -->
    @if($circuits->count() > 0)
    <section class="py-20 sm:py-24 lg:py-28 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-16 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
            </svg>
            Nos circuits
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            Circuits <span class="gradient-text">populaires</span>
          </h2>
          <p class="text-lg text-slate-600 max-w-3xl mx-auto">
            Découvrez nos itinéraires les plus appréciés, conçus par nos experts locaux
          </p>
        </div>
        
        <!-- Circuits Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in">
          @foreach($circuits->take(6) as $circuit)
          <div class="group card-hover bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <!-- Image -->
            <div class="relative h-64 overflow-hidden img-zoom">
              @if($circuit->featured_image)
                <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-full h-full object-cover" loading="lazy">
              @else
                <div class="w-full h-full bg-gradient-to-br from-primary to-accent"></div>
              @endif
              <div class="absolute top-4 right-4">
                <span class="px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-bold text-primary shadow-lg">
                  {{ $circuit->duration_days }} jours
                </span>
              </div>
            </div>
            
            <!-- Content -->
            <div class="p-8">
              <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-300">{{ $circuit->name }}</h3>
              <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed">{{ Str::limit($circuit->description, 120) }}</p>
              
              <!-- Features -->
              <div class="flex items-center gap-4 mb-6 text-sm text-slate-600">
                @if($circuit->destination)
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="font-medium">{{ $circuit->destination->name }}</span>
                </div>
                @endif
                @if($circuit->price_from)
                <div class="flex items-center">
                  <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="font-medium">À partir de {{ number_format($circuit->price_from, 0, ',', ' ') }}€</span>
                </div>
                @endif
              </div>
              
              <!-- CTA -->
              <a href="/circuits/{{ $circuit->slug }}" class="inline-flex items-center justify-center w-full px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all duration-300 shadow-md hover:shadow-lg btn-shimmer">
                Découvrir ce circuit
                <svg class="w-5 h-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        
        <!-- View All Link -->
        <div class="text-center mt-12 fade-in">
          <a href="/circuits" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-xl font-semibold text-lg hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
            Voir tous nos circuits
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
        
      </div>
    </section>
    @endif
    
    <!-- Gallery Preview Section -->
    @if(isset($galerie) && $galerie->count() > 0)
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-slate-50 to-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Galerie photo
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            L'Inde en <span class="gradient-text">images</span>
          </h2>
          <p class="text-lg text-slate-600 max-w-3xl mx-auto">
            Laissez-vous inspirer par la beauté et la diversité de l'Inde
          </p>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 fade-in">
          @foreach($galerie->take(6) as $index => $image)
          <a href="/galerie{{ $image->category ? '?category_id=' . $image->category->id : '' }}" class="group relative overflow-hidden rounded-2xl {{ $index === 0 ? 'col-span-2 row-span-2 h-[500px]' : 'h-[240px]' }} shadow-lg hover:shadow-2xl transition-all duration-300">
            <div class="absolute inset-0 img-zoom">
              @if($image->image)
                <img src="{{ Storage::url($image->image) }}" alt="{{ $image->title }}" class="w-full h-full object-cover" loading="lazy">
              @else
                <div class="w-full h-full bg-gradient-to-br from-primary to-accent"></div>
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-300"></div>
            </div>
            <div class="absolute inset-0 p-6 flex flex-col justify-end">
              <h3 class="text-2xl font-bold text-white mb-2">{{ $image->title }}</h3>
              @if($image->category)
                <p class="text-sm text-white/80 mb-2">{{ $image->category->name }}</p>
              @endif
              <div class="inline-flex items-center text-white/90 font-medium">
                <span class="text-sm">Voir la galerie</span>
                <svg class="w-4 h-4 ml-2 transform transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </div>
            </div>
          </a>
          @endforeach
        </div>
        
        <!-- View All Button -->
        <div class="text-center mt-10 fade-in">
          <a href="/galerie" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-xl font-semibold text-base hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
            <span>Voir toutes les photos</span>
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </a>
        </div>
        
      </div>
    </section>
    @endif
    
    <!-- Blog/Articles Section -->
    @if($blogs && $blogs->count() > 0)
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            Blog & Conseils
          </div>
          <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-4">
            Nos derniers <span class="gradient-text">articles</span>
          </h2>
          <p class="text-lg text-slate-600 max-w-3xl mx-auto">
            Conseils, récits de voyage et informations pratiques pour préparer votre séjour
          </p>
        </div>
        
        <!-- Blog Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
          @foreach($blogs->take(3) as $blog)
          <article class="group card-hover bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
            <!-- Image -->
            <div class="relative h-56 overflow-hidden img-zoom">
              @if($blog->featured_image)
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" loading="lazy">
              @else
                <div class="w-full h-full bg-gradient-to-br from-accent to-primary"></div>
              @endif
            </div>
            
            <!-- Content -->
            <div class="p-8">
              <div class="flex items-center gap-3 mb-4 text-sm text-slate-600">
                <time datetime="{{ $blog->created_at->format('Y-m-d') }}" class="flex items-center">
                  <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  {{ $blog->created_at->format('d M Y') }}
                </time>
                <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                <span>{{ $blog->read_time ?? '5' }} min de lecture</span>
              </div>
              <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">{{ $blog->title }}</h3>
              <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
              <a href="/blog/{{ $blog->slug }}" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition-colors duration-300">
                Lire l'article
                <svg class="w-5 h-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
              </a>
            </div>
          </article>
          @endforeach
        </div>
        
        <!-- View All Link -->
        <div class="text-center mt-12 fade-in">
          <a href="/blog" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-xl font-semibold text-lg hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
            Voir tous les articles
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </a>
        </div>
        
      </div>
    </section>
    @endif
    
    <!-- FAQ Section -->
    @if($faqs && $faqs->count() > 0)
    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-slate-50 to-white">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 fade-in">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-semibold text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Questions fréquentes
          </div>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold text-slate-900 mb-3">
            Vous avez des <span class="gradient-text">questions</span> ?
          </h2>
          <p class="text-base text-slate-600 max-w-2xl mx-auto">
            Retrouvez les réponses aux questions les plus fréquentes
          </p>
        </div>
        
        <!-- FAQ Accordion -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 fade-in">
          @foreach($faqs->take(6) as $index => $faq)
          <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
            <button onclick="toggleFaq({{ $index }})" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors duration-200">
              <h3 class="text-base font-bold text-slate-900 pr-8">{{ $faq->question }}</h3>
              <svg id="faq-icon-{{ $index }}" class="w-5 h-5 text-primary flex-shrink-0 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="faq-answer-{{ $index }}" class="hidden px-6 pb-4">
              <div class="text-sm text-slate-600 leading-relaxed prose prose-slate max-w-none">
                {!! $faq->answer !!}
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        <!-- Contact CTA -->
        <div class="text-center mt-8 fade-in">
          <p class="text-slate-600 mb-4">Vous ne trouvez pas la réponse à votre question ?</p>
          <a href="#devis" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-xl font-semibold text-base hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Contactez-nous
          </a>
        </div>
        
      </div>
    </section>
    @endif
    
  </main>
  
  <!-- Footer Component (loaded dynamically) -->
  <div id="footer-container"></div>
  <script src="/components/footer.js"></script>
  
  <script>
    // Add scroll offset for sections
    document.addEventListener('DOMContentLoaded', function() {
      const sections = document.querySelectorAll('section[id]');
      sections.forEach(section => {
        section.style.scrollMarginTop = '5rem';
      });
    });
  </script>
  
  <!-- JavaScript -->
  <script>
    // Form Steps Management
    let currentStep = 1;
    const totalSteps = 3;
    
    function nextFormStep() {
      if (currentStep < totalSteps) {
        document.getElementById(`step-${currentStep}`).classList.add('hidden');
        currentStep++;
        document.getElementById(`step-${currentStep}`).classList.remove('hidden');
        updateStepIndicators();
      }
    }
    
    function prevFormStep() {
      if (currentStep > 1) {
        document.getElementById(`step-${currentStep}`).classList.add('hidden');
        currentStep--;
        document.getElementById(`step-${currentStep}`).classList.remove('hidden');
        updateStepIndicators();
      }
    }
    
    function updateStepIndicators() {
      document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
        const stepNumber = index + 1;
        if (stepNumber <= currentStep) {
          indicator.classList.remove('bg-slate-200', 'text-slate-600');
          indicator.classList.add('bg-primary', 'text-white');
        } else {
          indicator.classList.remove('bg-primary', 'text-white');
          indicator.classList.add('bg-slate-200', 'text-slate-600');
        }
        
        // Update connecting lines
        const nextLine = indicator.nextElementSibling;
        if (nextLine && nextLine.classList.contains('h-1')) {
          if (stepNumber < currentStep) {
            nextLine.classList.remove('bg-slate-200');
            nextLine.classList.add('bg-primary');
          } else {
            nextLine.classList.remove('bg-primary');
            nextLine.classList.add('bg-slate-200');
          }
        }
      });
    }
    
    // Reviews Carousel
    let reviewCurrentSlide = 0;
    const reviewTotalSlides = {{ $reviews->count() }};
    const reviewSlidesPerView = getSlidesPerView();
    
    function getSlidesPerView() {
      if (window.innerWidth >= 1024) return 3; // lg
      if (window.innerWidth >= 768) return 2;  // md
      return 1; // sm
    }
    
    function updateReviewCarousel() {
      const track = document.querySelector('.reviews-carousel-track');
      const slideWidth = 100 / getSlidesPerView();
      const offset = -reviewCurrentSlide * slideWidth;
      track.style.transform = `translateX(${offset}%)`;
      
      // Update slide widths
      document.querySelectorAll('.reviews-carousel-slide').forEach(slide => {
        slide.style.width = `${slideWidth}%`;
      });
    }
    
    function nextReviewSlide() {
      const maxSlide = reviewTotalSlides - getSlidesPerView();
      reviewCurrentSlide = (reviewCurrentSlide + 1) > maxSlide ? 0 : reviewCurrentSlide + 1;
      updateReviewCarousel();
    }
    
    function prevReviewSlide() {
      const maxSlide = reviewTotalSlides - getSlidesPerView();
      reviewCurrentSlide = (reviewCurrentSlide - 1) < 0 ? maxSlide : reviewCurrentSlide - 1;
      updateReviewCarousel();
    }
    
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
    
    // Active Nav Link
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= (sectionTop - 200)) {
          current = section.getAttribute('id');
        }
      });
      
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
          link.classList.add('active');
        }
      });
    });
    
    // Initialize on load
    window.addEventListener('load', () => {
      updateReviewCarousel();
    });
    
    // Update on resize
    window.addEventListener('resize', () => {
      updateReviewCarousel();
    });
    
    // Auto-play reviews
    setInterval(nextReviewSlide, 5000);
    
    // FAQ Toggle
    function toggleFaq(index) {
      const answer = document.getElementById(`faq-answer-${index}`);
      const icon = document.getElementById(`faq-icon-${index}`);
      
      if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
      } else {
        answer.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
      }
    }
    
    // Quote Form Submission with AJAX and Popup
    document.getElementById('quoteForm')?.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const form = this;
      const submitButton = form.querySelector('button[type="submit"]');
      const originalButtonText = submitButton.innerHTML;
      
      // Disable submit button and show loading state
      submitButton.disabled = true;
      submitButton.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Envoi en cours...
      `;
      
      // Get form data
      const formData = new FormData(form);
      
      // Submit via AJAX
      fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        }
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(data => {
            throw new Error(data.message || 'Une erreur est survenue');
          });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Show success popup
          showSuccessPopup(data.message);
          // Reset form
          form.reset();
          // Reset to step 1
          currentStep = 1;
          document.querySelectorAll('.form-step').forEach((step, index) => {
            if (index === 0) {
              step.classList.remove('hidden');
            } else {
              step.classList.add('hidden');
            }
          });
          updateStepIndicators();
        } else {
          // Show error message
          alert(data.message || 'Une erreur est survenue. Veuillez réessayer.');
          submitButton.disabled = false;
          submitButton.innerHTML = originalButtonText;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonText;
      });
    });
    
    // Success Popup Modal
    function showSuccessPopup(message) {
      // Create modal overlay
      const overlay = document.createElement('div');
      overlay.id = 'success-popup-overlay';
      overlay.className = 'fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4';
      overlay.style.animation = 'fadeIn 0.3s ease-out';
      
      // Create modal content
      const modal = document.createElement('div');
      modal.className = 'bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center transform transition-all';
      modal.style.animation = 'slideUp 0.4s ease-out';
      
      modal.innerHTML = `
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-slate-900 mb-4 font-display">Demande envoyée avec succès !</h3>
        <p class="text-lg text-slate-600 mb-8 font-sans">${message}</p>
        <button onclick="closeSuccessPopup()" class="w-full px-6 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-xl btn-shimmer">
          Fermer
        </button>
      `;
      
      overlay.appendChild(modal);
      document.body.appendChild(overlay);
      
      // Close on overlay click
      overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
          closeSuccessPopup();
        }
      });
      
      // Close on Escape key
      document.addEventListener('keydown', function escapeHandler(e) {
        if (e.key === 'Escape') {
          closeSuccessPopup();
          document.removeEventListener('keydown', escapeHandler);
        }
      });
    }
    
    window.closeSuccessPopup = function() {
      const overlay = document.getElementById('success-popup-overlay');
      if (overlay) {
        overlay.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
          overlay.remove();
        }, 300);
      }
    }
    
    // Add CSS animations for popup
    if (!document.getElementById('popup-styles')) {
      const style = document.createElement('style');
      style.id = 'popup-styles';
      style.textContent = `
        @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
        }
        @keyframes fadeOut {
          from { opacity: 1; }
          to { opacity: 0; }
        }
        @keyframes slideUp {
          from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
          }
          to {
            opacity: 1;
            transform: translateY(0) scale(1);
          }
        }
      `;
      document.head.appendChild(style);
    }
  </script>
  
</body>
</html>

