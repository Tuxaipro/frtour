<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Circuits Inde du Nord — India Tourisme</title>
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
</head>
<body class="bg-white text-slate-900 font-sans antialiased">
  <!-- Navigation -->
  @php
    include resource_path('views/includes/navigation.php');
  @endphp

  <main>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 py-16 sm:py-20 lg:py-32 overflow-hidden">
      <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23F59E0B" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
      <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center max-w-4xl mx-auto">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-amber-100 border border-amber-200 text-amber-800 font-medium text-sm mb-8">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            Triangle d'Or & Rajasthan
          </div>
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-slate-900 mb-6 leading-tight">
            Circuits <span class="gradient-text">Inde du Nord</span>
          </h1>
          <p class="text-xl text-slate-600 mb-8 leading-relaxed">
            Découvrez les merveilles du Triangle d'Or, les palais du Rajasthan et les trésors de l'Inde du Nord. Des circuits sur-mesure pour une expérience inoubliable.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#circuits" class="bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
              Voir nos circuits
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Destinations Section -->
    <section id="destinations" class="py-16 sm:py-20 lg:py-24 bg-white">
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
            Destinations <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Incontournables</span>
          </h2>
          <p class="text-xl text-slate-600 max-w-3xl mx-auto">
            Explorez les joyaux de l'Inde du Nord, des monuments emblématiques aux villes sacrées
          </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Delhi -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-red-500 to-pink-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Delhi</h3>
                <p class="text-sm opacity-90">Capitale historique</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Découvrez la capitale indienne, mélange fascinant entre tradition et modernité, avec ses monuments moghols et ses marchés colorés.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• Red Fort & Jama Masjid</li>
                <li>• India Gate & Connaught Place</li>
                <li>• Chandni Chowk & Raj Ghat</li>
              </ul>
            </div>
          </div>

          <!-- Agra -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Agra</h3>
                <p class="text-sm opacity-90">Ville du Taj Mahal</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Admirez le Taj Mahal, merveille du monde, et explorez les autres joyaux architecturaux de cette ville historique.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• Taj Mahal au lever du soleil</li>
                <li>• Fort d'Agra & Mehtab Bagh</li>
                <li>• Tombeau d'Itimad-ud-Daulah</li>
              </ul>
            </div>
          </div>

          <!-- Jaipur -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-pink-500 to-rose-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Jaipur</h3>
                <p class="text-sm opacity-90">Ville Rose du Rajasthan</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Plongez dans l'atmosphère royale de la Ville Rose avec ses palais somptueux et ses bazars traditionnels.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• Palais des Vents & City Palace</li>
                <li>• Fort d'Amber & Nahargarh</li>
                <li>• Jantar Mantar & bazars</li>
              </ul>
            </div>
          </div>

          <!-- Varanasi -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-orange-500 to-yellow-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Varanasi</h3>
                <p class="text-sm opacity-90">Ville sacrée du Gange</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Vivez l'expérience spirituelle unique de la ville la plus sacrée de l'Inde sur les rives du Gange.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• Ghats du Gange & cérémonies</li>
                <li>• Temple de Kashi Vishwanath</li>
                <li>• Sarnath & musées</li>
              </ul>
            </div>
          </div>

          <!-- Udaipur -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-teal-500 to-blue-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Udaipur</h3>
                <p class="text-sm opacity-90">Venise de l'Orient</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Découvrez la romantique Ville des Lacs avec ses palais flottants et ses couchers de soleil magiques.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• City Palace & Lake Palace</li>
                <li>• Lac Pichola & Fateh Sagar</li>
                <li>• Jagdish Temple & jardins</li>
              </ul>
            </div>
          </div>

          <!-- Jodhpur -->
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-indigo-500 to-blue-600 relative overflow-hidden">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Jodhpur</h3>
                <p class="text-sm opacity-90">Ville Bleue</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Explorez la majestueuse Ville Bleue dominée par l'imposant fort de Mehrangarh.</p>
              <ul class="text-sm text-slate-500 space-y-1">
                <li>• Fort de Mehrangarh</li>
                <li>• Palais Umaid Bhawan</li>
                <li>• Vieille ville bleue & marchés</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Circuits Section -->
    <section id="circuits" class="py-16 sm:py-20 lg:py-24 bg-slate-50">
      <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
          <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
            Nos <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-red-600">Circuits</span>
          </h2>
          <p class="text-xl text-slate-600 max-w-3xl mx-auto">
            Des itinéraires soigneusement conçus pour découvrir les merveilles de l'Inde du Nord
          </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Triangle d'Or Classique -->
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-amber-500 to-orange-600 relative">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute top-4 right-4">
                <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">7 jours</span>
              </div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Triangle d'Or Classique</h3>
                <p class="text-sm opacity-90">Delhi - Agra - Jaipur</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Le circuit incontournable pour une première découverte de l'Inde du Nord. Visitez les trois villes emblématiques du Triangle d'Or.</p>
              <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Taj Mahal au lever du soleil
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Palais des Vents & Fort d'Amber
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Red Fort & Jama Masjid
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-slate-900">À partir de 890€</div>
              </div>
            </div>
          </div>

          <!-- Rajasthan Royal -->
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-pink-500 to-purple-600 relative">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute top-4 right-4">
                <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">12 jours</span>
              </div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Rajasthan Royal</h3>
                <p class="text-sm opacity-90">Palais & Déserts</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Immersion totale dans l'univers des maharajas avec les plus beaux palais du Rajasthan et une nuit dans le désert du Thar.</p>
              <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Nuit dans le désert de Jaisalmer
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Palais flottant d'Udaipur
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Fort de Mehrangarh à Jodhpur
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-slate-900">À partir de 1590€</div>
              </div>
            </div>
          </div>

          <!-- Spirituel & Culturel -->
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-orange-500 to-red-600 relative">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute top-4 right-4">
                <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">10 jours</span>
              </div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Spirituel & Culturel</h3>
                <p class="text-sm opacity-90">Varanasi - Rishikesh - Haridwar</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Découvrez l'Inde spirituelle avec Varanasi, la ville sacrée, et Rishikesh, capitale mondiale du yoga.</p>
              <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Cérémonie Ganga Aarti à Varanasi
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Séances de yoga à Rishikesh
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Temples et ashrams
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-slate-900">À partir de 1290€</div>
              </div>
            </div>
          </div>

          <!-- Grand Tour du Nord -->
          <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="h-64 bg-gradient-to-br from-emerald-500 to-teal-600 relative">
              <div class="absolute inset-0 bg-black/20"></div>
              <div class="absolute top-4 right-4">
                <span class="bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium">15 jours</span>
              </div>
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-2xl font-bold mb-2">Grand Tour du Nord</h3>
                <p class="text-sm opacity-90">Circuit complet</p>
              </div>
            </div>
            <div class="p-6">
              <p class="text-slate-600 mb-4">Le circuit le plus complet pour découvrir toutes les facettes de l'Inde du Nord, des monuments aux traditions.</p>
              <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Triangle d'Or + Rajasthan
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Varanasi & villes sacrées
                </div>
                <div class="flex items-center text-sm text-slate-600">
                  <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  Expériences authentiques
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-slate-900">À partir de 2190€</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load Common Components -->
  <script src="/components/footer.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      loadFooter();
    });
  </script>
</body>
</html>
