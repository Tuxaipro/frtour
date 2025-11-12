@props(['hero'])

@if($hero->badge_text)
    <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-medium text-sm mb-6 {{ $hero->content_alignment_classes }}">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        {{ $hero->badge_text }}
    </div>
@endif

<h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-6 {{ $hero->content_alignment_classes }}">
    {!! $hero->title !!}
</h1>

@if($hero->subtitle)
    <p class="text-xl sm:text-2xl text-gray-200 mb-6 max-w-3xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }}">
        {{ $hero->subtitle }}
    </p>
@endif

@if($hero->description)
    <p class="text-lg text-gray-300 mb-10 max-w-3xl {{ $hero->content_alignment === 'center' ? 'mx-auto' : '' }} leading-relaxed">
        {{ $hero->description }}
    </p>
@endif

