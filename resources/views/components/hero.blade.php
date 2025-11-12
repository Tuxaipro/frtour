@props(['hero'])

@php
    $layoutType = $hero->layout_type ?? 'minimal';
@endphp

@switch($layoutType)
    @case('split')
        <x-hero.split :hero="$hero" :imagePosition="($hero->content_alignment ?? 'center') === 'left' ? 'left' : 'right'" />
        @break
    
    @case('minimal')
        <x-hero.minimal :hero="$hero" />
        @break
    
    @case('video')
        <x-hero.video :hero="$hero" />
        @break
    
    @case('carousel')
        {{-- Carousel is handled separately in welcome.blade.php --}}
        <x-hero.minimal :hero="$hero" />
        @break
    
    @default
        <x-hero.minimal :hero="$hero" />
@endswitch

