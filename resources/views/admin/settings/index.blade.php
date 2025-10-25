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

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
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
                                        
                                        @if(in_array($setting->key, ['site_logo', 'logo_light', 'site_favicon']))
                                            <!-- Image Upload Field -->
                                            <div class="mt-1">
                                                <!-- Current Image Display -->
                                                <div id="current-image-{{ $setting->key }}" class="mb-3 {{ $setting->value ? '' : 'hidden' }}">
                                                    <div class="flex items-center space-x-3">
                                                        <img src="{{ $setting->value ? asset('storage/' . $setting->value) : '' }}" alt="{{ $setting->key }}" class="h-16 w-auto object-contain border rounded" id="preview-{{ $setting->key }}">
                                                        <div class="flex-1">
                                                            <p class="text-sm font-medium text-gray-700">Current Image</p>
                                                            <p class="text-xs text-gray-500">{{ $setting->value }}</p>
                                                        </div>
                                                        <button type="button" onclick="clearImage('{{ $setting->key }}')" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                            Remove
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <!-- New Image Preview -->
                                                <div id="new-image-preview-{{ $setting->key }}" class="mb-3 hidden">
                                                    <div class="flex items-center space-x-3">
                                                        <img id="preview-new-{{ $setting->key }}" src="" alt="New {{ $setting->key }}" class="h-16 w-auto object-contain border rounded">
                                                        <div class="flex-1">
                                                            <p class="text-sm font-medium text-gray-700">New Image Preview</p>
                                                            <p class="text-xs text-gray-500" id="filename-{{ $setting->key }}"></p>
                                                        </div>
                                                        <button type="button" onclick="clearNewImage('{{ $setting->key }}')" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <!-- File Input -->
                                                <input 
                                                    type="file" 
                                                    name="settings[{{ $setting->key }}][file]" 
                                                    id="settings[{{ $setting->key }}][file]" 
                                                    accept="image/*"
                                                    onchange="previewImage('{{ $setting->key }}', this)"
                                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                >
                                                
                                                <!-- Hidden inputs -->
                                                <input 
                                                    type="hidden" 
                                                    name="settings[{{ $setting->key }}][value]" 
                                                    id="hidden-value-{{ $setting->key }}"
                                                    value="{{ old('settings.' . $setting->key . '.value', $setting->value) }}"
                                                >
                                                <input 
                                                    type="hidden" 
                                                    name="settings[{{ $setting->key }}][clear]" 
                                                    id="clear-flag-{{ $setting->key }}"
                                                    value="0"
                                                >
                                            </div>
                                        @else
                                            <!-- Regular Text Field -->
                                            <input 
                                                type="text" 
                                                name="settings[{{ $setting->key }}][value]" 
                                                id="settings[{{ $setting->key }}][value]" 
                                                value="{{ old('settings.' . $setting->key . '.value', $setting->value) }}" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            >
                                        @endif
                                        
                                        @error("settings.{$setting->key}.value")
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                        @error("settings.{$setting->key}.file")
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

<script>
function previewImage(settingKey, input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Show new image preview
            document.getElementById('new-image-preview-' + settingKey).classList.remove('hidden');
            document.getElementById('preview-new-' + settingKey).src = e.target.result;
            document.getElementById('filename-' + settingKey).textContent = file.name;
        };
        reader.readAsDataURL(file);
    }
}

function clearNewImage(settingKey) {
    // Hide new image preview
    document.getElementById('new-image-preview-' + settingKey).classList.add('hidden');
    
    // Clear file input
    document.getElementById('settings[' + settingKey + '][file]').value = '';
    
    // Clear preview image
    document.getElementById('preview-new-' + settingKey).src = '';
    document.getElementById('filename-' + settingKey).textContent = '';
}

function clearImage(settingKey) {
    if (confirm('Are you sure you want to remove this image?')) {
        // Hide current image
        document.getElementById('current-image-' + settingKey).classList.add('hidden');
        
        // Set clear flag
        document.getElementById('clear-flag-' + settingKey).value = '1';
        
        // Clear hidden value
        document.getElementById('hidden-value-' + settingKey).value = '';
    }
}
</script>
@endsection