<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voyages de Groupe - India Tourisme</title>
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
  <section class="relative bg-gradient-to-r from-purple-50 to-indigo-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
          Voyages de <span class="text-purple-600">Groupe</span>
      </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
          Organisez des voyages inoubliables pour vos groupes : familles, amis, entreprises ou associations. Des circuits sur-mesure avec des tarifs préférentiels.
      </p>
    </div>
  </div>
</section>

  <!-- Avantages Section -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Pourquoi choisir nos voyages de groupe ?
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          Des avantages exclusifs pour vos groupes de 8 personnes ou plus
        </p>
    </div>
    
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
          </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Tarifs préférentiels</h3>
          <p class="text-gray-600">Jusqu'à 20% de réduction sur nos tarifs individuels</p>
      </div>
      
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Guide dédié</h3>
          <p class="text-gray-600">Un guide francophone exclusif pour votre groupe</p>
        </div>
        
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Organisation sur-mesure</h3>
          <p class="text-gray-600">Itinéraires personnalisés selon vos souhaits</p>
      </div>
      
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
          </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">Support 24/7</h3>
          <p class="text-gray-600">Assistance permanente pendant votre voyage</p>
      </div>
    </div>
  </div>
</section>

  <!-- Types de Groupes Section -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Nos spécialités de groupes
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
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
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Nos circuits groupe populaires
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
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