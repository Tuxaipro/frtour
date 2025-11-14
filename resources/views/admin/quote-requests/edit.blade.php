@extends('layouts.admin')

@section('title', 'Edit Quote Request')
@section('subtitle', 'Update quote request information')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Quote Request</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">Update quote request information</p>
                </div>
                <a href="{{ route('admin.quote-requests.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
        <div class="p-6">
            @if ($errors->any())
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-xl shadow-md mb-6" role="alert">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <strong class="font-bold">There were some problems with your input:</strong>
                    </div>
                    <ul class="mt-2 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.quote-requests.update', $quoteRequest) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 pb-2 border-b-2 border-slate-200">Personal Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-slate-700 mb-2">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $quoteRequest->first_name) }}" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('first_name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('first_name')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-slate-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $quoteRequest->last_name) }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('last_name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('last_name')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $quoteRequest->email) }}" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Phone <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $quoteRequest->phone) }}" required class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('phone') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-semibold text-slate-700 mb-2">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country', $country ?? '') }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('country') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('country')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Trip Details Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 pb-2 border-b-2 border-slate-200">Trip Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="destination" class="block text-sm font-semibold text-slate-700 mb-2">Destination</label>
                            <select name="destination" id="destination" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error('destination') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                                <option value="">Select a destination</option>
                                @foreach($destinations as $dest)
                                    <option value="{{ $dest->name }}" {{ old('destination', $selectedDestination) == $dest->name ? 'selected' : '' }}>{{ $dest->name }}</option>
                                @endforeach
                            </select>
                            @error('destination')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-semibold text-slate-700 mb-2">Duration</label>
                            <input type="text" name="duration" id="duration" value="{{ old('duration', $duration ?? '') }}" placeholder="e.g., 10 days" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('duration') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('duration')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="travel_dates" class="block text-sm font-semibold text-slate-700 mb-2">Travel Dates</label>
                            @php
                                $travelDateValue = old('travel_dates', '');
                                if (empty($travelDateValue) && $quoteRequest->travel_dates) {
                                    if (is_string($quoteRequest->travel_dates)) {
                                        // Try to parse the string date
                                        try {
                                            $date = \Carbon\Carbon::parse($quoteRequest->travel_dates);
                                            $travelDateValue = $date->format('Y-m-d');
                                        } catch (\Exception $e) {
                                            $travelDateValue = $quoteRequest->travel_dates;
                                        }
                                    } else {
                                        $travelDateValue = $quoteRequest->travel_dates->format('Y-m-d');
                                    }
                                }
                            @endphp
                            <input type="date" name="travel_dates" id="travel_dates" value="{{ $travelDateValue }}" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('travel_dates') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('travel_dates')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="number_of_travelers" class="block text-sm font-semibold text-slate-700 mb-2">Number of Travelers</label>
                            <input type="number" name="number_of_travelers" id="number_of_travelers" value="{{ old('number_of_travelers', $quoteRequest->number_of_travelers) }}" min="1" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('number_of_travelers') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            @error('number_of_travelers')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_range" class="block text-sm font-semibold text-slate-700 mb-2">Budget Range</label>
                            <select name="budget_range" id="budget_range" class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error('budget_range') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                                <option value="">Select a budget</option>
                                <option value="Moins de 1000€" {{ old('budget_range', $quoteRequest->budget_range) == 'Moins de 1000€' ? 'selected' : '' }}>Moins de 1000€</option>
                                <option value="1000€ - 2000€" {{ old('budget_range', $quoteRequest->budget_range) == '1000€ - 2000€' ? 'selected' : '' }}>1000€ - 2000€</option>
                                <option value="2000€ - 3000€" {{ old('budget_range', $quoteRequest->budget_range) == '2000€ - 3000€' ? 'selected' : '' }}>2000€ - 3000€</option>
                                <option value="Plus de 3000€" {{ old('budget_range', $quoteRequest->budget_range) == 'Plus de 3000€' ? 'selected' : '' }}>Plus de 3000€</option>
                            </select>
                            @error('budget_range')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Message & Preferences Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 pb-2 border-b-2 border-slate-200">Message & Preferences</h2>
                    <div class="space-y-6">
                        <div>
                            <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">Tell us about your project <span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="4" required placeholder="Describe your wishes, interests, expectations..." class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 resize-none @error('message') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('message', $message ?? '') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="preferences" class="block text-sm font-semibold text-slate-700 mb-2">Preferences</label>
                            <textarea name="preferences" id="preferences" rows="3" placeholder="e.g., 4-star hotels, vegetarian cuisine, cultural activities..." class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 resize-none @error('preferences') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('preferences', $preferences ?? '') }}</textarea>
                            @error('preferences')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="special_requests" class="block text-sm font-semibold text-slate-700 mb-2">Special Requests</label>
                            <textarea name="special_requests" id="special_requests" rows="3" placeholder="e.g., Accessibility, birthday, special needs..." class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 resize-none @error('special_requests') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('special_requests', $specialRequests ?? '') }}</textarea>
                            @error('special_requests')
                                <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-slate-900 mb-4 pb-2 border-b-2 border-slate-200">Status</h2>
                    <div class="flex items-center space-x-3">
                        <input type="hidden" name="is_processed" value="0">
                        <input type="checkbox" name="is_processed" id="is_processed" class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200" value="1" {{ old('is_processed', $quoteRequest->is_processed) ? 'checked' : '' }}>
                        <label for="is_processed" class="text-sm font-semibold text-slate-700 cursor-pointer">Mark as Processed</label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.quote-requests.index') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Quote Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
