<?php
use App\Models\Destination;
use App\Models\Setting;

// Get destinations for dropdown
$destinations = Destination::where('is_active', true)->orderBy('name')->get();

// Get logo and site name from settings
$logoSetting = Setting::where('key', 'site_logo')->first();
$siteNameSetting = Setting::where('key', 'site_name')->first();
$siteName = $siteNameSetting ? trim($siteNameSetting->value, '"') : 'India Tourisme';

$logoUrl = '';
if ($logoSetting && $logoSetting->value) {
    $logoPath = trim($logoSetting->value, '"');
    if (str_starts_with($logoPath, 'storage/')) {
        $logoUrl = asset($logoPath);
    } else {
        $logoUrl = asset('storage/' . $logoPath);
    }
}

// Check if we're on a destination page
$isDestinationPage = str_starts_with($_SERVER['REQUEST_URI'], '/destinations/');
?>

<nav id="main-navigation" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3">
                    <?php if($logoUrl): ?>
                        <img src="<?php echo $logoUrl; ?>" alt="<?php echo htmlspecialchars($siteName); ?>" class="h-10 w-auto">
                    <?php else: ?>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-display font-bold text-slate-900"><?php echo htmlspecialchars($siteName); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-2">
                <a href="/" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/' ? 'active' : ''; ?> font-sans text-slate-700 hover:text-white hover:bg-primary font-semibold text-sm tracking-wide transition-all duration-300 px-4 py-2 rounded-xl hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Accueil</span>
                </a>
                
                <!-- Circuits Dropdown -->
                <div class="relative group">
                    <button type="button" class="nav-link <?php echo $isDestinationPage ? 'active' : ''; ?> font-sans text-slate-700 hover:text-white hover:bg-primary font-semibold text-sm tracking-wide transition-all duration-300 px-4 py-2 rounded-xl hover:shadow-lg flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Circuits</span>
                        <svg class="w-4 h-4 transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-slate-200 transform translate-y-2 group-hover:translate-y-0">
                        <div class="py-2">
                            <?php foreach($destinations as $destItem): ?>
                                <a href="/destinations/<?php echo $destItem->slug; ?>" class="dropdown-item block px-4 py-2.5 font-sans text-sm font-medium text-slate-700 hover:bg-primary hover:text-white transition-all duration-200 mx-2 rounded-lg">
                                    <?php echo htmlspecialchars($destItem->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <a href="/groupe" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/groupe' ? 'active' : ''; ?> font-sans text-slate-700 hover:text-white hover:bg-primary font-semibold text-sm tracking-wide transition-all duration-300 px-4 py-2 rounded-xl hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Groupe</span>
                </a>
                
                <a href="/galerie" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/galerie' ? 'active' : ''; ?> font-sans text-slate-700 hover:text-white hover:bg-primary font-semibold text-sm tracking-wide transition-all duration-300 px-4 py-2 rounded-xl hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>Galerie</span>
                </a>
                
                <a href="/blog" class="nav-link <?php echo str_starts_with($_SERVER['REQUEST_URI'], '/blog') ? 'active' : ''; ?> font-sans text-slate-700 hover:text-white hover:bg-primary font-semibold text-sm tracking-wide transition-all duration-300 px-4 py-2 rounded-xl hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span>Blog</span>
                </a>
                
                <a href="/#devis" class="nav-button inline-flex items-center gap-2 font-sans bg-primary text-white px-6 py-2.5 rounded-xl font-semibold text-sm tracking-wide hover:bg-primary-dark hover:shadow-xl transition-all duration-300 shadow-lg btn-shimmer ml-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Demander un devis</span>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button type="button" id="mobile-menu-toggle" class="text-slate-700 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-all duration-300 hover:scale-110 active:scale-95">
                    <svg id="menu-open-icon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="menu-close-icon" class="w-6 h-6 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white shadow-lg">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="/" class="mobile-nav-link <?php echo $_SERVER['REQUEST_URI'] === '/' ? 'mobile-active' : ''; ?> flex items-center gap-3 px-4 py-2.5 rounded-xl font-sans text-base font-semibold text-slate-700 hover:text-white hover:bg-primary transition-all duration-300 hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Accueil</span>
            </a>
            
            <!-- Mobile Circuits Dropdown -->
            <div>
                <button type="button" id="mobile-circuits-toggle" class="mobile-nav-link <?php echo $isDestinationPage ? 'mobile-active' : ''; ?> w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-sans text-base font-semibold text-slate-700 hover:text-white hover:bg-primary transition-all duration-300 hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="flex-1 text-left">Circuits</span>
                    <svg id="mobile-circuits-icon" class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobile-circuits-menu" class="hidden pl-4 mt-1 space-y-1">
                    <?php foreach($destinations as $destItem): ?>
                        <a href="/destinations/<?php echo $destItem->slug; ?>" class="block px-4 py-2.5 font-sans text-sm font-medium text-slate-600 hover:text-white hover:bg-primary rounded-lg transition-all duration-200">
                            <?php echo htmlspecialchars($destItem->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <a href="/groupe" class="mobile-nav-link <?php echo $_SERVER['REQUEST_URI'] === '/groupe' ? 'mobile-active' : ''; ?> flex items-center gap-3 px-4 py-2.5 rounded-xl font-sans text-base font-semibold text-slate-700 hover:text-white hover:bg-primary transition-all duration-300 hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Groupe</span>
            </a>
            
            <a href="/galerie" class="mobile-nav-link <?php echo $_SERVER['REQUEST_URI'] === '/galerie' ? 'mobile-active' : ''; ?> flex items-center gap-3 px-4 py-2.5 rounded-xl font-sans text-base font-semibold text-slate-700 hover:text-white hover:bg-primary transition-all duration-300 hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Galerie</span>
            </a>
            
            <a href="/blog" class="mobile-nav-link <?php echo str_starts_with($_SERVER['REQUEST_URI'], '/blog') ? 'mobile-active' : ''; ?> flex items-center gap-3 px-4 py-2.5 rounded-xl font-sans text-base font-semibold text-slate-700 hover:text-white hover:bg-primary transition-all duration-300 hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span>Blog</span>
            </a>
            
            <div class="pt-2">
                <a href="/#devis" class="mobile-nav-button flex items-center justify-center gap-2 w-full font-sans bg-primary text-white px-4 py-3 rounded-xl font-semibold tracking-wide hover:bg-primary-dark hover:shadow-xl transition-all duration-300 shadow-lg btn-shimmer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Demander un devis</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Enhanced Navigation Typography */
#main-navigation {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
}

/* Desktop Navigation Links - Button Style */
.nav-link {
    position: relative;
    letter-spacing: 0.025em;
}

/* Active Page Style - Desktop */
.nav-link.active {
    background: #0369a1;
    color: white;
    box-shadow: 0 4px 6px -1px rgba(3, 105, 161, 0.4), 0 2px 4px -1px rgba(3, 105, 161, 0.3);
}

.nav-link.active:hover {
    background: #075985;
    box-shadow: 0 10px 15px -3px rgba(3, 105, 161, 0.4), 0 4px 6px -2px rgba(3, 105, 161, 0.3);
}

/* Dropdown Menu Enhancements */
.dropdown-menu {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.dropdown-item {
    position: relative;
}

/* Mobile Navigation Links */
.mobile-nav-link {
    position: relative;
}

/* Active Page Style - Mobile */
.mobile-nav-link.mobile-active {
    background: #0369a1;
    color: white !important;
    box-shadow: 0 4px 6px -1px rgba(3, 105, 161, 0.4), 0 2px 4px -1px rgba(3, 105, 161, 0.3);
}

.mobile-nav-link.mobile-active:hover {
    background: #075985;
    box-shadow: 0 6px 8px -1px rgba(3, 105, 161, 0.4), 0 2px 4px -1px rgba(3, 105, 161, 0.3);
}

/* Enhanced Button Styles */
.nav-button,
.mobile-nav-button {
    position: relative;
    overflow: hidden;
}

/* Button Shimmer Effect */
.btn-shimmer::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.btn-shimmer:hover::before {
    left: 100%;
}

/* Logo hover effect */
nav a[href="/"] img,
nav a[href="/"] > div {
    transition: transform 0.3s ease, filter 0.3s ease;
}

nav a[href="/"]:hover img,
nav a[href="/"]:hover > div {
    transform: scale(1.05);
    filter: brightness(1.1);
}

/* Mobile menu slide animation */
#mobile-menu {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Icon transition for dropdowns */
#mobile-circuits-icon {
    transition: transform 0.3s ease;
}

#mobile-circuits-icon.rotate-180 {
    transform: rotate(180deg);
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');
            menuCloseIcon.classList.toggle('hidden');
        });
    }
    
    // Mobile circuits dropdown
    const mobileCircuitsToggle = document.getElementById('mobile-circuits-toggle');
    const mobileCircuitsMenu = document.getElementById('mobile-circuits-menu');
    const mobileCircuitsIcon = document.getElementById('mobile-circuits-icon');
    
    if (mobileCircuitsToggle && mobileCircuitsMenu) {
        mobileCircuitsToggle.addEventListener('click', function() {
            mobileCircuitsMenu.classList.toggle('hidden');
            mobileCircuitsIcon.classList.toggle('rotate-180');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnToggle = mobileMenuToggle.contains(event.target);
            
            if (!isClickInsideMenu && !isClickOnToggle) {
                mobileMenu.classList.add('hidden');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            }
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '') return;
            
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                e.preventDefault();
                const navHeight = document.getElementById('main-navigation').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    menuOpenIcon.classList.remove('hidden');
                    menuCloseIcon.classList.add('hidden');
                }
            }
        });
    });
});
</script>

