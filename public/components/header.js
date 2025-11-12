async function loadHeader() {
  const headerContainer = document.getElementById('header-container');
  if (headerContainer) {
    // Return a promise for proper async handling
    return new Promise(async (resolve) => {
    // Fetch destinations and logo settings dynamically
    let destinationsHtml = '';
    let logoHtml = '';
    
    try {
      // Fetch destinations
      const destinationsResponse = await fetch('/api/destinations');
      if (!destinationsResponse.ok) {
        throw new Error(`HTTP error! status: ${destinationsResponse.status}`);
      }
      const destinations = await destinationsResponse.json();
      
      if (destinations.error) {
        throw new Error(destinations.message || destinations.error);
      }
      
      destinationsHtml = destinations.map(destination => 
        `<a href="/destinations/${destination.slug}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-primary/5 hover:text-primary transition-colors duration-200 rounded-lg mx-1">${destination.name}</a>`
      ).join('');
      
      // Fetch logo settings
      const logoResponse = await fetch('/api/logo-settings');
      if (!logoResponse.ok) {
        throw new Error(`HTTP error! status: ${logoResponse.status}`);
      }
      const logoSettings = await logoResponse.json();
      
      if (logoSettings.error) {
        throw new Error(logoSettings.message || logoSettings.error);
      }
      
      // Generate logo HTML
      if (logoSettings.site_logo_url) {
        logoHtml = `
          <a href="/" class="flex items-center">
            <img src="${logoSettings.site_logo_url}" alt="${logoSettings.site_name}" class="h-12 w-auto">
          </a>
        `;
      } else {
        logoHtml = `
          <a href="/" class="flex items-center">
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
        <a href="/" class="flex items-center">
          <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
          </div>
        </a>
      `;
    }

    headerContainer.innerHTML = `
      <nav class="bg-white shadow-lg sticky top-0 z-50 border-b border-slate-200 sticky-header test-sticky" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); position: sticky; top: 0; z-index: 50;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center h-14">
            <!-- Logo Section -->
            <div class="flex items-center">
              ${logoHtml}
            </div>

            <!-- Navigation Menu -->
            <div class="hidden lg:flex items-center justify-end space-x-6 ml-auto">
              <a href="/" class="nav-link text-slate-700 hover:text-primary font-medium text-sm">Accueil</a>
              <div class="relative circuits-dropdown" id="circuits-dropdown">
                <button type="button" class="nav-link text-slate-700 hover:text-primary font-medium flex items-center text-sm bg-transparent border-none cursor-pointer p-0">
                  Circuits
                  <svg class="w-3 h-3 ml-1 transition-transform duration-200" id="circuits-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>
                <div class="circuits-menu absolute left-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl opacity-0 invisible transition-all duration-300 z-50 border border-slate-200" id="circuits-menu" style="background-color: rgba(255, 255, 255, 0.98); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
                  <div class="py-2">
                    ${destinationsHtml}
                  </div>
                </div>
              </div>
              <a href="/groupe" class="nav-link text-slate-700 hover:text-primary font-medium text-sm">Groupe</a>
              <a href="/galerie" class="nav-link text-slate-700 hover:text-primary font-medium text-sm">Galerie</a>
              <a href="/blog" class="nav-link text-slate-700 hover:text-primary font-medium text-sm">Blog</a>
              <a href="/#contact" class="nav-link text-slate-700 hover:text-primary font-medium text-sm">Contact</a>
              <a href="/#devis" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                Demander un devis
              </a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center lg:hidden">
              <button type="button" id="mobile-menu-button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Ouvrir le menu principal</span>
                <svg id="mobile-menu-open-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="mobile-menu-close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Mobile menu -->
        <div class="lg:hidden hidden" id="mobile-menu">
          <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-slate-200" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
            <a href="/" class="nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium">Accueil</a>
            
            <!-- Mobile Destinations Dropdown -->
            <div class="relative">
              <button type="button" id="mobile-circuits-toggle" class="w-full text-left nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium flex items-center justify-between">
                <span>Circuits</span>
                <svg id="mobile-circuits-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div id="mobile-circuits-menu" class="hidden pl-4 mt-1 space-y-1">
                ${destinationsHtml}
              </div>
            </div>
            
            <a href="/groupe" class="nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium">Groupe</a>
            <a href="/galerie" class="nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium">Galerie</a>
            <a href="/blog" class="nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium">Blog</a>
            <a href="/#contact" class="nav-link text-slate-700 hover:text-primary block px-3 py-2 text-sm font-medium">Contact</a>
            <div class="pt-3 px-3">
              <a href="/#devis" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 inline-flex items-center justify-center w-full text-sm">
                Demander un devis
              </a>
            </div>
          </div>
        </div>
      </nav>
    `;
      resolve();
    });
  }
  return Promise.resolve();
}

function toggleMobileMenu() {
  const mobileMenu = document.getElementById('mobile-menu');
  const menuButton = document.getElementById('mobile-menu-button');
  const openIcon = document.getElementById('mobile-menu-open-icon');
  const closeIcon = document.getElementById('mobile-menu-close-icon');
  
  if (mobileMenu && menuButton) {
    const isHidden = mobileMenu.classList.contains('hidden');
    
    if (isHidden) {
      mobileMenu.classList.remove('hidden');
      menuButton.setAttribute('aria-expanded', 'true');
      if (openIcon) openIcon.classList.add('hidden');
      if (closeIcon) closeIcon.classList.remove('hidden');
    } else {
      mobileMenu.classList.add('hidden');
      menuButton.setAttribute('aria-expanded', 'false');
      if (openIcon) openIcon.classList.remove('hidden');
      if (closeIcon) closeIcon.classList.add('hidden');
      
      // Also close circuits submenu if open
      const circuitsMenu = document.getElementById('mobile-circuits-menu');
      const circuitsArrow = document.getElementById('mobile-circuits-arrow');
      if (circuitsMenu) circuitsMenu.classList.add('hidden');
      if (circuitsArrow) circuitsArrow.classList.remove('rotate-180');
    }
  }
}

// Make toggleMobileMenu globally accessible
window.toggleMobileMenu = toggleMobileMenu;

// Setup mobile menu event listeners after header is loaded
function setupMobileMenu() {
  // Setup mobile menu button - use event listener instead of onclick
  const menuButton = document.getElementById('mobile-menu-button');
  if (menuButton) {
    // Remove any existing listeners by cloning and replacing
    const newButton = menuButton.cloneNode(true);
    menuButton.parentNode.replaceChild(newButton, menuButton);
    newButton.addEventListener('click', toggleMobileMenu);
  }
  
  // Setup mobile circuits dropdown
  const circuitsToggle = document.getElementById('mobile-circuits-toggle');
  const circuitsMenu = document.getElementById('mobile-circuits-menu');
  const circuitsArrow = document.getElementById('mobile-circuits-arrow');
  
  if (circuitsToggle && circuitsMenu) {
    circuitsToggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      circuitsMenu.classList.toggle('hidden');
      if (circuitsArrow) {
        circuitsArrow.classList.toggle('rotate-180');
      }
    });
  }
  
  // Close mobile menu when clicking on a link (but not on circuits toggle)
  const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
  mobileMenuLinks.forEach(link => {
    link.addEventListener('click', function() {
      // Small delay to allow navigation
  setTimeout(() => {
        toggleMobileMenu();
      }, 100);
    });
  });
  
  // Close mobile menu when clicking outside (only add once)
  if (!window.mobileMenuClickOutsideHandler) {
    window.mobileMenuClickOutsideHandler = function(event) {
      const mobileMenu = document.getElementById('mobile-menu');
      const menuButton = document.getElementById('mobile-menu-button');
      const circuitsToggle = document.getElementById('mobile-circuits-toggle');
      
      if (mobileMenu && menuButton && 
          !mobileMenu.contains(event.target) && 
          !menuButton.contains(event.target) &&
          !(circuitsToggle && circuitsToggle.contains(event.target))) {
        if (!mobileMenu.classList.contains('hidden')) {
          toggleMobileMenu();
        }
      }
    };
    document.addEventListener('click', window.mobileMenuClickOutsideHandler);
  }
}

// Store references to prevent duplicate listeners
let scrollHandler = null;
let anchorClickHandlers = [];

// Setup circuits dropdown menu
function setupCircuitsDropdown() {
  const dropdown = document.getElementById('circuits-dropdown');
  const menu = document.getElementById('circuits-menu');
  const arrow = document.getElementById('circuits-arrow');
  
  if (!dropdown || !menu) return;
  
  // Show menu on hover
  dropdown.addEventListener('mouseenter', function() {
    menu.classList.remove('opacity-0', 'invisible');
    menu.classList.add('opacity-100', 'visible');
    if (arrow) arrow.classList.add('rotate-180');
  });
  
  // Hide menu on mouse leave
  dropdown.addEventListener('mouseleave', function() {
    menu.classList.add('opacity-0', 'invisible');
    menu.classList.remove('opacity-100', 'visible');
    if (arrow) arrow.classList.remove('rotate-180');
  });
  
  // Also handle click for better mobile/tablet support
  const button = dropdown.querySelector('button');
  if (button) {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const isVisible = !menu.classList.contains('invisible');
      if (isVisible) {
        menu.classList.add('opacity-0', 'invisible');
        menu.classList.remove('opacity-100', 'visible');
        if (arrow) arrow.classList.remove('rotate-180');
      } else {
        menu.classList.remove('opacity-0', 'invisible');
        menu.classList.add('opacity-100', 'visible');
        if (arrow) arrow.classList.add('rotate-180');
      }
    });
  }
  
  // Close menu when clicking outside
  document.addEventListener('click', function(e) {
    if (!dropdown.contains(e.target)) {
      menu.classList.add('opacity-0', 'invisible');
      menu.classList.remove('opacity-100', 'visible');
      if (arrow) arrow.classList.remove('rotate-180');
    }
  });
}

// Enhanced sticky header behavior
function setupStickyHeader() {
  const header = document.querySelector('nav');
  if (!header) {
    return;
  }
  
  // Remove existing scroll handler if any
  if (scrollHandler) {
    window.removeEventListener('scroll', scrollHandler);
  }
  
  // Create throttled scroll handler to prevent excessive calls
  let ticking = false;
  scrollHandler = () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        const currentScrollY = window.scrollY;
        
        // Add/remove shadow based on scroll position
        if (currentScrollY > 10) {
          header.classList.add('shadow-lg');
          header.classList.remove('shadow-sm');
        } else {
          header.classList.add('shadow-sm');
          header.classList.remove('shadow-lg');
        }
        
        ticking = false;
      });
      ticking = true;
    }
  };
  
  window.addEventListener('scroll', scrollHandler, { passive: true });
  
  // Remove existing anchor link handlers
  anchorClickHandlers.forEach(handler => {
    handler.element.removeEventListener('click', handler.fn);
      });
  anchorClickHandlers = [];
      
      // Smooth scroll for anchor links
      const anchorLinks = document.querySelectorAll('a[href^="#"]');
      anchorLinks.forEach(link => {
    const clickHandler = function(e) {
          const href = this.getAttribute('href');
          if (href === '#') return;
          
          const target = document.querySelector(href);
          if (target) {
            e.preventDefault();
            const headerHeight = header.offsetHeight;
            const targetPosition = target.offsetTop - headerHeight - 20;
            
            window.scrollTo({
              top: targetPosition,
              behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
              mobileMenu.classList.add('hidden');
            }
          }
    };
    
    link.addEventListener('click', clickHandler);
    anchorClickHandlers.push({ element: link, fn: clickHandler });
  });
}

// Load header when DOM is ready
let headerLoaded = false;
document.addEventListener('DOMContentLoaded', function() {
  if (!headerLoaded) {
    headerLoaded = true;
    loadHeader().then(() => {
      // Setup sticky header, mobile menu, and circuits dropdown after header is loaded
      setTimeout(() => {
        setupStickyHeader();
        setupMobileMenu();
        setupCircuitsDropdown();
      }, 100);
    });
  }
});
