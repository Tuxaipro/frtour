async function loadHeader() {
  const headerContainer = document.getElementById('header-container');
  if (headerContainer) {
    // Fetch destinations and logo settings dynamically
    let destinationsHtml = '';
    let logoHtml = '';
    
    try {
      // Fetch destinations
      const destinationsResponse = await fetch('/api/destinations');
      const destinations = await destinationsResponse.json();
      
      destinationsHtml = destinations.map(destination => 
        `<a href="/destinations/${destination.slug}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">${destination.name}</a>`
      ).join('');
      
      // Fetch logo settings
      const logoResponse = await fetch('/api/logo-settings');
      const logoSettings = await logoResponse.json();
      
      // Generate logo HTML
      if (logoSettings.site_logo_url) {
        logoHtml = `
          <a href="/" class="flex items-center space-x-3">
            <img src="${logoSettings.site_logo_url}" alt="${logoSettings.site_name}" class="h-12 w-auto">
          </a>
        `;
      } else {
        logoHtml = `
          <a href="/" class="flex items-center space-x-3">
            <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
            </div>
          </a>
        `;
      }
      
    } catch (error) {
      console.error('Error loading header data:', error);
      // Fallback to static content
      destinationsHtml = `
        <a href="/north-india" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">Inde du Nord</a>
        <a href="/south-india" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">Inde du Sud</a>
        <a href="/sri-lanka" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">Sri Lanka</a>
        <a href="/nepal" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-primary">Népal</a>
      `;
      
      logoHtml = `
        <a href="/" class="flex items-center space-x-3">
          <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
          </div>
        </a>
      `;
    }

    headerContainer.innerHTML = `
      <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="flex items-center">
              ${logoHtml}
            </div>

            <!-- Navigation Menu -->
            <div class="hidden lg:flex items-center space-x-8">
              <a href="/" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Accueil</a>
              <div class="relative group">
                <a href="#" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200 flex items-center">
                  Circuits
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </a>
                <div class="absolute left-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-slate-200">
                  <div class="py-2">
                    ${destinationsHtml}
                  </div>
                </div>
              </div>
              <a href="/groupe" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Groupe</a>
              <a href="/#services" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Services</a>
              <a href="/galerie" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Galerie</a>
              <a href="/blog" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Blog</a>
              <a href="/#contact" class="text-slate-700 hover:text-primary font-medium transition-colors duration-200">Contact</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden lg:flex items-center">
              <a href="/#devis" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                Demander un devis
              </a>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
              <button type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                <span class="sr-only">Ouvrir le menu principal</span>
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Mobile menu -->
        <div class="lg:hidden hidden" id="mobile-menu">
          <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-slate-200">
            <a href="/" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Accueil</a>
            <a href="/#circuits" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Circuits</a>
            <a href="/groupe" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Groupe</a>
            <a href="/#services" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Services</a>
            <a href="/galerie" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Galerie</a>
            <a href="/blog" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Blog</a>
            <a href="/#contact" class="text-slate-700 hover:text-primary block px-3 py-2 text-base font-medium">Contact</a>
            <div class="pt-4 px-3">
              <a href="/#devis" class="bg-primary hover:bg-primary-dark text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center justify-center w-full">
                Demander un devis
              </a>
            </div>
          </div>
        </div>
      </nav>
    `;
  }
}

function toggleMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  if (mobileMenu) {
    mobileMenu.classList.toggle('hidden');
  }
}

// Load header when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  loadHeader();
});
