@extends('layouts.admin')

@section('title', 'Edit Review')
@section('subtitle', 'Edit customer review information')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Review</h1>
                    <p class="text-sm text-slate-600 mt-1.5 font-medium">Edit customer review information</p>
                </div>
                <a href="{{ route('admin.reviews.index') }}" class="text-slate-600 hover:text-slate-900 flex items-center px-4 py-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Customer Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $review->name) }}"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                               placeholder="John Doe">
                        @error('name')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Circuit -->
                    <div>
                        <label for="circuit" class="block text-sm font-semibold text-slate-700 mb-2">
                            Circuit (Optional)
                        </label>
                        <input type="text" 
                               id="circuit" 
                               name="circuit" 
                               value="{{ old('circuit', $review->circuit) }}"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('circuit') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                               placeholder="Circuit Inde du Nord">
                        @error('circuit')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div>
                        <label for="rating" class="block text-sm font-semibold text-slate-700 mb-2">
                            Rating <span class="text-red-500">*</span>
                        </label>
                        <select id="rating" 
                                name="rating" 
                                class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error('rating') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                            <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                        </select>
                        @error('rating')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Avatar Initials -->
                    <div>
                        <label for="avatar_initials" class="block text-sm font-semibold text-slate-700 mb-2">
                            Avatar Initials (Optional)
                        </label>
                        <input type="text" 
                               id="avatar_initials" 
                               name="avatar_initials" 
                               value="{{ old('avatar_initials', $review->avatar_initials) }}"
                               maxlength="2"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('avatar_initials') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                               placeholder="JD (auto-generated from name if empty)">
                        <p class="mt-2 text-xs text-slate-500 px-1">Leave empty to auto-generate from name</p>
                        @error('avatar_initials')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="md:col-span-2">
                        <label for="comment" class="block text-sm font-semibold text-slate-700 mb-2">
                            Review Comment <span class="text-red-500">*</span>
                        </label>
                        <textarea id="comment" 
                                  name="comment" 
                                  rows="6"
                                  class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('comment') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                  placeholder="Customer review comment...">{{ old('comment', $review->comment) }}</textarea>
                        @error('comment')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">
                            Display Order
                        </label>
                        <input type="number" 
                               id="sort_order" 
                               name="sort_order" 
                               value="{{ old('sort_order', $review->sort_order) }}"
                               min="0"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        <p class="mt-2 text-xs text-slate-500 px-1">Reviews with lower order will appear first</p>
                        @error('sort_order')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div>
                        <label class="flex items-center space-x-3 cursor-pointer pt-8">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $review->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200">
                            <span class="text-sm font-semibold text-slate-700">Active Review</span>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.reviews.index') }}" 
                       class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

