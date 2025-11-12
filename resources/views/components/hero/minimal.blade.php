@props(['hero'])

<section class="hero-section hero-minimal relative h-[500px] sm:h-[600px] lg:h-[600px] flex items-center justify-center overflow-hidden {{ $hero->background_image ? '' : 'bg-gradient-to-br from-primary via-primary-dark to-primary-light' }} w-full" 
         data-hero-id="{{ $hero->id }}"
         data-animation-type="{{ $hero->animation_type ?? 'fade' }}"
         data-animation-duration="{{ $hero->animation_duration ?? 500 }}">
    
    @if($hero->background_image)
        <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
            <img src="{{ $hero->background_image_url }}" 
                 alt="{{ $hero->title ?? 'Hero background' }}"
                 class="w-full h-full object-cover object-center"
                 style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
        </div>
    @endif

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $hero->content_alignment_classes }} max-w-4xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }}">
            <x-hero.partials.hero-content :hero="$hero" />
            <x-hero.partials.hero-buttons :hero="$hero" :alignment="$hero->content_alignment ?? 'center'" />
        </div>
    </div>

    @if($hero->custom_css)
        <style>{!! $hero->custom_css !!}</style>
    @endif

    @if($hero->custom_js)
        <script>{!! $hero->custom_js !!}</script>
    @endif
</section>

