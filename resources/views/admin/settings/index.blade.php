@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Site Settings</h1>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @foreach($settings as $group => $groupSettings)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 capitalize">{{ $group }} Settings</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($groupSettings as $setting)
                                    <div class="mb-4">
                                        <label for="settings[{{ $setting->key }}][value]" class="block text-sm font-medium text-gray-700 capitalize">
                                            {{ str_replace('_', ' ', $setting->key) }}
                                        </label>
                                        <input type="hidden" name="settings[{{ $setting->key }}][key]" value="{{ $setting->key }}">
                                        <input 
                                            type="text" 
                                            name="settings[{{ $setting->key }}][value]" 
                                            id="settings[{{ $setting->key }}][value]" 
                                            value="{{ old('settings.' . $setting->key . '.value', $setting->value) }}" 
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        >
                                        @error("settings.{$setting->key}.value")
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection