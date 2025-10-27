@extends('layouts.frontend')

@section('title', 'Galerie Photos - India Tourisme')
@section('description', 'Découvrez notre galerie de photos des plus beaux endroits d\'Inde, du Sri Lanka et du Népal.')

@section('content')
        <!-- Hero Section -->
        <section class="text-white py-16 sm:py-20 lg:py-32" style="background-color: hsl(220, 70%, 25%);">
            <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white font-medium text-sm mb-8">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        Galerie Photos
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Galerie Photos</h1>
                    <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                        Découvrez les plus beaux moments de nos voyages à travers l'Inde, le Sri Lanka et le Népal
                    </p>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Category Filter -->
                @if($categories->count() > 0)
                    <div class="mb-12">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold text-slate-800 mb-4">Filtrer par catégorie</h2>
                            <div class="flex flex-wrap justify-center gap-3">
                                <a href="{{ route('galerie') }}" 
                                   class="px-6 py-3 rounded-full text-sm font-medium transition-colors duration-200 {{ !request('category_id') ? 'text-white border-2 border-white' : 'bg-slate-200 text-slate-700 hover:bg-slate-300' }}"
                                    Toutes les photos
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('galerie', ['category_id' => $category->id]) }}" 
                                       class="px-6 py-3 rounded-full text-sm font-medium transition-colors duration-200 {{ request('category_id') == $category->id ? 'text-white border-2 border-white' : 'bg-slate-200 text-slate-700 hover:bg-slate-300' }}"
                                        {{ $category->name }}
                                        <span class="ml-1 text-xs opacity-75">({{ $category->galeries->count() }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if($galerie->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($galerie as $image)
                            <div class="group bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="aspect-w-16 aspect-h-12 bg-slate-100 relative overflow-hidden">
                                    <img src="{{ Storage::url($image->image) }}" 
                                         alt="{{ $image->title }}" 
                                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-slate-800 mb-2">{{ $image->title }}</h3>
                                    @if($image->category)
                                        <div class="mb-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $image->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                    @if($image->description)
                                        <p class="text-sm text-slate-600">{{ Str::limit($image->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-slate-900">Aucune photo disponible</h3>
                        <p class="mt-1 text-sm text-slate-500">La galerie sera bientôt mise à jour avec de nouvelles photos.</p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-slate-800 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Prêt à créer vos propres souvenirs ?</h2>
                <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                    Rejoignez-nous pour une aventure inoubliable à travers les plus beaux paysages d'Asie
                </p>
            </div>
        </section>
@endsection
