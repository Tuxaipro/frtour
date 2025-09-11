function loadFooter() {
  const footerContainer = document.getElementById('footer-container');
  if (footerContainer) {
    footerContainer.innerHTML = `
      <footer class="bg-slate-900 text-white">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-16">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="lg:col-span-2">
              <div class="flex items-center mb-4">
                <h3 class="text-2xl font-bold text-white">India Tourisme</h3>
              </div>
              <p class="text-slate-300 mb-6 max-w-md">
                Spécialiste des voyages sur-mesure en Inde, Sri Lanka, Népal et Bhoutan. 
                Circuits privés avec chauffeurs francophones et assistance 24/7.
              </p>
              <div class="flex space-x-4">
                <a href="https://wa.me/XXXXXXXXXXX" class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-full transition-colors duration-200">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                  </svg>
                </a>
                <a href="mailto:contact@indiatourisme.fr" class="bg-slate-700 hover:bg-slate-600 text-white p-3 rounded-full transition-colors duration-200">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </a>
                <a href="https://calendly.com/votre-calendly/rdv-15min" class="bg-slate-700 hover:bg-slate-600 text-white p-3 rounded-full transition-colors duration-200">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                </a>
              </div>
            </div>

            <!-- Quick Links -->
            <div>
              <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
              <ul class="space-y-3">
                <li><a href="/#circuits" class="text-slate-300 hover:text-white transition-colors duration-200">Nos circuits</a></li>
                <li><a href="/groupe" class="text-slate-300 hover:text-white transition-colors duration-200">Voyages de groupe</a></li>
                <li><a href="/#devis" class="text-slate-300 hover:text-white transition-colors duration-200">Demander un devis</a></li>
                <li><a href="/#blog" class="text-slate-300 hover:text-white transition-colors duration-200">Blog voyage</a></li>
                <li><a href="/galerie" class="text-slate-300 hover:text-white transition-colors duration-200">Galerie photos</a></li>
                <li><a href="/#contact" class="text-slate-300 hover:text-white transition-colors duration-200">Contact</a></li>
              </ul>
            </div>

            <!-- Destinations -->
            <div>
              <h4 class="text-lg font-semibold mb-4">Destinations</h4>
              <ul class="space-y-3">
                <li><a href="/north-india" class="text-slate-300 hover:text-white transition-colors duration-200">🇮🇳 Inde du Nord</a></li>
                <li><a href="/south-india" class="text-slate-300 hover:text-white transition-colors duration-200">🇮🇳 Inde du Sud</a></li>
                <li><a href="/sri-lanka" class="text-slate-300 hover:text-white transition-colors duration-200">🇱🇰 Sri Lanka</a></li>
                <li><a href="/nepal" class="text-slate-300 hover:text-white transition-colors duration-200">🇳🇵 Népal</a></li>
                <li><a href="#" class="text-slate-300 hover:text-white transition-colors duration-200">🇧🇹 Bhoutan</a></li>
                <li><a href="/groupe" class="text-slate-300 hover:text-white transition-colors duration-200">Groupes</a></li>
              </ul>
            </div>
          </div>

          <!-- Bottom Section -->
          <div class="border-t border-slate-700 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
              <div class="text-slate-400 text-sm mb-4 md:mb-0">
                © 2025 India Tourisme. Tous droits réservés.
              </div>
              <div class="flex space-x-6 text-sm">
                <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">Mentions légales</a>
                <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">Politique de confidentialité</a>
                <a href="#" class="text-slate-400 hover:text-white transition-colors duration-200">CGV</a>
              </div>
            </div>
            
            <!-- Certifications -->
            <div class="mt-6 flex flex-wrap items-center justify-center space-x-6 text-xs text-slate-400">
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                DMC certifié ISO 9001:2015
              </div>
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
                Assurance RC Pro
              </div>
              <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                Garantie financière
              </div>
            </div>
          </div>
        </div>
      </footer>
    `;
  }
}

// Load footer when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
  loadFooter();
});
