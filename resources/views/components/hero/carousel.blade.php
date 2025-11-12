@props(['heroes'])

@if($heroes->count() > 0)
    @php
        $firstHero = $heroes->first();
        $autoplay = $firstHero->carousel_autoplay ?? true;
        $interval = $firstHero->carousel_interval ?? 5000;
        $pauseOnHover = $firstHero->carousel_pause_on_hover ?? true;
    @endphp

    <section class="hero-section hero-carousel relative overflow-hidden" 
             data-autoplay="{{ $autoplay ? 'true' : 'false' }}"
             data-interval="{{ $interval }}"
             data-pause-on-hover="{{ $pauseOnHover ? 'true' : 'false' }}">
        
        <div class="hero-slides-container flex transition-transform duration-700 ease-in-out" id="heroCarouselSlides">
            @foreach($heroes as $index => $hero)
                <div class="hero-slide w-full flex-shrink-0 relative min-h-screen flex items-center justify-center" 
                     data-slide-index="{{ $index }}">
                    
                    @if($hero->background_video)
                        <video class="absolute inset-0 w-full h-full object-cover z-0" 
                               autoplay="{{ $hero->video_autoplay ? 'autoplay' : '' }}"
                               loop="{{ $hero->video_loop ? 'loop' : '' }}"
                               muted="{{ $hero->video_muted ? 'muted' : '' }}"
                               playsinline
                               poster="{{ $hero->video_poster_url }}">
                            <source src="{{ $hero->background_video_url }}" type="video/mp4">
                        </video>
                    @elseif($hero->background_image)
                        <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
                            <img src="{{ $hero->background_image_url }}" 
                                 alt="{{ $hero->title ?? 'Hero background' }}"
                                 class="w-full h-full object-cover object-center"
                                 style="min-width: 100%; min-height: 100%; width: 100%; height: 100%; object-fit: cover; object-position: center;">
                        </div>
                    @else
                        <div class="absolute inset-0 bg-primary z-0"></div>
                    @endif

                    <!-- Overlay -->
                    <x-hero.partials.hero-overlay :hero="$hero" />

                    <!-- Content -->
                    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-32 w-full">
                        <div class="flex flex-col {{ $hero->content_alignment_classes }} max-w-5xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }}">
                            <x-hero.partials.hero-content :hero="$hero" />
                            <x-hero.partials.hero-buttons :hero="$hero" :alignment="$hero->content_alignment ?? 'center'" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        @if($heroes->count() > 1)
            <button class="hero-nav hero-nav-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-primary p-3 rounded-full shadow-lg transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-white" 
                    onclick="changeHeroSlide(-1)"
                    aria-label="Previous slide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="hero-nav hero-nav-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-800 hover:text-primary p-3 rounded-full shadow-lg transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-white" 
                    onclick="changeHeroSlide(1)"
                    aria-label="Next slide">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        @endif

        <!-- Dots Indicator -->
        @if($heroes->count() > 1)
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" role="tablist" aria-label="Hero slides">
                @foreach($heroes as $index => $hero)
                    <button class="hero-dot w-3 h-3 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}" 
                            onclick="goToHeroSlide({{ $index }})"
                            role="tab"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Go to slide {{ $index + 1 }}"
                            data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </section>

    @push('scripts')
    <script>
        let currentHeroSlide = 0;
        const totalHeroSlides = {{ $heroes->count() }};
        let heroSlideInterval;
        const heroSection = document.querySelector('.hero-carousel');
        const autoplay = heroSection?.dataset.autoplay === 'true';
        const interval = parseInt(heroSection?.dataset.interval || 5000);
        const pauseOnHover = heroSection?.dataset.pauseOnHover === 'true';

        function showHeroSlide(index) {
            const slidesContainer = document.getElementById('heroCarouselSlides');
            const dots = document.querySelectorAll('.hero-dot');
            
            if (slidesContainer && totalHeroSlides > 0) {
                currentHeroSlide = (index + totalHeroSlides) % totalHeroSlides;
                slidesContainer.style.transform = `translateX(-${currentHeroSlide * 100}%)`;
                
                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === currentHeroSlide);
                    dot.classList.toggle('bg-white/50', i !== currentHeroSlide);
                    dot.setAttribute('aria-selected', i === currentHeroSlide ? 'true' : 'false');
                });
            }
        }

        function changeHeroSlide(direction) {
            showHeroSlide(currentHeroSlide + direction);
            resetHeroAutoSlide();
        }

        function goToHeroSlide(index) {
            showHeroSlide(index);
            resetHeroAutoSlide();
        }

        function resetHeroAutoSlide() {
            clearInterval(heroSlideInterval);
            if (autoplay && totalHeroSlides > 1) {
                heroSlideInterval = setInterval(() => {
                    changeHeroSlide(1);
                }, interval);
            }
        }

        // Initialize autoplay
        if (autoplay && totalHeroSlides > 1) {
            resetHeroAutoSlide();
        }

        // Pause on hover
        if (pauseOnHover && heroSection) {
            heroSection.addEventListener('mouseenter', () => clearInterval(heroSlideInterval));
            heroSection.addEventListener('mouseleave', () => resetHeroAutoSlide());
        }

        // Keyboard navigation
        const keyboardHandler = (e) => {
            if (e.key === 'ArrowLeft') changeHeroSlide(-1);
            if (e.key === 'ArrowRight') changeHeroSlide(1);
        };
        document.addEventListener('keydown', keyboardHandler);
        
        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            clearInterval(heroSlideInterval);
            document.removeEventListener('keydown', keyboardHandler);
        });
    </script>
    @endpush
@endif

