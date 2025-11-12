@props(['hero'])

<section class="hero-section hero-video relative h-[500px] sm:h-[600px] lg:h-[600px] flex items-center justify-center overflow-hidden w-full" 
         data-hero-id="{{ $hero->id }}"
         data-animation-type="{{ $hero->animation_type ?? 'fade' }}"
         data-animation-duration="{{ $hero->animation_duration ?? 500 }}">
    
    @if($hero->background_video)
        <!-- Background Video -->
        <video class="absolute inset-0 w-full h-full object-cover z-0" 
               id="hero-video-{{ $hero->id }}"
               autoplay="{{ $hero->video_autoplay ? 'autoplay' : '' }}"
               loop="{{ $hero->video_loop ? 'loop' : '' }}"
               muted="{{ $hero->video_muted ? 'muted' : '' }}"
               playsinline
               poster="{{ $hero->video_poster_url }}">
            <source src="{{ $hero->background_video_url }}" type="video/mp4">
            <source src="{{ $hero->background_video_url }}" type="video/webm">
            Your browser does not support the video tag.
        </video>
        
        <!-- Video Controls -->
        <div class="absolute bottom-6 right-6 z-20">
            <button onclick="toggleVideo('hero-video-{{ $hero->id }}')" 
                    class="bg-white/20 backdrop-blur-md text-white p-3 rounded-full hover:bg-white/30 transition-all duration-200">
                <svg id="play-icon-{{ $hero->id }}" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg id="pause-icon-{{ $hero->id }}" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 4h4v16H6V4zm8 0h4v16h-4V4z"/>
                </svg>
            </button>
        </div>
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

    <!-- Overlay (only for video backgrounds, not for images) -->
    @if($hero->background_video)
        <x-hero.partials.hero-overlay :hero="$hero" />
    @endif

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col {{ $hero->content_alignment_classes }} max-w-5xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }}">
            <x-hero.partials.hero-content :hero="$hero" />
            <x-hero.partials.hero-buttons :hero="$hero" :alignment="$hero->content_alignment ?? 'center'" />
        </div>
    </div>

    <script>
        function toggleVideo(videoId) {
            const video = document.getElementById(videoId);
            const playIcon = document.getElementById('play-icon-{{ $hero->id }}');
            const pauseIcon = document.getElementById('pause-icon-{{ $hero->id }}');
            
            if (video.paused) {
                video.play();
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
            } else {
                video.pause();
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
            }
        }
    </script>

    @if($hero->custom_css)
        <style>{!! $hero->custom_css !!}</style>
    @endif

    @if($hero->custom_js)
        <script>{!! $hero->custom_js !!}</script>
    @endif
</section>

