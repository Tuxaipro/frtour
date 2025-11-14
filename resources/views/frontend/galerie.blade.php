@extends('layouts.frontend')

@section('title', 'Galerie Photos - India Tourisme')
@section('description', 'Découvrez notre galerie de photos des plus beaux endroits d\'Inde, du Sri Lanka et du Népal.')

@section('content')
        <!-- Hero Section -->
        <section class="relative py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-primary via-primary-dark to-accent min-h-[500px] flex items-center justify-center">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto fade-in">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold text-sm mb-8">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Galerie Photos
                    </div>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
                        L'Inde en <span class="text-white/90">images</span>
                    </h1>
                    <p class="text-xl text-white/90 max-w-3xl mx-auto font-light leading-relaxed">
                        Laissez-vous inspirer par la beauté et la diversité de l'Inde, du Sri Lanka et du Népal
                    </p>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section class="py-20 sm:py-24 lg:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Category Filter -->
                @if($categories->count() > 0)
                    <div class="mb-16 fade-in">
                        <div class="text-center mb-8">
                            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
                                Filtrer par <span class="gradient-text">catégorie</span>
                            </h2>
                            <div class="flex flex-wrap justify-center gap-3">
                                <a href="{{ route('galerie') }}" 
                                   class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300 {{ !request('category_id') ? 'bg-primary text-white shadow-md hover:shadow-lg btn-shimmer' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                    Toutes les photos
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('galerie', ['category_id' => $category->id]) }}" 
                                       class="px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300 {{ request('category_id') == $category->id ? 'bg-primary text-white shadow-md hover:shadow-lg btn-shimmer' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                        {{ $category->name }}
                                        <span class="ml-1 text-xs opacity-75">({{ $category->galeries->count() }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if($galerie->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 fade-in">
                        @foreach($galerie as $image)
                            <div class="group card-hover bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                                <div class="relative overflow-hidden img-zoom">
                                    <img src="{{ Storage::url($image->image) }}" 
                                         alt="{{ $image->title }}" 
                                         class="w-full h-64 object-cover"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="font-bold text-slate-900 mb-2 line-clamp-2">{{ $image->title }}</h3>
                                    @if($image->category)
                                        <div class="mb-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                                                {{ $image->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                    @if($image->description)
                                        <p class="text-sm text-slate-600 line-clamp-2">{{ $image->description }}</p>
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
        <section class="relative py-20 bg-gradient-to-br from-primary via-primary-dark to-accent overflow-hidden">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-in">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-white mb-6">
                    Prêt à créer vos propres <span class="text-white/90">souvenirs</span> ?
                </h2>
                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto font-light">
                    Rejoignez-nous pour une aventure inoubliable à travers les plus beaux paysages d'Asie
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/#devis" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary rounded-xl font-semibold text-lg hover:bg-slate-100 transition-all duration-300 shadow-2xl hover:shadow-3xl btn-shimmer">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Demander un devis
                    </a>
                    <a href="/#contact" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Nous contacter
                    </a>
                </div>
            </div>
        </section>
@endsection
