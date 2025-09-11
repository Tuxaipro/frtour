@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Détails de la demande de devis</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.quote-requests.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Retour
            </a>
            <form action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Demande de {{ $quoteRequest->first_name }} {{ $quoteRequest->last_name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Soumise le {{ $quoteRequest->created_at->format('d/m/Y à H:i') }}
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nom complet</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $quoteRequest->first_name }} {{ $quoteRequest->last_name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <a href="mailto:{{ $quoteRequest->email }}" class="text-primary hover:text-primary-dark">
                            {{ $quoteRequest->email }}
                        </a>
                    </dd>
                </div>
                @if($quoteRequest->phone)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <a href="tel:{{ $quoteRequest->phone }}" class="text-primary hover:text-primary-dark">
                            {{ $quoteRequest->phone }}
                        </a>
                    </dd>
                </div>
                @endif
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nombre de voyageurs</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $quoteRequest->number_of_travelers }} personne(s)
                    </dd>
                </div>
                @if($quoteRequest->travel_dates)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Dates de voyage</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $quoteRequest->travel_dates }}
                    </dd>
                </div>
                @endif
                @if($quoteRequest->destinations)
                    @php
                        $destinations = json_decode($quoteRequest->destinations, true);
                        $destinationNames = \App\Models\Destination::whereIn('id', $destinations)->pluck('name')->toArray();
                    @endphp
                    @if(count($destinationNames) > 0)
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Destinations</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ implode(', ', $destinationNames) }}
                        </dd>
                    </div>
                    @endif
                @endif
                @if($quoteRequest->services)
                    @php
                        $services = json_decode($quoteRequest->services, true);
                        $serviceLabels = [
                            'hebergement' => 'Hébergement',
                            'transport' => 'Transport'
                        ];
                        $serviceNames = array_map(function($service) use ($serviceLabels) {
                            return $serviceLabels[$service] ?? ucfirst($service);
                        }, $services);
                    @endphp
                    @if(count($serviceNames) > 0)
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Services souhaités</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ implode(', ', $serviceNames) }}
                        </dd>
                    </div>
                    @endif
                @endif
                @if($quoteRequest->travel_style)
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Style de voyage</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @php
                            $styleLabels = [
                                'culturelle' => '🏛️ Découverte culturelle',
                                'aventure' => '🏔️ Aventure & nature',
                                'luxe' => '✨ Luxe & bien-être',
                                'spiritualite' => '🧘 Spiritualité',
                                'famille' => '👨‍👩‍👧‍👦 Famille',
                                'noces' => '💑 Voyage de noces'
                            ];
                        @endphp
                        {{ $styleLabels[$quoteRequest->travel_style] ?? ucfirst($quoteRequest->travel_style) }}
                    </dd>
                </div>
                @endif
                @if($quoteRequest->special_requests)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Demandes spéciales</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $quoteRequest->special_requests }}
                    </dd>
                </div>
                @endif
                @if($quoteRequest->budget_range)
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Budget</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $quoteRequest->budget_range }}
                    </dd>
                </div>
                @endif
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Statut</dt>
                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                        @if($quoteRequest->is_processed)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Traité
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                En attente
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection