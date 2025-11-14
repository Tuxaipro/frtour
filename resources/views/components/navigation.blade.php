@props(['currentRoute' => ''])

@php
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
@endphp

<nav id="main-navigation" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm" style="background-color: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-slate-900">{{ $siteName }}</span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors">
                    Accueil
                </a>
                
                <!-- Circuits Dropdown -->
                <div class="relative group">
                    <button type="button" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors flex items-center space-x-1">
                        <span>Circuits</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-slate-200">
                        <div class="py-2">
                            @foreach($destinations as $destination)
                                <a href="/destinations/{{ $destination->slug }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    {{ $destination->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <a href="/groupe" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors">
                    Groupe
                </a>
                
                <a href="/galerie" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors">
                    Galerie
                </a>
                
                <a href="/blog" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors">
                    Blog
                </a>
                
                <a href="/#contact" class="nav-link text-slate-700 hover:text-blue-600 font-medium transition-colors">
                    Contact
                </a>
                
                <a href="/#devis" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                    Demander un devis
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button type="button" id="mobile-menu-toggle" class="text-slate-700 hover:text-blue-600 p-2">
                    <svg id="menu-open-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="menu-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                Accueil
            </a>
            
            <!-- Mobile Circuits Dropdown -->
            <div>
                <button type="button" id="mobile-circuits-toggle" class="w-full flex items-center justify-between px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                    <span>Circuits</span>
                    <svg id="mobile-circuits-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="mobile-circuits-menu" class="hidden pl-4 mt-1 space-y-1">
                    @foreach($destinations as $destination)
                        <a href="/destinations/{{ $destination->slug }}" class="block px-3 py-2 text-sm text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-md">
                            {{ $destination->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <a href="/groupe" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                Groupe
            </a>
            
            <a href="/galerie" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                Galerie
            </a>
            
            <a href="/blog" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                Blog
            </a>
            
            <a href="/#contact" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">
                Contact
            </a>
            
            <div class="pt-2">
                <a href="/#devis" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-all">
                    Demander un devis
                </a>
            </div>
        </div>
    </div>
</nav>

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

<style>
.nav-link {
    position: relative;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #2563eb;
    transition: width 0.3s ease;
}

.nav-link:hover::after {
    width: 100%;
}

.rotate-180 {
    transform: rotate(180deg);
}
</style>

