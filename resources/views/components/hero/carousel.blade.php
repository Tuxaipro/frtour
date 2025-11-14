@props(['heroes'])

@if($heroes->count() > 0)
        @php
            // Get carousel settings from database
            $autoplay = \App\Models\Setting::get('carousel_autoplay', '1') == '1' || \App\Models\Setting::get('carousel_autoplay', '1') == 1;
            $interval = (int) \App\Models\Setting::get('carousel_interval', '5000');
            $pauseOnHover = \App\Models\Setting::get('carousel_pause_on_hover', '1') == '1' || \App\Models\Setting::get('carousel_pause_on_hover', '1') == 1;
        @endphp

    <section class="hero-section hero-carousel relative h-[450px] sm:h-[500px] lg:h-[550px] overflow-hidden w-full" 
             data-autoplay="{{ $autoplay ? 'true' : 'false' }}"
             data-interval="{{ $interval }}"
             data-pause-on-hover="{{ $pauseOnHover ? 'true' : 'false' }}">
            
            <style>
                .hero-carousel {
                    position: relative;
                    overflow: hidden;
                    width: 100%;
                    height: 450px;
                }
                @media (min-width: 640px) {
                    .hero-carousel {
                        height: 500px;
                    }
                }
                @media (min-width: 1024px) {
                    .hero-carousel {
                        height: 550px;
                    }
                }
                .hero-carousel .hero-slides-container {
                    display: flex;
                    width: calc(100% * {{ $heroes->count() }});
                    transition: transform 0.7s ease-in-out;
                    height: 100%;
                }
                .hero-carousel .hero-slide {
                    width: calc(100% / {{ $heroes->count() }});
                    flex-shrink: 0;
                    height: 100%;
                }
                .hero-carousel .hero-slide > section {
                    width: 100%;
                    height: 100%;
                }
            </style>
            
            <div class="hero-slides-container" id="heroCarouselSlides">
                @foreach($heroes as $index => $hero)
                    <div class="hero-slide" data-slide-index="{{ $index }}">
                        {{-- Render each hero with its own layout type --}}
                        <x-hero :hero="$hero" />
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

    <script>
        (function() {
            const totalHeroSlides = {{ $heroes->count() }};
            if (totalHeroSlides === 0) return;

            let currentHeroSlide = 0;
            let heroSlideInterval = null;
            let keyboardHandler = null;
            let slidesContainer = null;
            let heroSection = null;

            function showHeroSlide(index) {
                if (!slidesContainer || totalHeroSlides === 0) return;
                
                currentHeroSlide = (index + totalHeroSlides) % totalHeroSlides;
                const slideWidth = 100 / totalHeroSlides;
                const translateX = -(currentHeroSlide * slideWidth);
                slidesContainer.style.transform = `translateX(${translateX}%)`;
                
                // Update dots
                const dots = document.querySelectorAll('.hero-dot');
                dots.forEach((dot, i) => {
                    if (i === currentHeroSlide) {
                        dot.classList.remove('bg-white/50');
                        dot.classList.add('bg-white');
                        dot.setAttribute('aria-selected', 'true');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/50');
                        dot.setAttribute('aria-selected', 'false');
                    }
                });
            }

            function changeHeroSlide(direction) {
                if (totalHeroSlides <= 1) return;
                showHeroSlide(currentHeroSlide + direction);
                resetHeroAutoSlide();
            }

            function goToHeroSlide(index) {
                if (totalHeroSlides <= 1) return;
                if (index >= 0 && index < totalHeroSlides) {
                    showHeroSlide(index);
                    resetHeroAutoSlide();
                }
            }

            function resetHeroAutoSlide() {
                clearInterval(heroSlideInterval);
                heroSlideInterval = null;
                
                if (!heroSection) return;
                
                const autoplay = heroSection.dataset.autoplay === 'true';
                const interval = parseInt(heroSection.dataset.interval || 5000);
                
                if (autoplay && totalHeroSlides > 1) {
                    heroSlideInterval = setInterval(() => {
                        changeHeroSlide(1);
                    }, interval);
                }
            }

            // Make functions globally accessible immediately
            window.changeHeroSlide = changeHeroSlide;
            window.goToHeroSlide = goToHeroSlide;

            // Initialize when DOM is ready
            function initCarousel() {
                slidesContainer = document.getElementById('heroCarouselSlides');
                heroSection = document.querySelector('.hero-carousel');
                
                if (!slidesContainer || !heroSection) {
                    // Retry after a short delay if elements aren't ready
                    setTimeout(initCarousel, 100);
                    return;
                }

                // Initialize first slide
                showHeroSlide(0);

                // Initialize autoplay
                const autoplay = heroSection.dataset.autoplay === 'true';
                if (autoplay && totalHeroSlides > 1) {
                    resetHeroAutoSlide();
                }

                // Pause on hover
                const pauseOnHover = heroSection.dataset.pauseOnHover === 'true';
                if (pauseOnHover) {
                    heroSection.addEventListener('mouseenter', () => {
                        clearInterval(heroSlideInterval);
                        heroSlideInterval = null;
                    });
                    heroSection.addEventListener('mouseleave', () => {
                        resetHeroAutoSlide();
                    });
                }

                // Keyboard navigation
                keyboardHandler = (e) => {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        changeHeroSlide(-1);
                    } else if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        changeHeroSlide(1);
                    }
                };
                document.addEventListener('keydown', keyboardHandler);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCarousel);
            } else {
                initCarousel();
            }
            
            // Clean up on page unload
            window.addEventListener('beforeunload', () => {
                clearInterval(heroSlideInterval);
                if (keyboardHandler) {
                    document.removeEventListener('keydown', keyboardHandler);
                }
            });
        })();
    </script>
@endif

