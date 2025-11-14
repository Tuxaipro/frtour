<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voyages de Groupe - India Tourisme</title>
  <!-- Tailwind CSS via Vite -->
  @php
      $hasViteManifest = file_exists(public_path('build/manifest.json'));
  @endphp
  
  @if($hasViteManifest)
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
      <!-- Fallback for development without Vite build -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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

  <main class="overflow-hidden">

<!-- Hero Section -->
  <section class="relative py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-primary via-primary-dark to-accent min-h-[500px] flex items-center justify-center">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-4xl mx-auto fade-in">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold text-sm mb-8">
          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
          </svg>
          Groupes & Entreprises
        </div>
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
          Voyages de <span class="text-white/90">Groupe</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto font-light leading-relaxed">
          Organisez des voyages inoubliables pour vos groupes : familles, amis, entreprises ou associations. Des circuits sur-mesure avec des tarifs préférentiels
        </p>
      </div>
    </div>
  </section>

  <!-- Avantages Section -->
  <section class="py-20 sm:py-24 lg:py-32 bg-gradient-to-b from-white via-primary-50/30 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16 fade-in">
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
          Pourquoi choisir nos <span class="gradient-text">voyages de groupe</span> ?
        </h2>
        <p class="text-xl text-slate-600 max-w-3xl mx-auto font-light">
          Des avantages exclusifs pour vos groupes de 8 personnes ou plus
        </p>
    </div>
    
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 fade-in">
        <div class="text-center group">
          <div class="w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
          </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-900 mb-3">Tarifs préférentiels</h3>
          <p class="text-slate-600 leading-relaxed">Jusqu'à 20% de réduction sur nos tarifs individuels</p>
      </div>
      
        <div class="text-center group">
          <div class="w-20 h-20 bg-gradient-to-br from-accent to-accent-dark rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-900 mb-3">Guide dédié</h3>
          <p class="text-slate-600 leading-relaxed">Un guide francophone exclusif pour votre groupe</p>
        </div>
        
        <div class="text-center group">
          <div class="w-20 h-20 bg-gradient-to-br from-sunset to-sunset-dark rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-900 mb-3">Organisation sur-mesure</h3>
          <p class="text-slate-600 leading-relaxed">Itinéraires personnalisés selon vos souhaits</p>
      </div>
      
        <div class="text-center group">
          <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-dark rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:shadow-2xl transition-all duration-300 group-hover:scale-110">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-slate-900 mb-3">Support 24/7</h3>
          <p class="text-slate-600 leading-relaxed">Assistance permanente pendant votre voyage</p>
      </div>
    </div>
  </div>
</section>

  <!-- Types de Groupes Section -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16 fade-in">
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
          Nos spécialités de <span class="gradient-text">groupes</span>
        </h2>
        <p class="text-xl text-slate-600 max-w-3xl mx-auto font-light">
          Des expériences adaptées à chaque type de groupe
        </p>
    </div>
    
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Familles -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-pink-400 to-rose-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Familles</h3>
            <p class="text-gray-600 mb-4">Voyages intergénérationnels avec des activités adaptées à tous les âges</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Activités pour enfants et ados</li>
              <li>• Hébergements familiaux</li>
              <li>• Rythme adapté aux seniors</li>
              <li>• Repas variés et équilibrés</li>
            </ul>
          </div>
        </div>
        
        <!-- Entreprises -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-indigo-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Entreprises</h3>
            <p class="text-gray-600 mb-4">Séminaires, incentives et team building dans des lieux exceptionnels</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Salles de réunion équipées</li>
              <li>• Activités de cohésion</li>
              <li>• Dîners d'entreprise</li>
              <li>• Transport privé</li>
            </ul>
          </div>
        </div>
        
        <!-- Associations -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-emerald-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Associations</h3>
            <p class="text-gray-600 mb-4">Voyages culturels et solidaires pour vos membres</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Rencontres locales</li>
              <li>• Projets solidaires</li>
              <li>• Visites culturelles approfondies</li>
              <li>• Tarifs associatifs</li>
            </ul>
        </div>
      </div>
      
        <!-- Amis -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Groupes d'amis</h3>
            <p class="text-gray-600 mb-4">Aventures entre amis avec des activités fun et originales</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Activités sportives</li>
              <li>• Soirées festives</li>
              <li>• Découvertes culinaires</li>
              <li>• Moments de détente</li>
            </ul>
          </div>
        </div>
        
        <!-- Seniors -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Groupes seniors</h3>
            <p class="text-gray-600 mb-4">Voyages confortables avec un rythme adapté</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Rythme de marche modéré</li>
              <li>• Hébergements confortables</li>
              <li>• Assistance médicale</li>
              <li>• Visites culturelles</li>
            </ul>
          </div>
        </div>
        
        <!-- Étudiants -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-teal-400 to-cyan-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Groupes étudiants</h3>
            <p class="text-gray-600 mb-4">Voyages éducatifs et découverte à petit budget</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Tarifs étudiants</li>
              <li>• Hébergements économiques</li>
              <li>• Visites éducatives</li>
              <li>• Rencontres locales</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Circuits Groupe Section -->
  <section id="circuits" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
          Nos circuits groupe <span class="gradient-text">populaires</span>
        </h2>
        <p class="text-xl text-slate-600 max-w-3xl mx-auto font-light">
          Des itinéraires testés et approuvés par nos groupes
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Circuit 1 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200">
          <div class="h-48 bg-gradient-to-br from-amber-400 to-orange-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-purple-600 bg-purple-100 px-3 py-1 rounded-full">12 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,290€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Triangle d'Or Groupe</h3>
            <p class="text-gray-600 mb-4">Circuit classique parfait pour un premier voyage en groupe</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Delhi - Agra - Jaipur</li>
              <li>• Guide francophone dédié</li>
              <li>• Transport privé</li>
              <li>• Hôtels 4*</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 2 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200">
          <div class="h-48 bg-gradient-to-br from-green-400 to-teal-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-purple-600 bg-purple-100 px-3 py-1 rounded-full">15 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,890€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Rajasthan Complet</h3>
            <p class="text-gray-600 mb-4">Découverte complète du Rajasthan avec des expériences uniques</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• 6 villes du Rajasthan</li>
              <li>• Nuit dans le désert</li>
              <li>• Spectacles traditionnels</li>
              <li>• Hôtels de charme</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 3 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-200">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-purple-600 bg-purple-100 px-3 py-1 rounded-full">18 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 2,490€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Grand Tour Inde</h3>
            <p class="text-gray-600 mb-4">Circuit complet Nord + Sud pour une découverte totale</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Triangle d'Or + Kerala</li>
              <li>• Backwaters en houseboat</li>
              <li>• Vols intérieurs inclus</li>
              <li>• Guide expert</li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- Footer Container -->
  <div id="footer-container"></div>

  </main>

  <!-- Load common components -->
  <script src="/components/footer.js"></script>
  <script>
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
</body>
</html>