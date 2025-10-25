<footer class="bg-slate-900 text-white py-16">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10 mb-12 items-start">
            <!-- Company Info -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    @if($logoLightUrl)
                        <img src="{{ $logoLightUrl }}" alt="{{ $siteName }}" class="h-8 w-auto">
                    @else
                        <div class="w-8 h-8 bg-gradient-to-br from-primary to-primary-dark rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2L3 7v11a1 1 0 001 1h3v-8h6v8h3a1 1 0 001-1V7l-7-5z"/>
                            </svg>
                        </div>
                    @endif
                    <span class="text-xl font-bold">{{ $siteName }}</span>
                </div>
                <p class="text-slate-300 mb-6 max-w-md">
                    {{ $siteDescription }}
                </p>
                <div class="flex space-x-4 flex-wrap">
                    @if($facebookUrl && $facebookUrl !== '#')
                    <a href="{{ $facebookUrl }}" target="_blank" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    @endif
                    @if($twitterUrl && $twitterUrl !== '#')
                    <a href="{{ $twitterUrl }}" target="_blank" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    @endif
                    @if($instagramUrl && $instagramUrl !== '#')
                    <a href="{{ $instagramUrl }}" target="_blank" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-primary transition-colors duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold mb-4">Liens rapides</h4>
                <ul class="space-y-2 text-slate-300">
                    <li><a href="{{ route('home') }}#circuits" class="hover:text-white transition-colors duration-200">Nos circuits</a></li>
                    <li><a href="{{ route('groupe') }}" class="hover:text-white transition-colors duration-200">Voyages de groupe</a></li>
                    <li><a href="{{ route('home') }}#devis" class="hover:text-white transition-colors duration-200">Devis sur mesure</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-white transition-colors duration-200">Blog</a></li>
                    <li><a href="{{ route('home') }}#galerie" class="hover:text-white transition-colors duration-200">Galerie</a></li>
                    <li><a href="{{ route('home') }}#faq" class="hover:text-white transition-colors duration-200">FAQ</a></li>
                    <li><a href="{{ route('home') }}#contact" class="hover:text-white transition-colors duration-200">Contact</a></li>
                </ul>
            </div>
            
            <!-- Destinations -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold mb-4">Destinations</h4>
                <ul class="space-y-2 text-slate-300">
                    @foreach(App\Models\Destination::where('is_active', true)->get() as $destination)
                        <li><a href="{{ route('destination', $destination->slug) }}" class="hover:text-white transition-colors duration-200">{{ $destination->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="lg:col-span-1">
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-3 text-slate-300">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>{{ $contactPhone }}</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-0.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $contactEmail }}</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-slate-800 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-slate-400 text-sm mb-4 md:mb-0">
                    © {{ date('Y') }} {{ $siteName }} — Tous droits réservés
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">Mentions légales</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">CGV</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition-colors duration-200">Confidentialité</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Sticky CTA -->
<div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50 md:hidden">
    <a href="{{ route('home') }}#devis" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-200">
        Demander un devis
    </a>
</div>