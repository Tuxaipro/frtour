@props(['hero', 'alignment' => 'center'])

@php
    $buttonAlignment = match($alignment) {
        'left' => 'justify-start',
        'right' => 'justify-end',
        default => 'justify-center',
    };
@endphp

@if($hero->primary_button_text || $hero->secondary_button_text || $hero->tertiary_button_text)
    <div class="flex flex-col sm:flex-row items-{{ $alignment }} gap-3 sm:gap-4 {{ $buttonAlignment }}">
        @if($hero->primary_button_text)
            <a href="{{ $hero->primary_button_url ?: '#devis' }}" 
               class="group w-full sm:w-auto bg-white text-primary px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform flex items-center justify-center">
                {{ $hero->primary_button_text }}
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        @endif
        
        @if($hero->secondary_button_text)
            <a href="{{ $hero->secondary_button_url ?: '#circuits' }}" 
               class="group w-full sm:w-auto text-white border-2 border-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center hover:bg-white/10 backdrop-blur-sm">
                {{ $hero->secondary_button_text }}
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        @endif
        
        @if($hero->tertiary_button_text)
            <a href="{{ $hero->tertiary_button_url ?: '#' }}" 
               class="group w-full sm:w-auto text-white underline underline-offset-4 hover:no-underline font-medium transition-all duration-200 flex items-center justify-center">
                {{ $hero->tertiary_button_text }}
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @endif
    </div>
@endif

