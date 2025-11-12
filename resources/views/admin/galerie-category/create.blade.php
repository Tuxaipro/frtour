@extends('layouts.admin')

@section('title', 'Add Category')
@section('subtitle', 'Add a new gallery category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Add Category</h1>
            <p class="text-sm text-slate-600 mt-1.5 font-medium">Add a new gallery category</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.galerie-category.store') }}" method="POST">
                @csrf
                
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
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('name') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                               placeholder="Ex: Landscapes, Monuments, Culture...">
                        @error('name')
                            <p class="mt-2 text-xs text-red-600 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('description') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                  placeholder="Category description (optional)">{{ old('description') }}</textarea>
                        @error('description')
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
                               value="{{ old('sort_order', 0) }}"
                               min="0"
                               class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error('sort_order') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        <p class="mt-2 text-xs text-slate-500 px-1">Categories with lower order will appear first</p>
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
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary focus:ring-offset-0 transition-colors duration-200">
                            <span class="text-sm font-semibold text-slate-700">Active Category</span>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 mt-8 border-t-2 border-slate-200">
                    <a href="{{ route('admin.galerie-category.index') }}" 
                       class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
