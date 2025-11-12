@props(['hero'])

<section class="hero-section hero-full-width relative h-[500px] sm:h-[600px] lg:h-[600px] flex items-center justify-center overflow-hidden w-full" 
         data-hero-id="{{ $hero->id }}"
         data-animation-type="{{ $hero->animation_type ?? 'fade' }}"
         data-animation-duration="{{ $hero->animation_duration ?? 500 }}">
    
    @if($hero->background_video)
        <!-- Background Video -->
        <video class="absolute inset-0 w-full h-full object-cover z-0" 
               autoplay="{{ $hero->video_autoplay ? 'autoplay' : '' }}"
               loop="{{ $hero->video_loop ? 'loop' : '' }}"
               muted="{{ $hero->video_muted ? 'muted' : '' }}"
               playsinline
               poster="{{ $hero->video_poster_url }}">
            <source src="{{ $hero->background_video_url }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @elseif($hero->background_image)
        <!-- Background Image -->
        <div class="absolute inset-0 w-full h-full z-0 overflow-hidden">
            <img src="{{ $hero->background_image_url }}" 
                 alt="{{ $hero->title ?? 'Hero background' }}"
                 class="w-full h-full object-cover object-center"
                 style="min-width: 100%; min-height: 100%; width: 100%; height: 100%; object-fit: cover; object-position: center;">
        </div>
    @else
        <!-- Default Background -->
        <div class="absolute inset-0 bg-primary z-0"></div>
    @endif

    <!-- Overlay (only for video or when no background image) -->
    @if(!$hero->background_image)
        <x-hero.partials.hero-overlay :hero="$hero" />
    @endif

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $hero->content_alignment_classes }} max-w-5xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }}">
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

