<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  
  <!-- Additional SEO -->
  <meta name="author" content="{{ $siteName }}">
  <meta name="language" content="French">
  <meta name="revisit-after" content="7 days">
  <meta name="theme-color" content="hsl(220, 70%, 25%)">
  <meta name="msapplication-TileColor" content="hsl(220, 70%, 25%)">
  
  <!-- Dynamic SEO from settings -->
  <title>{{ $metaTitle }}</title>
  <meta name="description" content="{{ $metaDescription }}">
  @if($siteFaviconUrl)
    <link rel="icon" type="image/x-icon" href="{{ $siteFaviconUrl }}">
    <link rel="shortcut icon" href="{{ $siteFaviconUrl }}">
  @else
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
  @endif
  {{-- Optional favicon files - uncomment when files are added to public directory --}}
  {{-- <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"> --}}
  {{-- <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> --}}
  {{-- <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> --}}
  <link rel="manifest" href="/site.webmanifest">
  
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
                },
                background: 'hsl(0, 0%, 99%)',
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
    html { scroll-behavior: smooth; }
    
    /* Enhanced sticky header */
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
      background: linear-gradient(90deg, hsl(201, 96%, 32%), hsl(142, 71%, 45%));
      transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
      width: 100%;
    }
    
    /* Enhanced animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-10px);
      }
    }
    
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    /* Scroll animations */
    .fade-in-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .fade-in-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    /* Enhanced card hover effects */
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Trust icon animations */
    .trust-icon {
      transition: all 0.3s ease;
    }
    
    .trust-icon:hover {
      transform: scale(1.1) rotate(5deg);
    }
    
    /* Review card enhancements */
    .review-card {
      transition: all 0.3s ease;
    }
    
    .review-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    
    /* Ensure sticky positioning works */
    nav.sticky {
      position: sticky;
      top: 0;
      z-index: 50;
    }
    
    /* Fallback for older browsers */
    nav {
      position: -webkit-sticky !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 50 !important;
    }
    
    /* Ensure header container doesn't hide content */
    #header-container {
      position: relative;
      z-index: 50;
      width: 100%;
    }
    
    /* Force sticky positioning on the nav inside header-container */
    #header-container > nav {
      position: -webkit-sticky !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 50 !important;
    }
    
    /* Test sticky behavior */
    .test-sticky {
      position: sticky !important;
      top: 0 !important;
      z-index: 50 !important;
    }
    
    /* Add visual indicator for testing */
    .sticky-indicator {
      position: fixed;
      top: 10px;
      right: 10px;
      background: #3B82F6;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 12px;
      z-index: 100;
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
    
    /* Dropdown Menu Styles */
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: white;
      min-width: 200px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      border-radius: 8px;
      border: 1px solid #e2e8f0;
      z-index: 1000;
      padding: 8px 0;
      margin-top: 4px;
    }
    
    .dropdown:hover .dropdown-content {
      display: block;
    }
    
    .dropdown-content a {
      color: #64748b;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    
    .dropdown-content a:hover {
      background-color: #f1f5f9;
      color: #3b82f6;
    }
    
    .dropdown-arrow {
      transition: transform 0.2s ease;
    }
    
    .dropdown:hover .dropdown-arrow {
      transform: rotate(180deg);
    }
  </style>
  <!-- Page Loader Styles -->
  <style>
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
  <body class="bg-[hsl(0,0%,98%)] text-[hsl(215,25%,27%)] font-sans antialiased">
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

  <div id="header-container" style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; z-index: 9999 !important; width: 100% !important;">
    <nav class="bg-white shadow-lg border-b border-slate-200" style="background-color: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(10px) !important; -webkit-backdrop-filter: blur(10px) !important; margin: 0 !important; width: 100% !important;">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-14">
          <div class="flex items-center">
            <a href="/" class="text-xl font-bold text-slate-900">{{ $siteName ?? 'India Tourisme' }}</a>
          </div>
          <div class="hidden lg:flex items-center justify-end space-x-6 ml-auto">
            <a href="/" class="text-slate-700 hover:text-primary font-medium text-sm">Accueil</a>
            <a href="/#services" class="text-slate-700 hover:text-primary font-medium text-sm">Services</a>
            <a href="/galerie" class="text-slate-700 hover:text-primary font-medium text-sm">Galerie</a>
            <a href="/blog" class="text-slate-700 hover:text-primary font-medium text-sm">Blog</a>
            <a href="/#contact" class="text-slate-700 hover:text-primary font-medium text-sm">Contact</a>
          </div>
          
          <!-- Mobile menu button -->
          <div class="flex items-center lg:hidden">
            <button type="button" onclick="toggleMobileMenu()" class="p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
              <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>
      </div>
      
      <!-- Mobile menu -->
      <div class="lg:hidden hidden" id="mobile-menu" style="background-color: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(10px) !important;">
        <div class="px-2 pt-2 pb-3 space-y-1 border-t border-slate-200">
          <a href="/" class="block px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-md">Accueil</a>
          <a href="/#services" class="block px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-md">Services</a>
          <a href="/galerie" class="block px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-md">Galerie</a>
          <a href="/blog" class="block px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-md">Blog</a>
          <a href="/#contact" class="block px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary hover:bg-slate-50 rounded-md">Contact</a>
        </div>
      </div>
    </nav>
  </div>

  <!-- Spacer for fixed header -->
  <div style="height: 56px;"></div>

  <main>
            <!-- Hero Section -->
            @if($heroes->count() > 0)
                {{-- Render all heroes as carousel --}}
                <x-hero.carousel :heroes="$heroes" />
            @else
                <!-- Default Hero Section (fallback) -->
            <section class="relative py-8 sm:py-12 lg:py-16 overflow-hidden" style="background-color: hsl(220, 70%, 25%); color: white;"
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%233B82F6" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
                <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
                    <div class="text-center max-w-4xl mx-auto">
                        <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-medium text-sm mb-8">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            DMC certifié ISO 9001:2015
                        </div>
                        
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                            Voyages <span class="text-white">sur‑mesure</span> en Inde,<br class="hidden sm:block"> Sri Lanka, Népal & Bhoutan
                        </h1>
                        
                        <p class="text-lg text-gray-300 mb-6 max-w-3xl mx-auto leading-relaxed">
                            Circuits privés, chauffeurs anglophones/francophones, assistance 24/7 — pour voyageurs exigeants, agences et MICE.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                            <a href="#devis" class="w-full sm:w-auto text-white border-2 border-white px-8 py-4 rounded-lg font-semibold transition-all duration-200 hover:bg-white/10 flex items-center justify-center">
                                Demander un devis
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </a>
                            <a href="https://wa.me/XXXXXXXXXXX" class="w-full sm:w-auto text-white border-2 border-white px-8 py-4 rounded-lg font-semibold transition-all duration-200 hover:bg-white/10 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                                </svg>
                                WhatsApp
                            </a>
                            <a href="https://calendly.com/votre-calendly/rdv-15min" class="w-full sm:w-auto text-white border-2 border-white px-8 py-4 rounded-lg font-semibold transition-all duration-200 hover:bg-white/10">
                                RDV visio 15 min
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            @endif

    <!-- Trust Elements Section -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 lg:gap-12 mb-16 sm:mb-20 lg:mb-24">
                <!-- Trust Badge 1: Certified -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">DMC Certifié</h3>
                    <p class="text-sm text-slate-500">ISO 9001:2015</p>
                </div>

                <!-- Trust Badge 2: 24/7 Support -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Assistance 24/7</h3>
                    <p class="text-sm text-slate-500">Support continu</p>
                </div>

                <!-- Trust Badge 3: Secure Booking -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Paiement Sécurisé</h3>
                    <p class="text-sm text-slate-500">Transactions protégées</p>
                </div>

                <!-- Trust Badge 4: Best Price -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-primary-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-2">Meilleur Prix</h3>
                    <p class="text-sm text-slate-500">Garanti</p>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="pt-16 sm:pt-20 lg:pt-24">
                @php
                    $reviews = $reviews ?? collect([]);
                    $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 4.9;
                @endphp
                <div class="text-center mb-8 sm:mb-10">
                    <div class="flex items-center justify-center gap-3 mb-5">
                        <div class="flex items-center gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-7 h-7 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <span class="text-3xl font-bold text-slate-900">{{ $avgRating }}/5</span>
                    </div>
                    <p class="text-lg text-slate-600">Basé sur <strong class="text-slate-900 font-bold">500+</strong> avis clients vérifiés</p>
                </div>

                @if($reviews && $reviews->count() > 0)
                    <!-- Reviews Carousel -->
                    <div class="reviews-carousel-container relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="reviews-carousel-wrapper overflow-hidden">
                            <div class="reviews-carousel-track flex transition-transform duration-500 ease-in-out" id="reviewsCarouselTrack" style="width: 100%;">
                                @foreach($reviews as $review)
                                    <div class="reviews-carousel-slide flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-3">
                                        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 border border-slate-200 flex flex-col h-full">
                                            <div class="flex items-center gap-1 mb-4">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-primary-600' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="text-slate-700 mb-6 text-sm leading-relaxed flex-grow">"{{ $review->comment }}"</p>
                                            <div class="flex items-center pt-4 border-t border-slate-200 mt-auto">
                                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold text-sm mr-3 flex-shrink-0">
                                                    {{ $review->avatar_initials }}
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="font-semibold text-slate-900 text-sm truncate">{{ $review->name }}</p>
                                                    @if($review->circuit)
                                                        <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $review->circuit }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        @if($reviews->count() > 3)
                            <button class="reviews-carousel-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200 z-10 border border-slate-200 hover:bg-primary hover:text-white hover:border-primary" aria-label="Previous review">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="reviews-carousel-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-200 z-10 border border-slate-200 hover:bg-primary hover:text-white hover:border-primary" aria-label="Next review">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                @else
                    <!-- Fallback: Static Reviews -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 fade-in-on-scroll border border-slate-200 flex flex-col h-full">
                            <div class="flex items-center gap-1 mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-slate-700 mb-6 text-sm leading-relaxed flex-grow">"Un voyage exceptionnel ! L'équipe a su créer un circuit sur-mesure qui correspondait parfaitement à nos attentes. Service impeccable et accompagnement de qualité."</p>
                            <div class="flex items-center pt-4 border-t border-slate-200 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold text-sm mr-3 flex-shrink-0">SM</div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 text-sm truncate">Sophie Martin</p>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate">Circuit Inde du Nord</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 fade-in-on-scroll border border-slate-200 flex flex-col h-full">
                            <div class="flex items-center gap-1 mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-slate-700 mb-6 text-sm leading-relaxed flex-grow">"Professionnalisme et réactivité remarquables. Notre voyage au Sri Lanka était parfaitement organisé. Je recommande vivement leurs services !"</p>
                            <div class="flex items-center pt-4 border-t border-slate-200 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold text-sm mr-3 flex-shrink-0">JD</div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 text-sm truncate">Jean Dubois</p>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate">Circuit Sri Lanka</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-lg transition-all duration-300 fade-in-on-scroll border border-slate-200 flex flex-col h-full">
                            <div class="flex items-center gap-1 mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-slate-700 mb-6 text-sm leading-relaxed flex-grow">"Une expérience inoubliable au Népal ! L'organisation était parfaite et le guide local très compétent. Merci pour ce magnifique voyage."</p>
                            <div class="flex items-center pt-4 border-t border-slate-200 mt-auto">
                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-semibold text-sm mr-3 flex-shrink-0">ML</div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 text-sm truncate">Marie Laurent</p>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate">Trek Népal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Quote Form Section -->
    <section id="devis" class="py-8 sm:py-12 lg:py-16 relative overflow-hidden scroll-mt-20 bg-gradient-to-br from-slate-50 to-white">
      <!-- Background decoration -->
      
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-8">
          <div class="inline-flex items-center text-foreground px-3 py-1.5 rounded-full text-xs font-medium mb-3 shadow-md backdrop-blur-sm border border-slate-200 bg-white">
            <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Devis gratuit et sans engagement
          </div>
          <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 mb-3">
            Obtenez un devis <span class="text-foreground">personnalisé</span>
          </h2>
          <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-6">Trois étapes simples pour créer votre voyage sur-mesure. Réponse détaillée sous 24–48h (jours ouvrés).</p>
          
          <!-- Enhanced Progress Indicator -->
          <div class="max-w-2xl mx-auto">
            <div class="flex items-center justify-between relative" id="progress-indicator">
              <!-- Progress Line Background -->
              <div class="absolute top-6 left-0 right-0 h-1 bg-slate-200 rounded-full"></div>
              <div id="progress-bar" class="absolute top-6 left-0 h-1 bg-primary rounded-full transition-all duration-700 ease-out shadow-lg" style="width: 0%"></div>
              
              <!-- Step 1 -->
              <div class="flex flex-col items-center relative z-10 group">
                <div id="step-indicator-1" class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <span class="mt-3 text-sm font-medium text-slate-700 transition-colors duration-300">Voyage</span>
                <div id="step-progress-1" class="mt-1 text-xs text-slate-500">0%</div>
              </div>
              
              <!-- Step 2 -->
              <div class="flex flex-col items-center relative z-10 group">
                <div id="step-indicator-2" class="w-12 h-12 bg-slate-300 text-slate-600 rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                <span id="step-label-2" class="mt-3 text-sm font-medium text-slate-500 transition-colors duration-300">Préférences</span>
                <div id="step-progress-2" class="mt-1 text-xs text-slate-400">0%</div>
              </div>
              
              <!-- Step 3 -->
              <div class="flex flex-col items-center relative z-10 group">
                <div id="step-indicator-3" class="w-12 h-12 bg-slate-300 text-slate-600 rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <span id="step-label-3" class="mt-3 text-sm font-medium text-slate-500 transition-colors duration-300">Contact</span>
                <div id="step-progress-3" class="mt-1 text-xs text-slate-400">0%</div>
              </div>
            </div>
          </div>
        </div>
        
        <form id="quote-form" class="space-y-8" action="{{ route('quote-requests.store') }}" method="POST">
          @csrf
          <!-- Step 1: Dates & Voyageurs -->
          <div id="step-1" class="step-content">
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-xl border border-slate-200 w-full max-w-4xl mx-auto">
              <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-primary text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                  1
                </div>
                <div>
                  <h3 class="text-xl font-bold text-slate-900">Dates & voyageurs</h3>
                  <p class="text-sm text-slate-500">Quand et combien ?</p>
                </div>
                <div class="ml-auto">
                  <div class="flex items-center text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Auto-sauvegarde activée
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                    Dates souhaitées *
                  </label>
                  <div class="relative">
                    <input type="text" name="travel_dates" id="travel_dates" placeholder="Sélectionnez vos dates" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300 cursor-pointer" readonly>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                      <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                </div>
                  </div>
                  <p class="text-xs text-slate-500">Cliquez pour sélectionner vos dates</p>
                  <div id="travel_dates_error" class="text-xs text-red-500 hidden"></div>
                  
                  <!-- Custom Date Range Picker -->
                  <div id="date-picker-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[80vh] overflow-hidden">
                      <div class="flex items-center justify-between p-4 border-b border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900">Sélectionnez vos dates de voyage</h3>
                        <button type="button" onclick="closeDatePicker()" class="text-slate-400 hover:text-slate-600 transition-colors duration-200">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                          </svg>
                        </button>
                      </div>
                      
                      <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Start Date -->
                          <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Date de départ</label>
                            <div class="space-y-2">
                              <input type="date" id="start-date" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                              <div class="text-xs text-slate-500">Sélectionnez le jour de votre départ</div>
                            </div>
                          </div>
                          
                          <!-- End Date -->
                          <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Date de retour</label>
                            <div class="space-y-2">
                              <input type="date" id="end-date" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                              <div class="text-xs text-slate-500">Sélectionnez le jour de votre retour</div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Quick Selection Options -->
                        <div class="mt-6">
                          <h4 class="text-sm font-semibold text-slate-700 mb-3">Sélections rapides</h4>
                          <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <button type="button" onclick="setQuickDateRange('week')" class="px-4 py-2 bg-slate-100 hover:bg-primary hover:text-white text-slate-700 rounded-lg transition-all duration-200 text-sm">
                              Une semaine
                            </button>
                            <button type="button" onclick="setQuickDateRange('2weeks')" class="px-4 py-2 bg-slate-100 hover:bg-primary hover:text-white text-slate-700 rounded-lg transition-all duration-200 text-sm">
                              2 semaines
                            </button>
                            <button type="button" onclick="setQuickDateRange('month')" class="px-4 py-2 bg-slate-100 hover:bg-primary hover:text-white text-slate-700 rounded-lg transition-all duration-200 text-sm">
                              Un mois
                            </button>
                            <button type="button" onclick="setQuickDateRange('custom')" class="px-4 py-2 bg-slate-100 hover:bg-primary hover:text-white text-slate-700 rounded-lg transition-all duration-200 text-sm">
                              Personnalisé
                            </button>
                          </div>
                        </div>
                        
                        <!-- Duration Display -->
                        <div id="duration-display" class="mt-4 p-3 bg-primary/5 rounded-lg hidden">
                          <div class="flex items-center text-sm text-slate-700">
                            <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="duration-text">Durée du voyage: </span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="flex justify-end gap-3 p-4 border-t border-slate-200">
                        <button type="button" onclick="closeDatePicker()" class="px-6 py-2 text-slate-600 hover:text-slate-800 transition-colors duration-200">
                          Annuler
                        </button>
                        <button type="button" onclick="confirmDateSelection()" class="px-6 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg transition-all duration-200">
                          Confirmer
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                    </div>
                    Nombre de voyageurs *
                  </label>
                  <div class="flex items-center space-x-3">
                    <button type="button" onclick="adjustTravelers(-1)" class="w-10 h-10 bg-slate-100 hover:bg-primary hover:text-white rounded-lg flex items-center justify-center transition-all duration-200 shadow-md hover:shadow-lg">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                    </button>
                    <input type="number" name="number_of_travelers" id="number_of_travelers" min="1" max="20" value="2" class="flex-1 px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-center font-bold">
                    <button type="button" onclick="adjustTravelers(1)" class="w-10 h-10 bg-slate-100 hover:bg-primary hover:text-white rounded-lg flex items-center justify-center transition-all duration-200 shadow-md hover:shadow-lg">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </button>
                  </div>
                  <p class="text-xs text-slate-500">Incluant les enfants</p>
                </div>
                
                <div class="space-y-2 md:col-span-2 lg:col-span-1">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                      </svg>
                    </div>
                    Budget approximatif *
                  </label>
                  <select name="budget_range" id="budget_range" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300 bg-white">
                    <option value="">Sélectionnez votre budget</option>
                    <option value="1500-3000">1 500 – 3 000 € (Découverte)</option>
                    <option value="3000-5000">3 000 – 5 000 € (Confort)</option>
                    <option value="5000-8000">5 000 – 8 000 € (Premium)</option>
                    <option value="8000+">8 000 € et plus (Luxe)</option>
                  </select>
                  <p class="text-xs text-slate-500">Par personne, hors vols</p>
                </div>
              </div>
              <div class="flex justify-between items-center mt-8">
                <div class="text-sm text-slate-500">
                  <span id="step1-progress">0%</span> complété
                </div>
                <button type="button" onclick="nextStep(2)" id="step1-next" disabled class="group bg-slate-300 text-slate-500 px-8 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg cursor-not-allowed">
                  <span class="flex items-center">
                    Suivant
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
          </div>

          <!-- Step 2: Préférences -->
          <div id="step-2" class="step-content hidden">
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-xl border border-slate-200 w-full max-w-4xl mx-auto">
              <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-primary text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                  2
                </div>
                <div>
                  <h3 class="text-xl font-bold text-slate-900">Préférences</h3>
                  <p class="text-sm text-slate-500">Destinations et services</p>
                </div>
                <div class="ml-auto">
                  <div class="flex items-center text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Auto-sauvegarde activée
                  </div>
                </div>
              </div>
              <div class="space-y-6">
                <div>
                  <label class="block text-sm font-semibold text-slate-700 mb-4 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                    </div>
                    Destination(s)
                  </label>
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($destinations as $destination)
                      <label class="group/checkbox flex items-center p-3 border-2 border-slate-200 rounded-lg hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 cursor-pointer">
                        <input type="checkbox" name="destinations[]" value="{{ $destination->id }}" class="rounded border-slate-300 text-primary focus:ring-primary mr-3">
                        <div class="flex items-center">
                          <span class="text-sm mr-2">{{ $destination->name }}</span>
                        </div>
                      </label>
                    @empty
                      <div class="col-span-2 text-center py-8 text-slate-500">
                        <svg class="w-12 h-12 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p>Aucune destination disponible</p>
                      </div>
                    @endforelse
                  </div>
                </div>
                
                <!-- Services and Style in Columns -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                  <!-- Services Selection -->
                  <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-4 flex items-center">
                      <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                        <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </div>
                      Services souhaités
                    </label>
                    <div class="space-y-3">
                      <label class="group/checkbox flex items-center p-3 border-2 border-slate-200 rounded-lg hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 cursor-pointer">
                        <input type="checkbox" name="services[]" value="hebergement" class="rounded border-slate-300 text-primary focus:ring-primary mr-3">
                        <div class="flex items-center">
                          <svg class="w-4 h-4 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                          </svg>
                          <div>
                            <span class="font-medium text-slate-700 group-hover/checkbox:text-primary">Hébergement</span>
                            <p class="text-xs text-slate-500">Hôtels, guesthouses, resorts</p>
                          </div>
                        </div>
                      </label>
                      <label class="group/checkbox flex items-center p-3 border-2 border-slate-200 rounded-lg hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 cursor-pointer">
                        <input type="checkbox" name="services[]" value="transport" class="rounded border-slate-300 text-primary focus:ring-primary mr-3">
                        <div class="flex items-center">
                          <svg class="w-4 h-4 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                          </svg>
                          <div>
                            <span class="font-medium text-slate-700 group-hover/checkbox:text-primary">Transport</span>
                            <p class="text-xs text-slate-500">Véhicules privés, vols domestiques</p>
                          </div>
                        </div>
                      </label>
                    </div>
                  </div>
                  
                  <!-- Travel Style -->
                  <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-4 flex items-center">
                      <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                        <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                      </div>
                      Style de voyage
                    </label>
                    <select name="travel_style" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300 bg-white">
                      <option value="">Sélectionnez un style</option>
                      <option value="culturelle">🏛️ Découverte culturelle</option>
                      <option value="aventure">🏔️ Aventure & nature</option>
                      <option value="luxe">✨ Luxe & bien-être</option>
                      <option value="spiritualite">🧘 Spiritualité</option>
                      <option value="famille">👨‍👩‍👧‍👦 Famille</option>
                      <option value="noces">💑 Voyage de noces</option>
                    </select>
                  </div>
                </div>
                
                <!-- Travel Desires Description -->
                <div>
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Décrivez-nous votre voyage idéal
                    <span class="ml-1 text-xs text-slate-500">(optionnel)</span>
                  </label>
                  <textarea name="special_requests" rows="4" placeholder="Partagez vos envies, vos centres d'intérêt, le type d'hébergement souhaité, vos expériences de voyage précédentes, ce qui vous attire le plus dans cette destination..." class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 resize-none hover:border-slate-300"></textarea>
                  <div class="flex items-center justify-between mt-2">
                    <p class="text-xs text-slate-500">Plus vous nous en dites, mieux nous vous conseillons</p>
                    <span class="text-xs text-slate-400">0/500</span>
                  </div>
                </div>
              </div>
              <div class="flex justify-between mt-8">
                <button type="button" onclick="prevStep(1)" class="group bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-300 transition-all duration-300 shadow-md hover:shadow-lg hover:scale-105 transform">
                  <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                  </span>
                </button>
                <button type="button" onclick="nextStep(3)" class="group bg-primary text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform">
                  <span class="flex items-center">
                    Suivant
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </button>
              </div>
            </div>
          </div>

          <!-- Step 3: Contact -->
          <div id="step-3" class="step-content hidden">
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-xl border border-slate-200 w-full max-w-4xl mx-auto">
              <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-primary text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                  3
                </div>
                <div>
                  <h3 class="text-xl font-bold text-slate-900">Vos coordonnées</h3>
                  <p class="text-sm text-slate-500">Comment vous joindre ?</p>
                </div>
                <div class="ml-auto">
                  <div class="flex items-center text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded-full">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Auto-sauvegarde activée
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>
                    Prénom *
                  </label>
                  <input type="text" name="first_name" required placeholder="Prénom" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                  <p class="text-xs text-slate-500">Votre prénom</p>
                </div>
                
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                      </svg>
                    </div>
                    Nom *
                  </label>
                  <input type="text" name="last_name" required placeholder="Nom" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                  <p class="text-xs text-slate-500">Votre nom de famille</p>
                </div>
                
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                    Email *
                  </label>
                  <input type="email" name="email" required placeholder="votre@email.com" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                  <p class="text-xs text-slate-500">Pour recevoir votre devis</p>
                </div>
                
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                      </svg>
                    </div>
                    Téléphone
                    <span class="ml-1 text-xs text-slate-500">(optionnel)</span>
                  </label>
                  <input type="tel" name="phone" placeholder="+33 6 12 34 56 78" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                  <p class="text-xs text-slate-500">Pour un contact plus rapide</p>
                </div>
                <!-- Math Captcha -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                    <div class="w-6 h-6 bg-primary/10 rounded-md flex items-center justify-center mr-2">
                      <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                      </svg>
                    </div>
                    Vérification de sécurité *
                  </label>
                  <div class="flex items-center space-x-3">
                    <div class="flex-1">
                      <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-3 text-center">
                        <div class="text-lg font-bold text-slate-700 mb-1" id="captcha-question">
                          {{ \App\Helpers\MathCaptcha::generate('quote')['question'] }}
                        </div>
                        <p class="text-xs text-slate-500">Résolvez ce calcul simple</p>
                      </div>
                    </div>
                    <div class="flex-1">
                      <input type="number" name="math_captcha" id="math_captcha" required placeholder="Votre réponse" class="w-full px-4 py-3 border-2 border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300 text-center font-semibold">
                    </div>
                    <button type="button" id="refresh-captcha" class="px-3 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg transition-colors duration-200 flex items-center justify-center">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                      </svg>
                    </button>
                  </div>
                  <p class="text-xs text-slate-500 mt-2">Cliquez sur l'icône pour générer un nouveau calcul</p>
                </div>
                
                <div class="bg-primary/5 border border-primary/20 rounded-xl p-4">
                  <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-slate-700 leading-relaxed">
                      <strong>Réponse garantie</strong> sous 24-48h (jours ouvrés). Nos experts analysent votre demande pour vous proposer un itinéraire sur-mesure.
                    </p>
                  </div>
                </div>
              </div>
              <div class="flex justify-between mt-8">
                <button type="button" onclick="prevStep(2)" class="group bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-semibold hover:bg-slate-300 transition-all duration-300 shadow-md hover:shadow-lg hover:scale-105 transform">
                  <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Précédent
                  </span>
                </button>
                <button type="submit" class="group bg-primary text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform">
                  <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Recevoir mon devis
                  </span>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>


    <script>
      let currentStep = 1;
      let formData = {};
      let autoSaveInterval;
      let formInitialized = false;
      
      // Initialize form
      document.addEventListener('DOMContentLoaded', function() {
        // Prevent multiple initializations
        if (formInitialized) return;
        formInitialized = true;
        
        initializeForm();
        loadSavedData();
        startAutoSave();
        initializeDatePicker();
        setupValidation();
        
        // Clean up on page unload
        window.addEventListener('beforeunload', function() {
          stopAutoSave();
        });
      });
      
      function initializeForm() {
        // Add animation classes
        const style = document.createElement('style');
        style.textContent = `
          @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
          }
          @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
          }
          @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
          }
          @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
          }
          .animate-fade-in { animation: fadeIn 0.6s ease-out; }
          .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
          .animate-slide-in-right { animation: slideInRight 0.7s ease-out; }
          .animate-slide-in-left { animation: slideInLeft 0.7s ease-out; }
          .animation-delay-200 { animation-delay: 0.2s; }
          .animation-delay-400 { animation-delay: 0.4s; }
        `;
        document.head.appendChild(style);
      }
      
      function nextStep(step) {
        if (!validateCurrentStep()) return;
        
        // Hide current step
        const currentStepEl = document.getElementById(`step-${currentStep}`);
        currentStepEl.classList.add('hidden');
        
        // Update current step
        currentStep = step;
        
        // Show new step
        const newStepEl = document.getElementById(`step-${currentStep}`);
        newStepEl.classList.remove('hidden');
        
        // Update progress indicator
        updateProgressIndicator();
      }
      
      function prevStep(step) {
        // Hide current step
        const currentStepEl = document.getElementById(`step-${currentStep}`);
        currentStepEl.classList.add('hidden');
        
        // Update current step
        currentStep = step;
        
        // Show previous step
        const prevStepEl = document.getElementById(`step-${currentStep}`);
        prevStepEl.classList.remove('hidden');
        
        // Update progress indicator
        updateProgressIndicator();
      }
      
      function updateProgressIndicator() {
        // Update progress bar width
        const progressBar = document.getElementById('progress-bar');
        const progressPercentage = ((currentStep - 1) / 2) * 100;
        if (progressBar) {
          progressBar.style.width = `${progressPercentage}%`;
        }
        
        for (let i = 1; i <= 3; i++) {
          const indicator = document.getElementById(`step-indicator-${i}`);
          const label = document.getElementById(`step-label-${i}`);
          const progress = document.getElementById(`step-progress-${i}`);
          
          if (i < currentStep) {
            // Completed step
            indicator.className = 'w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110';
            if (label) label.className = 'mt-3 text-sm font-medium text-slate-700 transition-colors duration-300';
            if (progress) progress.textContent = '100%';
          } else if (i === currentStep) {
            // Current step
            indicator.className = 'w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110';
            if (label) label.className = 'mt-3 text-sm font-medium text-slate-700 transition-colors duration-300';
            if (progress) progress.textContent = getStepProgress(i) + '%';
          } else {
            // Inactive step
            indicator.className = 'w-12 h-12 bg-slate-300 text-slate-600 rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition-all duration-500 group-hover:scale-110';
            if (label) label.className = 'mt-3 text-sm font-medium text-slate-500 transition-colors duration-300';
            if (progress) progress.textContent = '0%';
          }
        }
      }
      
      function getStepProgress(step) {
        let progress = 0;
        switch(step) {
          case 1:
            const travelDates = document.getElementById('travel_dates');
            const datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;
            if (travelDates.value && travelDates.value !== 'Sélectionnez vos dates' && datePattern.test(travelDates.value)) {
              progress += 40;
            }
            if (document.getElementById('number_of_travelers').value) progress += 30;
            if (document.getElementById('budget_range').value) progress += 30;
            break;
          case 2:
            const destinations = document.querySelectorAll('input[name="destinations[]"]:checked');
            const services = document.querySelectorAll('input[name="services[]"]:checked');
            const travelStyle = document.getElementById('travel_style').value;
            const specialRequests = document.getElementById('special_requests').value;
            
            if (destinations.length > 0) progress += 30;
            if (services.length > 0) progress += 20;
            if (travelStyle) progress += 25;
            if (specialRequests) progress += 25;
            break;
          case 3:
            if (document.getElementById('first_name').value) progress += 25;
            if (document.getElementById('last_name').value) progress += 25;
            if (document.getElementById('email').value) progress += 25;
            if (document.getElementById('math_captcha').value) progress += 25;
            break;
        }
        return progress;
      }
      
      function validateCurrentStep() {
        let isValid = true;
        
        switch(currentStep) {
          case 1:
            const travelDates = document.getElementById('travel_dates');
            const travelers = document.getElementById('number_of_travelers');
            const budget = document.getElementById('budget_range');
            
            // Clear any existing error
            hideError('travel_dates_error');
            
            if (!travelDates.value || travelDates.value.trim() === '' || travelDates.value === 'Sélectionnez vos dates') {
              showError('travel_dates_error', 'Veuillez sélectionner vos dates de voyage');
              isValid = false;
            } else {
              // Additional validation for date format
              const datePattern = /^\d{2}\/\d{2}\/\d{4} - \d{2}\/\d{2}\/\d{4}$/;
              if (!datePattern.test(travelDates.value)) {
                showError('travel_dates_error', 'Format de date invalide');
                isValid = false;
              }
            }
            
            if (!travelers.value || travelers.value < 1) {
              isValid = false;
            }
            if (!budget.value) {
              isValid = false;
            }
            break;
          case 2:
            const destinations = document.querySelectorAll('input[name="destinations[]"]:checked');
            if (destinations.length === 0) {
              isValid = false;
            }
            break;
          case 3:
            const firstName = document.getElementById('first_name');
            const lastName = document.getElementById('last_name');
            const email = document.getElementById('email');
            const captcha = document.getElementById('math_captcha');
            
            if (!firstName.value) isValid = false;
            if (!lastName.value) isValid = false;
            if (!email.value || !isValidEmail(email.value)) isValid = false;
            if (!captcha.value) isValid = false;
            break;
        }
        
        return isValid;
      }
      
      function showError(elementId, message) {
        const errorEl = document.getElementById(elementId);
        if (errorEl) {
          errorEl.textContent = message;
          errorEl.classList.remove('hidden');
        }
      }
      
      function hideError(elementId) {
        const errorEl = document.getElementById(elementId);
        if (errorEl) {
          errorEl.classList.add('hidden');
        }
      }
      
      function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }
      
      function adjustTravelers(delta) {
        const input = document.getElementById('number_of_travelers');
        const newValue = parseInt(input.value) + delta;
        if (newValue >= 1 && newValue <= 20) {
          input.value = newValue;
          saveFormData();
          updateStepProgress(1);
        }
      }
      
      function initializeDatePicker() {
        const dateInput = document.getElementById('travel_dates');
        if (dateInput) {
          dateInput.addEventListener('click', function() {
            openDatePicker();
          });
        }
        
        // Add event listeners for date changes
        setupDateChangeListeners();
      }
      
      function openDatePicker() {
        const modal = document.getElementById('date-picker-modal');
        if (modal) {
          modal.classList.remove('hidden');
          document.body.style.overflow = 'hidden';
          
          // Load current values if any
          loadCurrentDateValues();
          
          // Add click outside to close
          modal.addEventListener('click', function(e) {
            if (e.target === modal) {
              closeDatePicker();
            }
          });
        }
      }
      
      function closeDatePicker() {
        const modal = document.getElementById('date-picker-modal');
        if (modal) {
          modal.classList.add('hidden');
          document.body.style.overflow = '';
        }
      }
      
      
      function setupDateChangeListeners() {
        // Update duration when dates change
        ['start-date', 'end-date'].forEach(id => {
          document.getElementById(id).addEventListener('change', function() {
            updateDurationDisplay();
          });
        });
      }
      
      
      function updateDurationDisplay() {
        const startDateValue = document.getElementById('start-date').value;
        const endDateValue = document.getElementById('end-date').value;
        
        if (startDateValue && endDateValue) {
          const startDate = new Date(startDateValue);
          const endDate = new Date(endDateValue);
          
          if (endDate >= startDate) {
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            const durationDisplay = document.getElementById('duration-display');
            const durationText = document.getElementById('duration-text');
            
            durationText.textContent = `Durée du voyage: ${diffDays} jour${diffDays > 1 ? 's' : ''}`;
            durationDisplay.classList.remove('hidden');
          } else {
            document.getElementById('duration-display').classList.add('hidden');
          }
        } else {
          document.getElementById('duration-display').classList.add('hidden');
        }
      }
      
      function setQuickDateRange(type) {
        const today = new Date();
        let startDate, endDate;
        
        switch(type) {
          case 'week':
            startDate = new Date(today);
            endDate = new Date(today);
            endDate.setDate(today.getDate() + 7);
            break;
          case '2weeks':
            startDate = new Date(today);
            endDate = new Date(today);
            endDate.setDate(today.getDate() + 14);
            break;
          case 'month':
            startDate = new Date(today);
            endDate = new Date(today);
            endDate.setMonth(today.getMonth() + 1);
            break;
          case 'custom':
            return; // Let user select manually
        }
        
        // Format dates for HTML5 date inputs (YYYY-MM-DD)
        const formatDateForInput = (date) => {
          const year = date.getFullYear();
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const day = String(date.getDate()).padStart(2, '0');
          return `${year}-${month}-${day}`;
        };
        
        // Set the date values
        document.getElementById('start-date').value = formatDateForInput(startDate);
        document.getElementById('end-date').value = formatDateForInput(endDate);
        
        updateDurationDisplay();
      }
      
      function confirmDateSelection() {
        const startDateValue = document.getElementById('start-date').value;
        const endDateValue = document.getElementById('end-date').value;
        
        if (!startDateValue || !endDateValue) {
          alert('Veuillez sélectionner des dates de début et de fin');
          return;
        }
        
        const startDate = new Date(startDateValue);
        const endDate = new Date(endDateValue);
        
        if (endDate < startDate) {
          alert('La date de retour doit être après la date de départ');
          return;
        }
        
        // Format dates for display
        const startFormatted = formatDate(startDate);
        const endFormatted = formatDate(endDate);
        
        // Update the input field
        document.getElementById('travel_dates').value = `${startFormatted} - ${endFormatted}`;
        
        // Clear any existing errors
        hideError('travel_dates_error');
        
        // Save and update progress
        saveFormData();
        updateStepProgress(1);
        
        // Force update next button after a short delay to ensure DOM is updated
        setTimeout(() => {
          updateNextButton();
        }, 100);
        
        // Close modal
        closeDatePicker();
      }
      
      function formatDate(date) {
        const day = date.getDate().toString().padStart(2, '0');
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
      }
      
      function loadCurrentDateValues() {
        const currentValue = document.getElementById('travel_dates').value;
        if (currentValue && currentValue.includes(' - ')) {
          const [startStr, endStr] = currentValue.split(' - ');
          const startDate = parseDate(startStr);
          const endDate = parseDate(endStr);
          
          if (startDate && endDate) {
            // Format dates for HTML5 date inputs (YYYY-MM-DD)
            const formatDateForInput = (date) => {
              const year = date.getFullYear();
              const month = String(date.getMonth() + 1).padStart(2, '0');
              const day = String(date.getDate()).padStart(2, '0');
              return `${year}-${month}-${day}`;
            };
            
            document.getElementById('start-date').value = formatDateForInput(startDate);
            document.getElementById('end-date').value = formatDateForInput(endDate);
            
            updateDurationDisplay();
          }
        } else {
          // Set default values (today + 1 week)
          const today = new Date();
          const nextWeek = new Date(today);
          nextWeek.setDate(today.getDate() + 7);
          
          // Format dates for HTML5 date inputs
          const formatDateForInput = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
          };
          
          document.getElementById('start-date').value = formatDateForInput(today);
          document.getElementById('end-date').value = formatDateForInput(nextWeek);
          
          updateDurationDisplay();
        }
      }
      
      function parseDate(dateStr) {
        const parts = dateStr.split('/');
        if (parts.length === 3) {
          const day = parseInt(parts[0]);
          const month = parseInt(parts[1]) - 1;
          const year = parseInt(parts[2]);
          return new Date(year, month, day);
        }
        return null;
      }
      
      function setupValidation() {
        // Real-time validation for all form fields
        const form = document.getElementById('quote-form');
        if (form) {
          form.addEventListener('input', function(e) {
            saveFormData();
            updateStepProgress(currentStep);
            updateNextButton();
          });
          
          form.addEventListener('change', function(e) {
            saveFormData();
            updateStepProgress(currentStep);
            updateNextButton();
          });
        }
      }
      
      function updateStepProgress(step) {
        const progress = getStepProgress(step);
        const progressEl = document.getElementById(`step${step}-progress`);
        if (progressEl) {
          progressEl.textContent = progress + '%';
        }
      }
      
      function updateNextButton() {
        const nextButton = document.getElementById(`step${currentStep}-next`);
        
        if (nextButton) {
          const isValid = validateCurrentStep();
          
          if (isValid) {
            nextButton.disabled = false;
            nextButton.className = 'group bg-primary text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform';
          } else {
            nextButton.disabled = true;
            nextButton.className = 'group bg-slate-300 text-slate-500 px-8 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg cursor-not-allowed';
          }
        }
      }
      
      function saveFormData() {
        const form = document.getElementById('quote-form');
        if (form) {
          const formDataObj = new FormData(form);
          formData = {};
          for (let [key, value] of formDataObj.entries()) {
            if (formData[key]) {
              if (Array.isArray(formData[key])) {
                formData[key].push(value);
              } else {
                formData[key] = [formData[key], value];
              }
            } else {
              formData[key] = value;
            }
          }
          localStorage.setItem('quoteFormData', JSON.stringify(formData));
        }
      }
      
      function loadSavedData() {
        const savedData = localStorage.getItem('quoteFormData');
        if (savedData) {
          formData = JSON.parse(savedData);
          populateForm();
        }
      }
      
      function populateForm() {
        Object.keys(formData).forEach(key => {
          const element = document.querySelector(`[name="${key}"]`);
          if (element) {
            if (element.type === 'checkbox') {
              element.checked = formData[key].includes(element.value);
            } else {
              element.value = formData[key];
            }
          }
        });
        updateStepProgress(currentStep);
        updateNextButton();
      }
      
      function startAutoSave() {
        autoSaveInterval = setInterval(saveFormData, 5000); // Auto-save every 5 seconds
      }
      
      function stopAutoSave() {
        if (autoSaveInterval) {
          clearInterval(autoSaveInterval);
        }
      }
      
      // Captcha functionality
      function refreshCaptcha() {
        fetch('/contact/captcha?type=quote')
          .then(response => response.json())
          .then(data => {
            document.getElementById('captcha-question').textContent = data.question;
            document.getElementById('math_captcha').value = '';
          })
          .catch(error => {
            console.error('Error refreshing captcha:', error);
          });
      }
      
      // Add event listener for captcha refresh button
      document.addEventListener('DOMContentLoaded', function() {
        const refreshButton = document.getElementById('refresh-captcha');
        if (refreshButton) {
          refreshButton.addEventListener('click', refreshCaptcha);
        }
        
        // Form submission with captcha validation
        const form = document.querySelector('#quote-form');
        if (form) {
          form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(form);
            const captchaAnswer = formData.get('math_captcha');
            
            if (!captchaAnswer) {
              alert('Veuillez résoudre le calcul de sécurité.');
              return;
            }
            
            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Envoi en cours...';
            submitButton.disabled = true;
            
            // Submit form via AJAX
            fetch(form.action, {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.error) {
                alert(data.error);
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                refreshCaptcha();
              } else {
                alert(data.message);
                form.reset();
                nextStep(1); // Go back to step 1
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                refreshCaptcha();
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('Une erreur est survenue. Veuillez réessayer.');
              submitButton.innerHTML = originalText;
              submitButton.disabled = false;
              refreshCaptcha();
            });
          });
        }
      });
    </script>

    <!-- Blog Section -->
    <section id="blog" class="py-16 sm:py-20 lg:py-32 bg-slate-50">
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Blog</h2>
          <p class="text-xl text-slate-600">Conseils et guides pour votre voyage</p>
        </div>
        
        @if($blogs->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $index => $blog)
              @php
                $gradients = [
                  'from-purple-400 to-pink-500',
                  'from-teal-400 to-cyan-600', 
                  'from-amber-400 to-orange-600',
                  'from-emerald-400 to-green-600',
                  'from-indigo-400 to-purple-600',
                  'from-rose-400 to-red-500'
                ];
                $gradient = $gradients[$index % count($gradients)];
                $blogCategories = ['Guide Voyage', 'Visa Info', 'Budget Guide', 'Culture Guide', 'Conseils', 'Actualités'];
                $category = $blogCategories[$index % count($blogCategories)];
              @endphp
              <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-200">
                <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                  <div class="relative overflow-hidden">
                    @if($blog->featured_image)
                      <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                      <div class="w-full h-48 bg-gradient-to-br {{ $gradient }} flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <span class="text-white text-lg font-bold">{{ $category }}</span>
                      </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                  </div>
                  <div class="p-6">
                    <div class="text-sm text-slate-500 mb-2">{{ $blog->created_at->format('d M Y') }}</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-200">{{ $blog->title }}</h3>
                    <p class="text-slate-600">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 100) }}</p>
                  </div>
                </a>
              </article>
            @endforeach
          </div>
          
          <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h8"></path>
              </svg>
              Voir tous les articles
            </a>
          </div>
        @else
          <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h8"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucun article disponible</h3>
            <p class="mt-1 text-sm text-slate-500">Les articles de blog seront bientôt publiés.</p>
          </div>
        @endif
      </div>
    </section>

    <!-- Gallery Categories Section -->
    <section id="galerie" class="py-16 sm:py-20 lg:py-32">
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Découvrez nos destinations</h2>
          <p class="text-xl text-slate-600">Explorez les différentes facettes de nos voyages</p>
        </div>
        
        @if($categories->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @foreach($categories as $index => $category)
              @php
                $gradients = [
                  'from-rose-400 to-pink-600',
                  'from-yellow-400 to-orange-500', 
                  'from-emerald-400 to-green-600',
                  'from-indigo-400 to-purple-600',
                  'from-blue-400 to-cyan-600',
                  'from-purple-400 to-violet-600'
                ];
                $gradient = $gradients[$index % count($gradients)];
              @endphp
              <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="w-full h-64 bg-gradient-to-br {{ $gradient }} flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                  <span class="text-white text-xl font-bold text-center px-4">{{ $category->name }}</span>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <div class="absolute bottom-4 left-4 text-white">
                    <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                    @if($category->description)
                      <p class="text-sm text-slate-200">{{ Str::limit($category->description, 50) }}</p>
                    @endif
                    <div class="mt-2">
                      <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                        {{ $category->galeries->count() }} photo(s)
                      </span>
                    </div>
                  </div>
                </div>
                <a href="{{ route('galerie', ['category_id' => $category->id]) }}" class="absolute inset-0 z-10"></a>
              </div>
            @endforeach
          </div>
          
          <div class="text-center mt-12">
            <a href="{{ route('galerie') }}" class="inline-flex items-center px-8 py-4 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              Voir toute la galerie
            </a>
          </div>
        @else
          <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucune catégorie disponible</h3>
            <p class="mt-1 text-sm text-slate-500">La galerie sera bientôt mise à jour.</p>
          </div>
        @endif
      </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 sm:py-20 lg:py-32 bg-slate-50">
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
          <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">FAQ</h2>
        </div>
        
        @if($faqs->count() > 0)
          <div class="space-y-4">
            @foreach($faqs as $index => $faq)
              <details class="group bg-white rounded-2xl border border-slate-200 shadow-lg overflow-hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer hover:bg-slate-50 transition-colors duration-200">
                  <span class="font-semibold text-slate-900">{{ $faq->question }}</span>
                  <svg class="w-5 h-5 text-slate-500 group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </summary>
                <div class="px-6 pb-6">
                  <p class="text-slate-600">{{ $faq->answer }}</p>
                </div>
              </details>
            @endforeach
          </div>
        @else
          <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucune FAQ disponible</h3>
            <p class="mt-1 text-sm text-slate-500">Les questions fréquemment posées seront bientôt mises à jour.</p>
          </div>
        @endif
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-white to-slate-50 scroll-mt-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-medium text-sm mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Contactez-nous
          </div>
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-4 tracking-tight">Une question ?</h2>
          <p class="text-lg sm:text-xl text-slate-600 max-w-2xl mx-auto">Nous sommes là pour vous aider à créer votre voyage sur-mesure.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
          <div class="bg-white rounded-2xl shadow-lg p-6 lg:p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Nos coordonnées</h3>
            <div class="space-y-6">
              <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                  <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-semibold text-slate-900 text-sm">Téléphone</p>
                  <p class="text-slate-600 text-sm">{{ $contactPhone ?? '+33 X XX XX XX XX' }}</p>
                </div>
              </div>
              
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-primary-light rounded-lg flex items-center justify-center">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div>
                  <p class="font-semibold text-slate-900 text-sm">Email</p>
                  <a href="mailto:{{ $contactEmail ?? 'contact@indiatourisme.fr' }}" class="text-primary hover:text-primary-dark transition-colors duration-200 text-sm">{{ $contactEmail ?? 'contact@indiatourisme.fr' }}</a>
                </div>
              </div>
              
              @if($contactWhatsappUrl)
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-primary-light rounded-lg flex items-center justify-center">
                  <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                  </svg>
                </div>
                <div>
                  <p class="font-semibold text-slate-900 text-sm">WhatsApp</p>
                  <a href="{{ $contactWhatsappUrl }}" class="text-primary hover:text-primary-dark transition-colors duration-200 text-sm">Écrire un message</a>
                </div>
              </div>
              @endif
            </div>
          </div>
          
          <div class="bg-white rounded-xl p-4 sm:p-6 shadow-lg border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Envoyez-nous un message</h3>
            
            <!-- Success/Error Messages -->
            <div id="contact-message" class="hidden mb-4 p-3 rounded-xl"></div>
            
            <form id="contact-form" class="space-y-3">
              @csrf
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Sujet</label>
                <input type="text" name="subject" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Sujet de votre message">
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Votre message</label>
                <textarea name="message" rows="3" placeholder="Parlez-nous de votre projet..." required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none"></textarea>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-1">Nom *</label>
                  <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Votre nom">
                </div>
                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-1">Email *</label>
                  <input type="email" name="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="votre@email.com">
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
                <input type="tel" name="phone" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Votre numéro de téléphone">
              </div>
              
              <!-- Math Captcha -->
              <div class="space-y-2">
                <label class="block text-sm font-medium text-slate-700">Vérification mathématique *</label>
                <div class="flex items-center space-x-3">
                  <div class="flex-1">
                    <input type="number" name="math_captcha" id="math_captcha_input" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200" placeholder="Votre réponse">
                  </div>
                  <div class="flex-shrink-0">
                    <div id="math-captcha-question" class="border border-slate-300 rounded-lg p-3 bg-slate-50 text-center min-w-[100px]">
                      <div class="text-sm font-bold text-slate-700" id="captcha-question-text">
                        {{ \App\Helpers\MathCaptcha::generate('contact')['question'] }}
                      </div>
                    </div>
                    <button type="button" id="refresh-captcha-contact" class="flex items-center justify-center space-x-1 text-xs text-slate-500 hover:text-primary mt-1 px-2 py-1 border border-slate-300 rounded hover:border-primary hover:bg-primary/5 transition-all duration-200 mx-auto">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                      </svg>
                      <span>Nouveau</span>
                    </button>
                  </div>
                </div>
              </div>
              
              <button type="submit" id="submit-btn" class="w-full bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="submit-text">Envoyer le message</span>
                <span id="submit-loading" class="hidden">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Envoi en cours...
                </span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load Common Components -->
  <script src="components/header.js"></script>
  <script src="components/footer.js"></script>
  <script>
    // Scroll-triggered animations
    document.addEventListener('DOMContentLoaded', function() {
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, observerOptions);

      // Observe all fade-in-on-scroll elements
      document.querySelectorAll('.fade-in-on-scroll').forEach(el => {
        observer.observe(el);
      });
    });

    // Mobile menu toggle function
    function toggleMobileMenu() {
      const mobileMenu = document.getElementById('mobile-menu');
      if (mobileMenu) {
        mobileMenu.classList.toggle('hidden');
      }
    }

    // Load components when page loads
    document.addEventListener('DOMContentLoaded', function() {
      // Load dynamic header only if header-container is empty
      const headerContainer = document.getElementById('header-container');
      if (headerContainer && headerContainer.innerHTML.trim() === '') {
        loadHeader();
      }
      
      // Load footer
      if (document.getElementById('footer-container')) {
        loadFooter();
      }
      
      // Contact form handling
      const contactForm = document.getElementById('contact-form');
      const submitBtn = document.getElementById('submit-btn');
      const submitText = document.getElementById('submit-text');
      const submitLoading = document.getElementById('submit-loading');
      const messageDiv = document.getElementById('contact-message');
      const refreshCaptchaBtn = document.getElementById('refresh-captcha-contact');
      
      // Refresh captcha
      refreshCaptchaBtn.addEventListener('click', function() {
        fetch('/contact/captcha?type=contact')
          .then(response => response.json())
          .then(data => {
            document.getElementById('captcha-question-text').textContent = data.question;
            document.getElementById('math_captcha_input').value = '';
          })
          .catch(error => {
            console.error('Error refreshing captcha:', error);
          });
      });
      
      // Form submission
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        submitLoading.classList.remove('hidden');
        messageDiv.classList.add('hidden');
        
        // Get form data
        const formData = new FormData(contactForm);
        
        // Submit form
        fetch('/contact', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Success
            messageDiv.className = 'mb-6 p-4 rounded-xl bg-green-100 text-green-800 border border-green-200';
            messageDiv.textContent = data.message;
            messageDiv.classList.remove('hidden');
            contactForm.reset();
            // Refresh captcha
            refreshCaptchaBtn.click();
          } else {
            // Error
            messageDiv.className = 'mb-6 p-4 rounded-xl bg-red-100 text-red-800 border border-red-200';
            messageDiv.textContent = data.message;
            messageDiv.classList.remove('hidden');
            
            // Show field errors if any
            if (data.errors) {
              Object.keys(data.errors).forEach(field => {
                const input = contactForm.querySelector(`[name="${field}"]`);
                if (input) {
                  input.classList.add('border-red-500');
                  input.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                  });
                }
              });
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          messageDiv.className = 'mb-6 p-4 rounded-xl bg-red-100 text-red-800 border border-red-200';
          messageDiv.textContent = 'Une erreur est survenue. Veuillez réessayer.';
          messageDiv.classList.remove('hidden');
        })
        .finally(() => {
          // Reset loading state
          submitBtn.disabled = false;
          submitText.classList.remove('hidden');
          submitLoading.classList.add('hidden');
        });
      });
    });

    // Hero functionality is now handled by the hero components

    // Reviews Carousel
    (function() {
      const carouselTrack = document.getElementById('reviewsCarouselTrack');
      const prevButton = document.querySelector('.reviews-carousel-prev');
      const nextButton = document.querySelector('.reviews-carousel-next');
      
      if (!carouselTrack) return;
      
      let currentIndex = 0;
      const slides = carouselTrack.querySelectorAll('.reviews-carousel-slide');
      const totalSlides = slides.length;
      
      if (totalSlides === 0) return;
      
      // Determine how many slides to show at once based on screen size
      function getSlidesToShow() {
        if (window.innerWidth >= 1024) return 3; // lg: 3 slides
        if (window.innerWidth >= 768) return 2;  // md: 2 slides
        return 1; // sm: 1 slide
      }
      
      function updateCarousel() {
        const slidesToShow = getSlidesToShow();
        const maxIndex = Math.max(0, totalSlides - slidesToShow);
        
        // Clamp currentIndex to valid range
        if (currentIndex > maxIndex) {
          currentIndex = maxIndex;
        }
        
        // Calculate translateX based on slide width
        // Each slide takes 100% / slidesToShow of the container width
        const slideWidthPercent = 100 / slidesToShow;
        const translateX = -(currentIndex * slideWidthPercent);
        carouselTrack.style.transform = `translateX(${translateX}%)`;
        
        // Update button states
        if (prevButton) {
          prevButton.disabled = currentIndex === 0;
          prevButton.style.opacity = currentIndex === 0 ? '0.5' : '1';
          prevButton.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
          prevButton.style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';
        }
        
        if (nextButton) {
          nextButton.disabled = currentIndex >= maxIndex;
          nextButton.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
          nextButton.style.cursor = currentIndex >= maxIndex ? 'not-allowed' : 'pointer';
          nextButton.style.pointerEvents = currentIndex >= maxIndex ? 'none' : 'auto';
        }
      }
      
      // Navigation functions
      function goToNext() {
        const slidesToShow = getSlidesToShow();
        const maxIndex = Math.max(0, totalSlides - slidesToShow);
        if (currentIndex < maxIndex) {
          currentIndex++;
          updateCarousel();
        }
      }
      
      function goToPrev() {
        if (currentIndex > 0) {
          currentIndex--;
          updateCarousel();
        }
      }
      
      // Event listeners
      if (nextButton) {
        nextButton.addEventListener('click', goToNext);
      }
      
      if (prevButton) {
        prevButton.addEventListener('click', goToPrev);
      }
      
      // Handle window resize
      let resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          currentIndex = 0; // Reset to first slide on resize
          updateCarousel();
        }, 250);
      });
      
      // Initialize
      updateCarousel();
      
      // Auto-play (optional - can be enabled/disabled)
      let autoplayInterval = null;
      const autoplayEnabled = true; // Set to false to disable autoplay
      const autoplayDelay = 5000; // 5 seconds
      
      function startAutoplay() {
        if (!autoplayEnabled) return;
        
        autoplayInterval = setInterval(function() {
          const slidesToShow = getSlidesToShow();
          const maxIndex = Math.max(0, totalSlides - slidesToShow);
          
          if (currentIndex >= maxIndex) {
            currentIndex = 0; // Loop back to start
          } else {
            currentIndex++;
          }
          updateCarousel();
        }, autoplayDelay);
      }
      
      function stopAutoplay() {
        if (autoplayInterval) {
          clearInterval(autoplayInterval);
          autoplayInterval = null;
        }
      }
      
      // Pause autoplay on hover
      const carouselContainer = document.querySelector('.reviews-carousel-container');
      if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', stopAutoplay);
        carouselContainer.addEventListener('mouseleave', startAutoplay);
      }
      
      // Start autoplay
      startAutoplay();
      
      // Cleanup on page unload
      window.addEventListener('beforeunload', function() {
        stopAutoplay();
      });
    })();
  </script>
</body>
</html>