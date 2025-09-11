@extends('layouts.admin')

@section('title', 'Galerie')
@section('subtitle', 'Gérer les images de la galerie')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Galerie</h1>
            <p class="text-slate-600">Gérez les images de votre galerie</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.galerie-category.index') }}" 
               class="bg-slate-600 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                Catégories
            </a>
            <a href="{{ route('admin.galerie.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter une image
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Category Filter -->
    @if($categories->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-4">
            <form method="GET" action="{{ route('admin.galerie.index') }}" class="flex items-center space-x-4">
                <label for="category_id" class="text-sm font-medium text-slate-700">Filtrer par catégorie:</label>
                <select name="category_id" id="category_id" 
                        class="px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->galeries->count() }})
                        </option>
                    @endforeach
                </select>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Filtrer
                </button>
                @if(request('category_id'))
                    <a href="{{ route('admin.galerie.index') }}" 
                       class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors duration-200">
                        Effacer
                    </a>
                @endif
            </form>
        </div>
    @endif

    <!-- Gallery Grid -->
    @if($galerie->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($galerie as $image)
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                    <div class="aspect-w-16 aspect-h-12 bg-slate-100">
                        <img src="{{ Storage::url($image->image) }}" 
                             alt="{{ $image->title }}" 
                             class="w-full h-48 object-cover">
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
                            <p class="text-sm text-slate-600 mb-3">{{ Str::limit($image->description, 100) }}</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $image->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $image->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.galerie.edit', $image) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.galerie.destroy', $image) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette image ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucune image</h3>
            <p class="mt-1 text-sm text-slate-500">Commencez par ajouter une image à votre galerie.</p>
            <div class="mt-6">
                <a href="{{ route('admin.galerie.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter une image
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
