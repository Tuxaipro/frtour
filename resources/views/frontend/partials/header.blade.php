<header class="bg-white shadow-sm sticky top-0 z-50" style="background-color: rgba(255, 255, 255, 0.95) !important; backdrop-filter: blur(10px) !important; -webkit-backdrop-filter: blur(10px) !important; position: sticky !important; top: 0 !important; z-index: 50 !important;" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                    @if($siteLogoUrl)
                        <img src="{{ $siteLogoUrl }}" alt="{{ $siteName }}" class="h-8 w-auto mr-3">
                    @endif
                    <span class="text-2xl font-bold text-slate-900">{{ $siteName }}</span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center justify-end space-x-8 ml-auto">
                    <a href="{{ route('home') }}" class="text-slate-900 hover:text-primary transition-colors duration-200 font-medium">Accueil</a>
                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-slate-600 hover:text-primary transition-colors duration-200 font-medium flex items-center">
                            Circuits
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 origin-top-right">
                            @foreach(App\Models\Destination::where('is_active', true)->get() as $destination)
                                <a href="{{ route('destination', $destination->slug) }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-primary transition-colors duration-200">
                                    {{ $destination->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <a href="{{ route('groupe') }}" class="text-slate-600 hover:text-primary transition-colors duration-200 font-medium">Groupe</a>
                    <a href="{{ route('home') }}#devis" class="text-slate-600 hover:text-primary transition-colors duration-200 font-medium">Devis</a>
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-primary transition-colors duration-200 font-medium">Connexion</a>
            </div>
            
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 hover:text-primary transition-colors duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden" x-cloak>
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="text-slate-900 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Accueil</a>
            
            <div class="px-3 py-2">
                <button @click="circuitsOpen = !circuitsOpen" class="text-slate-600 hover:text-primary w-full text-left flex justify-between items-center font-medium">
                    Circuits
                    <svg :class="{'rotate-180': circuitsOpen}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="circuitsOpen" class="mt-2 pl-4 space-y-2">
                    @foreach(App\Models\Destination::where('is_active', true)->get() as $destination)
                        <a href="{{ route('destination', $destination->slug) }}" class="text-slate-500 hover:text-primary block py-2 text-base">
                            {{ $destination->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <a href="{{ route('groupe') }}" class="text-slate-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Groupe</a>
            <a href="{{ route('home') }}#devis" class="text-slate-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Devis</a>
            <a href="{{ route('login') }}" class="text-slate-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Connexion</a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navigation', () => ({
            circuitsOpen: false,
        }))
    })
</script>
