<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Circuits Sri Lanka - India Tourisme</title>
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
            'sans': ['Inter', 'system-ui', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    html { scroll-behavior: smooth; }
    
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
  </style>
</head>
<body class="bg-white">
  <!-- Header Container -->
  <div id="header-container"></div>

  <!-- Hero Section -->
  <section class="relative bg-gradient-to-r from-emerald-50 to-blue-50 py-16 sm:py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
          Circuits <span class="text-emerald-600">Sri Lanka</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
          Découvrez la perle de l'océan Indien avec ses temples bouddhistes, ses plantations de thé et ses plages paradisiaques
        </p>
        <a href="#circuits" class="inline-block bg-gradient-to-r from-emerald-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-200 shadow-lg hover:shadow-xl">
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
          Destinations incontournables du Sri Lanka
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          De Colombo aux plantations de thé, explorez la diversité culturelle et naturelle de l'île
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Colombo -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Colombo</h3>
            <p class="text-gray-600 mb-4">Capitale dynamique mêlant modernité et traditions coloniales</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Temple de Gangaramaya</li>
              <li>• Quartier de Pettah</li>
              <li>• Galle Face Green</li>
            </ul>
          </div>
        </div>
        
        <!-- Kandy -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-emerald-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Kandy</h3>
            <p class="text-gray-600 mb-4">Ancienne capitale royale et centre spirituel du bouddhisme</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Temple de la Dent</li>
              <li>• Lac de Kandy</li>
              <li>• Jardins botaniques de Peradeniya</li>
            </ul>
          </div>
        </div>
        
        <!-- Sigiriya -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-orange-400 to-red-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Sigiriya</h3>
            <p class="text-gray-600 mb-4">Forteresse rocheuse et site archéologique emblématique</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Rocher du Lion</li>
              <li>• Fresques des Demoiselles</li>
              <li>• Jardins d'eau royaux</li>
            </ul>
          </div>
        </div>
        
        <!-- Ella -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-teal-400 to-green-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Ella</h3>
            <p class="text-gray-600 mb-4">Station de montagne au cœur des plantations de thé</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Nine Arch Bridge</li>
              <li>• Little Adam's Peak</li>
              <li>• Plantations de thé</li>
            </ul>
          </div>
        </div>
        
        <!-- Galle -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Galle</h3>
            <p class="text-gray-600 mb-4">Ville fortifiée au charme colonial hollandais</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Fort de Galle</li>
              <li>• Phare de Galle</li>
              <li>• Remparts historiques</li>
            </ul>
          </div>
        </div>
        
        <!-- Anuradhapura -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Anuradhapura</h3>
            <p class="text-gray-600 mb-4">Ancienne capitale et site archéologique bouddhiste</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Arbre de la Bodhi</li>
              <li>• Dagoba de Ruwanwelisaya</li>
              <li>• Palais de bronze</li>
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
          Nos circuits au Sri Lanka
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Des itinéraires authentiques pour découvrir toutes les facettes de la perle de l'océan Indien
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Circuit 1 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-emerald-400 to-blue-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">10 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,590€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Découverte Classique</h3>
            <p class="text-gray-600 mb-4">Circuit essentiel couvrant les sites incontournables du Sri Lanka</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Colombo - Capitale moderne</li>
              <li>• Kandy - Temple de la Dent</li>
              <li>• Sigiriya - Rocher du Lion</li>
              <li>• Galle - Fort colonial</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 2 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-teal-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">12 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,890€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Montagnes et Plantations</h3>
            <p class="text-gray-600 mb-4">Exploration des hauts plateaux et des plantations de thé</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Nuwara Eliya - Petite Angleterre</li>
              <li>• Ella - Nine Arch Bridge</li>
              <li>• Usines de thé traditionnelles</li>
              <li>• Train panoramique</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 3 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">14 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 2,290€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Grand Tour Complet</h3>
            <p class="text-gray-600 mb-4">Circuit exhaustif incluant culture, nature et détente balnéaire</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Triangle culturel complet</li>
              <li>• Safari à Yala</li>
              <li>• Côte sud et plages</li>
              <li>• Expériences authentiques</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load common components -->
  <script src="/components/header.js"></script>
  <script src="/components/footer.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      loadHeader('circuits');
      loadFooter();
    });
  </script>
</body>
</html>
