@extends('layouts.admin')

@section('title', 'Site Settings')
@section('subtitle', 'Manage your site configuration and preferences')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Site Settings</h1>
            <p class="text-sm text-slate-600 mt-1.5 font-medium">Manage your site configuration and preferences</p>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-xl shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @foreach($settings as $group => $groupSettings)
                    <div class="mb-10 last:mb-0">
                        <div class="mb-6 pb-3 border-b-2 border-slate-200">
                            <h2 class="text-xl font-bold text-slate-900 capitalize">{{ $group }} Settings</h2>
                            <p class="text-xs text-slate-500 mt-1">Configure {{ strtolower($group) }} related settings</p>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @foreach($groupSettings as $setting)
                                <div class="space-y-2">
                                    <label for="settings[{{ $setting->key }}][value]" class="block text-sm font-semibold text-slate-700 capitalize">
                                        {{ str_replace('_', ' ', $setting->key) }}
                                    </label>
                                    <input type="hidden" name="settings[{{ $setting->key }}][key]" value="{{ $setting->key }}">
                                    
                                    @if($setting->type === 'boolean')
                                        <!-- Boolean/Checkbox Field -->
                                        <div class="flex items-center space-x-3">
                                            <input type="hidden" name="settings[{{ $setting->key }}][value]" value="0">
                                            <input 
                                                type="checkbox" 
                                                name="settings[{{ $setting->key }}][value]" 
                                                id="settings[{{ $setting->key }}][value]" 
                                                value="1"
                                                {{ old('settings.' . $setting->key . '.value', $setting->value) == '1' || old('settings.' . $setting->key . '.value', $setting->value) == 1 || old('settings.' . $setting->key . '.value', $setting->value) === true ? 'checked' : '' }}
                                                class="w-5 h-5 text-primary border-2 border-slate-300 rounded focus:ring-2 focus:ring-primary transition-colors duration-200"
                                            >
                                            <label for="settings[{{ $setting->key }}][value]" class="text-sm font-medium text-slate-700 cursor-pointer">
                                                Enable {{ str_replace('_', ' ', $setting->key) }}
                                            </label>
                                        </div>
                                    @elseif($setting->key === 'timezone')
                                        <!-- Timezone Dropdown -->
                                        <select 
                                            name="settings[{{ $setting->key }}][value]" 
                                            id="settings[{{ $setting->key }}][value]" 
                                            onchange="updateCurrencyAndLanguage(this.value)"
                                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error("settings.{$setting->key}.value") border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                        >
                                            @foreach($timezones as $tz)
                                                <option value="{{ $tz }}" {{ old('settings.' . $setting->key . '.value', $setting->value) == $tz ? 'selected' : '' }}>
                                                    {{ $tz }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-slate-500 mt-2 px-1">Select your timezone. Currency and language will be auto-selected based on your choice.</p>
                                    @elseif($setting->key === 'currency')
                                        <!-- Currency Dropdown -->
                                        <select 
                                            name="settings[{{ $setting->key }}][value]" 
                                            id="settings[{{ $setting->key }}][value]" 
                                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error("settings.{$setting->key}.value") border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                        >
                                            @foreach($currencies as $code => $label)
                                                <option value="{{ $code }}" {{ old('settings.' . $setting->key . '.value', $setting->value) == $code ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif($setting->key === 'language')
                                        <!-- Language Dropdown -->
                                        <select 
                                            name="settings[{{ $setting->key }}][value]" 
                                            id="settings[{{ $setting->key }}][value]" 
                                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 bg-white @error("settings.{$setting->key}.value") border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                        >
                                            @foreach($languages as $code => $label)
                                                <option value="{{ $code }}" {{ old('settings.' . $setting->key . '.value', $setting->value) == $code ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif($setting->type === 'integer' || $setting->type === 'number')
                                        <!-- Number Field -->
                                        <div class="space-y-1">
                                            <input 
                                                type="number" 
                                                name="settings[{{ $setting->key }}][value]" 
                                                id="settings[{{ $setting->key }}][value]" 
                                                value="{{ old('settings.' . $setting->key . '.value', $setting->value) }}" 
                                                class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error("settings.{$setting->key}.value") border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}"
                                                @if($setting->key === 'carousel_interval') min="1000" max="30000" step="500" @endif
                                            >
                                            @if($setting->key === 'carousel_interval')
                                                <p class="text-xs text-slate-500 px-1">Time between slides in milliseconds (1000-30000ms)</p>
                                            @endif
                                        </div>
                                    @elseif(in_array($setting->key, ['site_logo', 'logo_light', 'site_favicon']))
                                        <!-- Image Upload Field -->
                                        <div class="space-y-3">
                                            <!-- Current Image Display -->
                                            <div id="current-image-{{ $setting->key }}" class="{{ $setting->value ? '' : 'hidden' }}">
                                                <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                                                    <div class="flex-shrink-0">
                                                        @php
                                                            $imagePath = $setting->value ? trim(trim($setting->value, '"\''), '/') : '';
                                                            $imageUrl = $imagePath ? asset('storage/' . ltrim($imagePath, '/')) : '';
                                                        @endphp
                                                        <img src="{{ $imageUrl }}" alt="{{ $setting->key }}" class="h-20 w-20 object-contain border-2 border-slate-200 rounded-lg bg-white p-1" id="preview-{{ $setting->key }}" onerror="this.style.display='none'">
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-slate-700">Current Image</p>
                                                        <p class="text-xs text-slate-500 truncate">{{ $setting->value ? basename($setting->value) : '' }}</p>
                                                    </div>
                                                    <button type="button" onclick="clearImage('{{ $setting->key }}')" class="flex-shrink-0 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200 text-red-600 hover:text-red-800" title="Remove image">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- New Image Preview -->
                                            <div id="new-image-preview-{{ $setting->key }}" class="hidden">
                                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                                    <div class="flex-shrink-0">
                                                        <img id="preview-new-{{ $setting->key }}" src="" alt="New {{ $setting->key }}" class="h-20 w-20 object-contain border-2 border-blue-200 rounded-lg bg-white p-1">
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-blue-700">New Image Preview</p>
                                                        <p class="text-xs text-blue-600 truncate" id="filename-{{ $setting->key }}"></p>
                                                    </div>
                                                    <button type="button" onclick="clearNewImage('{{ $setting->key }}')" class="flex-shrink-0 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200 text-red-600 hover:text-red-800" title="Cancel upload">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- File Input (Single file only - no multiple attribute) -->
                                            <div class="relative">
                                                <input 
                                                    type="file" 
                                                    name="settings[{{ $setting->key }}][file]" 
                                                    id="settings[{{ $setting->key }}][file]" 
                                                    accept="image/*"
                                                    onchange="previewImage('{{ $setting->key }}', this)"
                                                    class="block w-full text-sm text-slate-600 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer cursor-pointer border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                                                >
                                            </div>
                                            <p class="text-xs text-slate-500 mt-2 px-2">Maximum file size: 5MB. Supported formats: JPG, PNG, GIF, SVG, ICO</p>
                                            
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
                                            class="w-full px-4 py-3 border-2 border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 text-slate-900 placeholder-slate-400 @error("settings.{$setting->key}.value") border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key) }}"
                                        >
                                    @endif
                                    
                                    @error("settings.{$setting->key}.value")
                                        <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    @error("settings.{$setting->key}.file")
                                        <p class="text-red-600 text-xs mt-2 flex items-center bg-red-50 px-3 py-2 rounded-lg border border-red-200">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="flex items-center justify-end gap-3 pt-6 mt-8 border-t-2 border-slate-200">
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 text-sm font-semibold text-slate-700 bg-white border-2 border-slate-200 rounded-xl hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 text-sm font-semibold text-white bg-primary rounded-xl hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-200 flex items-center shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Settings
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

<script>
function previewImage(settingKey, input) {
    // Ensure only one file is selected
    if (input.files.length > 1) {
        alert('Please select only one file at a time.');
        input.value = '';
        return;
    }
    
    const file = input.files[0];
    if (file) {
        // Check file size (5MB max)
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes
        if (file.size > maxSize) {
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            alert(`File size (${fileSizeMB}MB) exceeds the maximum allowed size (5MB). Please compress your image or choose a smaller file.`);
            input.value = '';
            return;
        }
        
        // Check file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid image file (JPG, PNG, GIF, SVG, ICO)');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            // Show new image preview
            document.getElementById('new-image-preview-' + settingKey).classList.remove('hidden');
            document.getElementById('preview-new-' + settingKey).src = e.target.result;
            const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
            document.getElementById('filename-' + settingKey).textContent = file.name + ' (' + fileSizeMB + ' MB)';
            
            // Reset clear flag when new file is selected
            document.getElementById('clear-flag-' + settingKey).value = '0';
        };
        reader.readAsDataURL(file);
    }
}

function clearNewImage(settingKey) {
    // Hide new image preview
    document.getElementById('new-image-preview-' + settingKey).classList.add('hidden');
    
    // Clear file input
    const fileInput = document.getElementById('settings[' + settingKey + '][file]');
    if (fileInput) {
        fileInput.value = '';
    }
    
    // Clear preview image
    document.getElementById('preview-new-' + settingKey).src = '';
    document.getElementById('filename-' + settingKey).textContent = '';
    
    // Reset clear flag
    document.getElementById('clear-flag-' + settingKey).value = '0';
}

function clearImage(settingKey) {
    if (confirm('Are you sure you want to remove this image?')) {
        // Hide current image
        document.getElementById('current-image-' + settingKey).classList.add('hidden');
        
        // Set clear flag
        document.getElementById('clear-flag-' + settingKey).value = '1';
        
        // Clear hidden value
        document.getElementById('hidden-value-' + settingKey).value = '';
        
        // Clear any new file input
        const fileInput = document.getElementById('settings[' + settingKey + '][file]');
        if (fileInput) {
            fileInput.value = '';
        }
        
        // Hide new image preview if visible
        document.getElementById('new-image-preview-' + settingKey).classList.add('hidden');
    }
}

// Timezone to Currency and Language mapping
const timezoneMappings = {
    // Europe
    'Europe/Paris': { currency: 'EUR', language: 'fr' },
    'Europe/London': { currency: 'GBP', language: 'en' },
    'Europe/Berlin': { currency: 'EUR', language: 'de' },
    'Europe/Madrid': { currency: 'EUR', language: 'es' },
    'Europe/Rome': { currency: 'EUR', language: 'it' },
    'Europe/Amsterdam': { currency: 'EUR', language: 'nl' },
    'Europe/Brussels': { currency: 'EUR', language: 'fr' },
    'Europe/Vienna': { currency: 'EUR', language: 'de' },
    'Europe/Zurich': { currency: 'CHF', language: 'de' },
    'Europe/Stockholm': { currency: 'SEK', language: 'en' },
    'Europe/Oslo': { currency: 'NOK', language: 'en' },
    'Europe/Copenhagen': { currency: 'DKK', language: 'en' },
    'Europe/Warsaw': { currency: 'PLN', language: 'en' },
    'Europe/Prague': { currency: 'CZK', language: 'en' },
    'Europe/Budapest': { currency: 'HUF', language: 'en' },
    'Europe/Moscow': { currency: 'RUB', language: 'ru' },
    'Europe/Lisbon': { currency: 'EUR', language: 'pt' },
    'Europe/Athens': { currency: 'EUR', language: 'en' },
    'Europe/Dublin': { currency: 'EUR', language: 'en' },
    'Europe/Helsinki': { currency: 'EUR', language: 'en' },
    
    // Americas
    'America/New_York': { currency: 'USD', language: 'en' },
    'America/Chicago': { currency: 'USD', language: 'en' },
    'America/Denver': { currency: 'USD', language: 'en' },
    'America/Los_Angeles': { currency: 'USD', language: 'en' },
    'America/Toronto': { currency: 'CAD', language: 'en' },
    'America/Mexico_City': { currency: 'MXN', language: 'es' },
    'America/Sao_Paulo': { currency: 'BRL', language: 'pt' },
    'America/Buenos_Aires': { currency: 'USD', language: 'es' },
    'America/Lima': { currency: 'USD', language: 'es' },
    'America/Bogota': { currency: 'USD', language: 'es' },
    'America/Santiago': { currency: 'USD', language: 'es' },
    
    // Asia
    'Asia/Kolkata': { currency: 'INR', language: 'hi' },
    'Asia/Dubai': { currency: 'AED', language: 'ar' },
    'Asia/Singapore': { currency: 'SGD', language: 'en' },
    'Asia/Hong_Kong': { currency: 'HKD', language: 'zh' },
    'Asia/Tokyo': { currency: 'JPY', language: 'ja' },
    'Asia/Seoul': { currency: 'KRW', language: 'ko' },
    'Asia/Shanghai': { currency: 'CNY', language: 'zh' },
    'Asia/Bangkok': { currency: 'THB', language: 'th' },
    'Asia/Kuala_Lumpur': { currency: 'MYR', language: 'en' },
    'Asia/Jakarta': { currency: 'IDR', language: 'en' },
    'Asia/Manila': { currency: 'PHP', language: 'en' },
    'Asia/Ho_Chi_Minh': { currency: 'VND', language: 'vi' },
    
    // Oceania
    'Australia/Sydney': { currency: 'AUD', language: 'en' },
    'Australia/Melbourne': { currency: 'AUD', language: 'en' },
    'Pacific/Auckland': { currency: 'NZD', language: 'en' },
    
    // Africa
    'Africa/Johannesburg': { currency: 'ZAR', language: 'en' },
    'Africa/Cairo': { currency: 'EGP', language: 'ar' },
};

function updateCurrencyAndLanguage(timezone) {
    const mapping = timezoneMappings[timezone];
    if (mapping) {
        // Update currency - use querySelector with name attribute
        const currencySelect = document.querySelector('select[name="settings[currency][value]"]');
        if (currencySelect) {
            currencySelect.value = mapping.currency;
            // Trigger change event to ensure any listeners are notified
            currencySelect.dispatchEvent(new Event('change', { bubbles: true }));
        }
        
        // Update language - use querySelector with name attribute
        const languageSelect = document.querySelector('select[name="settings[language][value]"]');
        if (languageSelect) {
            languageSelect.value = mapping.language;
            // Trigger change event to ensure any listeners are notified
            languageSelect.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
}
</script>
@endsection