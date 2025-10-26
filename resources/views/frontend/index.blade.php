@extends('frontend.layout')

@section('title', 'India Tourisme — Voyages sur‑mesure en Inde')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-light via-blue-50 to-white py-16 sm:py-20 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%233B82F6" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-medium text-sm mb-8">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                DMC certifié ISO 9001:2015
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight mb-6">
                Voyages <span class="text-primary">sur‑mesure</span> en Inde,<br class="hidden sm:block"> Sri Lanka, Népal & Bhoutan
            </h1>
            
            <p class="text-xl text-slate-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                Circuits privés, chauffeurs anglophones/francophones, assistance 24/7 — pour voyageurs exigeants, agences et MICE.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                <a href="#devis" class="w-full sm:w-auto bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    Demander un devis
                </a>
                <a href="https://wa.me/XXXXXXXXXXX" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-primary border-2 border-primary px-8 py-4 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.109"/>
                    </svg>
                    WhatsApp
                </a>
                <a href="https://calendly.com/votre-calendly/rdv-15min" class="w-full sm:w-auto bg-white hover:bg-slate-50 text-primary border-2 border-primary px-8 py-4 rounded-xl font-semibold transition-all duration-200">
                    RDV visio 15 min
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Circuits Section -->
<section id="circuits" class="py-16 sm:py-20 lg:py-32">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Nos idées de voyages (10–14 jours)</h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto">Personnalisables selon vos envies. Prix indicatifs "à partir de".</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($circuits as $circuit)
                <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-200 hover:border-primary/30">
                    <div class="relative overflow-hidden">
                        @if($circuit->featured_image)
                            <img src="{{ asset('storage/' . $circuit->featured_image) }}" alt="{{ $circuit->name }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <h3 class="text-xl font-bold text-white">{{ $circuit->name }}</h3>
                            </div>
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                <span class="text-white text-xl font-bold">{{ $circuit->name }}</span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $circuit->name }} — {{ $circuit->duration_days }} jours</h3>
                        <p class="text-slate-600 mb-4">{{ Str::limit($circuit->description, 100) }}</p>
                        <p class="text-2xl font-bold text-primary mb-4">à partir de {{ number_format($circuit->price_from, 0, ',', ' ') }} € / pers <span class="text-sm font-normal text-slate-500">(hors vols)</span></p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $circuit->highlights) as $highlight)
                                <span class="px-3 py-1 bg-primary-light text-primary text-sm font-medium rounded-full">{{ $highlight }}</span>
                            @endforeach
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- Quote Form Section -->
<section id="devis" class="py-16 sm:py-20 lg:py-32 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center mb-16">
            <div class="inline-flex items-center bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Devis gratuit et sans engagement
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                Obtenez un devis <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-600">personnalisé</span>
            </h2>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-8">Trois étapes simples pour créer votre voyage sur-mesure. Réponse détaillée sous 24–48h (jours ouvrés).</p>
            
            <!-- Progress Indicator -->
            <div class="flex items-center justify-center space-x-4 mb-8" id="progress-indicator">
                <div class="flex items-center">
                    <div id="step-indicator-1" class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                    <span class="ml-2 text-sm font-medium text-slate-700">Voyage</span>
                </div>
                <div id="progress-line-1" class="w-8 h-0.5 bg-slate-300"></div>
                <div class="flex items-center">
                    <div id="step-indicator-2" class="w-8 h-8 bg-slate-300 text-slate-600 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                    <span id="step-label-2" class="ml-2 text-sm font-medium text-slate-500">Préférences</span>
                </div>
                <div id="progress-line-2" class="w-8 h-0.5 bg-slate-300"></div>
                <div class="flex items-center">
                    <div id="step-indicator-3" class="w-8 h-8 bg-slate-300 text-slate-600 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                    <span id="step-label-3" class="ml-2 text-sm font-medium text-slate-500">Contact</span>
                </div>
            </div>
        </div>
        
        <form id="quote-form" action="{{ route('quote-requests.store') }}" method="POST" class="space-y-8">
            @csrf
            <!-- Step 1: Dates & Voyageurs -->
            <div id="step-1" class="step-content">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-200 max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary to-blue-600 text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                            1
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Dates & voyageurs</h3>
                            <p class="text-sm text-slate-500">Quand et combien ?</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Dates souhaitées
                            </label>
                            <input type="text" name="travel_dates" placeholder="ex : 10–24 novembre 2025" required class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Nombre de voyageurs
                            </label>
                            <div class="flex items-center space-x-3">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-10 h-10 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" name="number_of_travelers" min="1" value="2" class="flex-1 px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-center font-semibold">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-10 h-10 bg-slate-100 hover:bg-slate-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Budget approximatif (€)
                            </label>
                            <select name="budget_range" class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300 bg-white">
                                <option value="1 500 – 3 000 € (Découverte)">1 500 – 3 000 € (Découverte)</option>
                                <option value="3 000 – 5 000 € (Confort)">3 000 – 5 000 € (Confort)</option>
                                <option value="5 000 – 8 000 € (Premium)">5 000 – 8 000 € (Premium)</option>
                                <option value="8 000 € et plus (Luxe)">8 000 € et plus (Luxe)</option>
                            </select>
                        </div>
                        <div class="pt-4">
                            <button type="button" onclick="nextStep(1)" class="w-full bg-primary hover:bg-primary-dark text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200">
                                Continuer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Préférences -->
            <div id="step-2" class="step-content" style="display: none;">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-200 max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary to-blue-600 text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                            2
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Préférences</h3>
                            <p class="text-sm text-slate-500">Vos envies de voyage</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Destinations préférées
                            </label>
                            <textarea name="preferences" placeholder="Quelles destinations ou expériences souhaiteriez-vous vivre ?" rows="3" class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                Demandes spéciales
                            </label>
                            <textarea name="special_requests" placeholder="Allergies, mobilité réduite, anniversaire, etc." rows="3" class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300"></textarea>
                        </div>
                        <div class="flex justify-between pt-4">
                            <button type="button" onclick="prevStep(2)" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-4 rounded-xl font-semibold transition-all duration-200">
                                Précédent
                            </button>
                            <button type="button" onclick="nextStep(2)" class="bg-primary hover:bg-primary-dark text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200">
                                Continuer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Contact -->
            <div id="step-3" class="step-content" style="display: none;">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-200 max-w-2xl mx-auto">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary to-blue-600 text-white rounded-2xl flex items-center justify-center text-lg font-bold mr-4 shadow-lg">
                            3
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Coordonnées</h3>
                            <p class="text-sm text-slate-500">Comment vous contacter ?</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Prénom *
                                </label>
                                <input type="text" name="first_name" required class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Nom *
                                </label>
                                <input type="text" name="last_name" required class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email *
                            </label>
                            <input type="email" name="email" required class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Téléphone
                            </label>
                            <input type="tel" name="phone" class="w-full px-4 py-4 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 hover:border-slate-300">
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white px-6 py-4 rounded-xl font-semibold transition-all duration-200">
                                Envoyer ma demande
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    function nextStep(currentStep) {
        // Hide current step
        document.getElementById('step-' + currentStep).style.display = 'none';
        
        // Show next step
        document.getElementById('step-' + (currentStep + 1)).style.display = 'block';
        
        // Update progress indicator
        document.getElementById('step-indicator-' + currentStep).classList.remove('bg-primary', 'text-white');
        document.getElementById('step-indicator-' + currentStep).classList.add('bg-slate-300', 'text-slate-600');
        
        document.getElementById('step-indicator-' + (currentStep + 1)).classList.remove('bg-slate-300', 'text-slate-600');
        document.getElementById('step-indicator-' + (currentStep + 1)).classList.add('bg-primary', 'text-white');
        
        document.getElementById('step-label-' + (currentStep + 1)).classList.remove('text-slate-500');
        document.getElementById('step-label-' + (currentStep + 1)).classList.add('text-slate-700');
        
        document.getElementById('progress-line-' + currentStep).classList.remove('bg-slate-300');
        document.getElementById('progress-line-' + currentStep).classList.add('bg-primary');
    }
    
    function prevStep(currentStep) {
        // Hide current step
        document.getElementById('step-' + currentStep).style.display = 'none';
        
        // Show previous step
        document.getElementById('step-' + (currentStep - 1)).style.display = 'block';
        
        // Update progress indicator
        document.getElementById('step-indicator-' + currentStep).classList.remove('bg-primary', 'text-white');
        document.getElementById('step-indicator-' + currentStep).classList.add('bg-slate-300', 'text-slate-600');
        
        document.getElementById('step-indicator-' + (currentStep - 1)).classList.remove('bg-slate-300', 'text-slate-600');
        document.getElementById('step-indicator-' + (currentStep - 1)).classList.add('bg-primary', 'text-white');
        
        document.getElementById('step-label-' + currentStep).classList.remove('text-slate-700');
        document.getElementById('step-label-' + currentStep).classList.add('text-slate-500');
        
        document.getElementById('progress-line-' + (currentStep - 1)).classList.remove('bg-primary');
        document.getElementById('progress-line-' + (currentStep - 1)).classList.add('bg-slate-300');
    }
    
    // Handle form submission
    document.getElementById('quote-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(this);
        
        // Submit form via AJAX
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(data => {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(step => {
                step.style.display = 'none';
            });
            
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'bg-white rounded-3xl p-8 shadow-xl border border-slate-200 max-w-2xl mx-auto text-center';
            successMessage.innerHTML = `
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4">Merci pour votre demande !</h3>
                <p class="text-lg text-slate-600 mb-6">Nous avons bien reçu votre demande de devis. Notre équipe vous contactera très rapidement pour vous proposer un voyage sur mesure.</p>
                <button onclick="location.reload()" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                    Envoyer une autre demande
                </button>
            `;
            
            document.getElementById('devis').appendChild(successMessage);
        })
        .catch(error => {
            alert('Une erreur est survenue. Veuillez réessayer.');
        });
    });
</script>
@endsection
