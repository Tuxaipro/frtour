@props(['hero', 'imagePosition' => 'right'])

<section class="hero-section hero-split relative py-12 lg:py-20 flex items-center overflow-hidden bg-white w-full" 
         data-hero-id="{{ $hero->id }}"
         data-animation-type="{{ $hero->animation_type ?? 'fade' }}"
         data-animation-duration="{{ $hero->animation_duration ?? 500 }}">
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            
            @if($imagePosition === 'left')
                <!-- Image Section -->
                <div class="order-2 lg:order-1">
                    @if($hero->background_image)
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3]">
                            <img src="{{ $hero->background_image_url }}" 
                                 alt="{{ $hero->title ?? 'Hero image' }}"
                                 class="w-full h-full object-cover object-center"
                                 style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] bg-gradient-to-br from-primary to-primary-dark"></div>
                    @endif
                </div>
            @endif

            <!-- Content Section -->
            <div class="order-1 lg:order-{{ $imagePosition === 'left' ? '2' : '1' }} {{ $hero->content_alignment_classes }}">
                <x-hero.partials.hero-content :hero="$hero" />
                <x-hero.partials.hero-buttons :hero="$hero" :alignment="$hero->content_alignment ?? 'left'" />
            </div>

            @if($imagePosition === 'right')
                <!-- Image Section -->
                <div class="order-2">
                    @if($hero->background_image)
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3]">
                            <img src="{{ $hero->background_image_url }}" 
                                 alt="{{ $hero->title ?? 'Hero image' }}"
                                 class="w-full h-full object-cover object-center"
                                 style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] bg-gradient-to-br from-primary to-primary-dark"></div>
                    @endif
                </div>
            @endif

        </div>
    </div>

    @if($hero->custom_css)
        <style>{!! $hero->custom_css !!}</style>
    @endif

    @if($hero->custom_js)
        <script>{!! $hero->custom_js !!}</script>
    @endif
</section>

