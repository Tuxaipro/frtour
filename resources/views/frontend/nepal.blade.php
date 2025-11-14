<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Circuits Népal - India Tourisme</title>
  
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
    
    .dropdown {
      position: relative;
    }
    
    .dropdown-content {
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      min-width: 200px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      border-radius: 8px;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 1000;
    }
    
    .dropdown:hover .dropdown-content {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .dropdown-content a {
      display: block;
      padding: 12px 16px;
      color: #374151;
      text-decoration: none;
      transition: background-color 0.2s;
    }
    
    .dropdown-content a:hover {
      background-color: #f3f4f6;
    }
    
    .dropdown-content a:first-child {
      border-radius: 8px 8px 0 0;
    }
    
    .dropdown-content a:last-child {
      border-radius: 0 0 8px 8px;
    }
    
    .dropdown-arrow {
      transition: transform 0.3s ease;
    }
    
    .rotate-180 {
      transform: rotate(180deg);
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
          setTimeout(function() {
            loader.remove();
          }, 500);
        }
      }, 300);
    });
  </script>

  <!-- Navigation -->
  @php
    include resource_path('views/includes/navigation.php');
  @endphp

<!-- Hero Section -->
  <section class="relative bg-gradient-to-r from-blue-50 to-purple-50 py-16 sm:py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-slate-900 mb-6 leading-tight">
          Circuits <span class="gradient-text">Népal</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
          Découvrez le toit du monde avec ses sommets majestueux, ses temples sacrés et sa culture himalayenne unique
        </p>
        <a href="#circuits" class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-200 shadow-lg hover:shadow-xl">
          Découvrir nos circuits
        </a>
      </div>
    </div>
  </section>

  <!-- Destinations Section -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Destinations emblématiques du Népal
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          De Katmandou aux camps de base de l'Everest, explorez la diversité culturelle et naturelle de l'Himalaya
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Katmandou -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-red-400 to-orange-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Katmandou</h3>
            <p class="text-gray-600 mb-4">Capitale historique aux temples millénaires et palais royaux</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Place Durbar</li>
              <li>• Temple de Pashupatinath</li>
              <li>• Stupa de Boudhanath</li>
            </ul>
          </div>
        </div>
        
        <!-- Pokhara -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-teal-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Pokhara</h3>
            <p class="text-gray-600 mb-4">Porte d'entrée de l'Annapurna avec son lac paisible</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Lac Phewa</li>
              <li>• Temple de Tal Barahi</li>
              <li>• Sarangkot - Lever de soleil</li>
            </ul>
          </div>
        </div>
        
        <!-- Chitwan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-emerald-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Parc de Chitwan</h3>
            <p class="text-gray-600 mb-4">Réserve naturelle abritant rhinocéros et tigres du Bengale</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Safari à dos d'éléphant</li>
              <li>• Observation des rhinocéros</li>
              <li>• Culture Tharu</li>
            </ul>
          </div>
        </div>
        
        <!-- Lumbini -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Lumbini</h3>
            <p class="text-gray-600 mb-4">Lieu de naissance du Bouddha, site de pèlerinage mondial</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Temple de Maya Devi</li>
              <li>• Pilier d'Ashoka</li>
              <li>• Monastères internationaux</li>
            </ul>
          </div>
        </div>
        
        <!-- Everest -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-gray-400 to-blue-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Région de l'Everest</h3>
            <p class="text-gray-600 mb-4">Trekking vers le camp de base du plus haut sommet du monde</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Namche Bazaar</li>
              <li>• Monastère de Tengboche</li>
              <li>• Camp de base Everest</li>
            </ul>
          </div>
        </div>
        
        <!-- Annapurna -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Circuit des Annapurnas</h3>
            <p class="text-gray-600 mb-4">Trek légendaire à travers villages et cols d'altitude</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Col de Thorong La</li>
              <li>• Muktinath Temple</li>
              <li>• Villages Gurung</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Circuits Section -->
  <section id="circuits" class="py-20 bg-gray-50 scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Nos circuits au Népal
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Des aventures authentiques entre culture himalayenne et treks d'exception
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Circuit 1 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-blue-600 bg-blue-100 px-3 py-1 rounded-full">8 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,290€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Découverte Culturelle</h3>
            <p class="text-gray-600 mb-4">Immersion dans la culture népalaise et les sites UNESCO</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Katmandou - Vallée sacrée</li>
              <li>• Bhaktapur - Cité médiévale</li>
              <li>• Pokhara - Lac et montagnes</li>
              <li>• Lumbini - Lieu de naissance du Bouddha</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 2 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-blue-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-blue-600 bg-blue-100 px-3 py-1 rounded-full">12 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,890€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Trek Annapurna Base Camp</h3>
            <p class="text-gray-600 mb-4">Trekking accessible vers le sanctuaire des Annapurnas</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Pokhara - Point de départ</li>
              <li>• Villages Gurung et Magar</li>
              <li>• Annapurna Base Camp (4130m)</li>
              <li>• Panorama sur l'Annapurna</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 3 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-gray-400 to-blue-600"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-blue-600 bg-blue-100 px-3 py-1 rounded-full">16 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 2,890€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Trek Everest Base Camp</h3>
            <p class="text-gray-600 mb-4">L'aventure ultime vers le camp de base de l'Everest</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Vol Lukla - Porte de l'Everest</li>
              <li>• Namche Bazaar - Capitale sherpa</li>
              <li>• Everest Base Camp (5364m)</li>
              <li>• Kala Patthar - Vue sur l'Everest</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load common components -->
  <script src="/components/footer.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      loadFooter();
    });
  </script>
</body>
</html>

