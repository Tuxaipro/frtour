@extends('frontend.layout')

@section('title', $page->meta_title ?? $page->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($page->featured_image)
            <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
            
            <div class="prose max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </article>
</div>
@endsection