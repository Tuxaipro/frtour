@extends('layouts.admin')

@section('title', 'FAQ')
@section('subtitle', 'Gérer les questions fréquemment posées')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">FAQ</h1>
            <p class="text-slate-600">Gérez les questions fréquemment posées</p>
        </div>
        <a href="{{ route('admin.faq.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une FAQ
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- FAQ List -->
    @if($faqs->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-slate-200">
            <div class="divide-y divide-slate-200">
                @foreach($faqs as $faq)
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-slate-800 mb-2">{{ $faq->question }}</h3>
                                <p class="text-slate-600 mb-3">{{ Str::limit($faq->answer, 200) }}</p>
                                <div class="flex items-center space-x-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $faq->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                    <span class="text-sm text-slate-500">
                                        Ordre: {{ $faq->sort_order }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 ml-4">
                                <a href="{{ route('admin.faq.edit', $faq) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Modifier
                                </a>
                                <form action="{{ route('admin.faq.destroy', $faq) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette FAQ ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucune FAQ</h3>
            <p class="mt-1 text-sm text-slate-500">Commencez par ajouter une question fréquemment posée.</p>
            <div class="mt-6">
                <a href="{{ route('admin.faq.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Ajouter une FAQ
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
