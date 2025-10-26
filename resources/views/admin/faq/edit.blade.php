@extends('layouts.admin')

@section('title', 'Edit FAQ')
@section('subtitle', 'Edit frequently asked question information')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
        <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Question -->
            <div class="mb-6">
                <label for="question" class="block text-sm font-medium text-slate-700 mb-2">
                    Question <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="question" 
                       name="question" 
                       value="{{ old('question', $faq->question) }}"
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('question') border-red-500 @enderror"
                       placeholder="What is your question?">
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Answer -->
            <div class="mb-6">
                <label for="answer" class="block text-sm font-medium text-slate-700 mb-2">
                    Answer <span class="text-red-500">*</span>
                </label>
                <textarea id="answer" 
                          name="answer" 
                          rows="6"
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('answer') border-red-500 @enderror"
                          placeholder="Your detailed answer...">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sort Order -->
            <div class="mb-6">
                <label for="sort_order" class="block text-sm font-medium text-slate-700 mb-2">
                    Display Order
                </label>
                <input type="number" 
                       id="sort_order" 
                       name="sort_order" 
                       value="{{ old('sort_order', $faq->sort_order) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-500 @enderror">
                <p class="mt-1 text-sm text-slate-500">FAQs with lower order will appear first</p>
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                           class="rounded border-slate-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-slate-700">Active FAQ</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.faq.index') }}" 
                   class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
