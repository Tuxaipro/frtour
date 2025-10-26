<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Circuits Inde du Sud - India Tourisme</title>
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
  </style>
</head>
<body class="bg-white">
  <!-- Header Container -->
  <div id="header-container"></div>

  <!-- Hero Section -->
  <section class="relative bg-gradient-to-r from-amber-50 to-red-50 py-16 sm:py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
          Circuits <span class="text-amber-600">Inde du Sud</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
          Découvrez la richesse culturelle et spirituelle de l'Inde du Sud avec nos circuits authentiques
        </p>
        <a href="#circuits" class="inline-block bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-200 shadow-lg hover:shadow-xl">
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
          Destinations phares de l'Inde du Sud
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Explorez les temples majestueux, les backwaters paisibles et les traditions millénaires
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Chennai -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-amber-400 to-red-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Chennai</h3>
            <p class="text-gray-600 mb-4">Porte d'entrée de l'Inde du Sud, mélange de tradition et modernité</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Temple de Kapaleeshwarar</li>
              <li>• Marina Beach</li>
              <li>• Fort St. George</li>
            </ul>
          </div>
        </div>
        
        <!-- Kochi -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-blue-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Kochi (Cochin)</h3>
            <p class="text-gray-600 mb-4">Perle du Kerala avec ses filets de pêche chinois emblématiques</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Fort Kochi</li>
              <li>• Filets de pêche chinois</li>
              <li>• Palais de Mattancherry</li>
            </ul>
          </div>
        </div>
        
        <!-- Backwaters -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-blue-400 to-green-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Backwaters d'Alleppey</h3>
            <p class="text-gray-600 mb-4">Navigation paisible sur les canaux du Kerala</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Houseboats traditionnels</li>
              <li>• Villages flottants</li>
              <li>• Rizières verdoyantes</li>
            </ul>
          </div>
        </div>
        
        <!-- Madurai -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Madurai</h3>
            <p class="text-gray-600 mb-4">Ville sacrée aux temples spectaculaires</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Temple de Meenakshi</li>
              <li>• Palais de Thirumalai Nayak</li>
              <li>• Marché aux fleurs</li>
            </ul>
          </div>
        </div>
        
        <!-- Mysore -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Mysore</h3>
            <p class="text-gray-600 mb-4">Cité des palais et capitale culturelle du Karnataka</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Palais de Mysore</li>
              <li>• Marché de Devaraja</li>
              <li>• Colline de Chamundi</li>
            </ul>
          </div>
        </div>
        
        <!-- Pondichéry -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-red-400 to-yellow-500"></div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Pondichéry</h3>
            <p class="text-gray-600 mb-4">Charme français au cœur de l'Inde du Sud</p>
            <ul class="text-sm text-gray-500 space-y-1">
              <li>• Quartier français</li>
              <li>• Ashram de Sri Aurobindo</li>
              <li>• Auroville</li>
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
          Nos circuits en Inde du Sud
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Des itinéraires soigneusement conçus pour découvrir l'authenticité du Sud de l'Inde
        </p>
      </div>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Circuit 1 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-green-400 to-blue-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-amber-600 bg-amber-100 px-3 py-1 rounded-full">12 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,890€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Kerala Authentique</h3>
            <p class="text-gray-600 mb-4">Découverte complète du Kerala : backwaters, plantations d'épices et plages</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Kochi - Fort Kochi</li>
              <li>• Munnar - Plantations de thé</li>
              <li>• Alleppey - Backwaters</li>
              <li>• Kovalam - Plages</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 2 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-purple-400 to-pink-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-amber-600 bg-amber-100 px-3 py-1 rounded-full">10 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 1,650€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Temples du Tamil Nadu</h3>
            <p class="text-gray-600 mb-4">Circuit spirituel à travers les temples dravidiens les plus spectaculaires</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Chennai - Capitale culturelle</li>
              <li>• Mahabalipuram - Temples sculptés</li>
              <li>• Pondichéry - Charme français</li>
              <li>• Madurai - Temple de Meenakshi</li>
            </ul>
          </div>
        </div>
        
        <!-- Circuit 3 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
          <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500"></div>
          <div class="p-6">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-amber-600 bg-amber-100 px-3 py-1 rounded-full">14 jours</span>
              <span class="text-lg font-bold text-gray-900">À partir de 2,190€</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Grand Tour du Sud</h3>
            <p class="text-gray-600 mb-4">Circuit complet combinant Kerala, Tamil Nadu et Karnataka</p>
            <ul class="text-sm text-gray-500 space-y-1 mb-4">
              <li>• Bangalore - Mysore</li>
              <li>• Ooty - Stations de montagne</li>
              <li>• Kerala - Backwaters</li>
              <li>• Tamil Nadu - Temples</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load Common Components -->
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
