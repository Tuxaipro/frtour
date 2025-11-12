<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        
        // Get all timezones for dropdown
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        
        // Common currencies
        $currencies = [
            'EUR' => 'EUR - Euro',
            'USD' => 'USD - US Dollar',
            'GBP' => 'GBP - British Pound',
            'INR' => 'INR - Indian Rupee',
            'CNY' => 'CNY - Chinese Yuan',
            'JPY' => 'JPY - Japanese Yen',
            'AUD' => 'AUD - Australian Dollar',
            'CAD' => 'CAD - Canadian Dollar',
            'CHF' => 'CHF - Swiss Franc',
            'NZD' => 'NZD - New Zealand Dollar',
            'SGD' => 'SGD - Singapore Dollar',
            'HKD' => 'HKD - Hong Kong Dollar',
            'SEK' => 'SEK - Swedish Krona',
            'NOK' => 'NOK - Norwegian Krone',
            'DKK' => 'DKK - Danish Krone',
            'PLN' => 'PLN - Polish Zloty',
            'CZK' => 'CZK - Czech Koruna',
            'HUF' => 'HUF - Hungarian Forint',
            'RUB' => 'RUB - Russian Ruble',
            'BRL' => 'BRL - Brazilian Real',
            'MXN' => 'MXN - Mexican Peso',
            'ZAR' => 'ZAR - South African Rand',
            'KRW' => 'KRW - South Korean Won',
            'THB' => 'THB - Thai Baht',
            'AED' => 'AED - UAE Dirham',
            'MYR' => 'MYR - Malaysian Ringgit',
            'IDR' => 'IDR - Indonesian Rupiah',
            'PHP' => 'PHP - Philippine Peso',
            'VND' => 'VND - Vietnamese Dong',
            'EGP' => 'EGP - Egyptian Pound',
        ];
        
        // Common languages (widely spoken languages)
        $languages = [
            'en' => 'English',
            'zh' => '中文 (Chinese - Mandarin)',
            'hi' => 'हिन्दी (Hindi)',
            'es' => 'Español (Spanish)',
            'fr' => 'Français (French)',
            'ar' => 'العربية (Arabic)',
            'bn' => 'বাংলা (Bengali)',
            'pt' => 'Português (Portuguese)',
            'ru' => 'Русский (Russian)',
            'ja' => '日本語 (Japanese)',
            'de' => 'Deutsch (German)',
            'ko' => '한국어 (Korean)',
            'tr' => 'Türkçe (Turkish)',
            'vi' => 'Tiếng Việt (Vietnamese)',
            'it' => 'Italiano (Italian)',
            'th' => 'ไทย (Thai)',
            'ur' => 'اردو (Urdu)',
            'pl' => 'Polski (Polish)',
            'nl' => 'Nederlands (Dutch)',
            'id' => 'Bahasa Indonesia (Indonesian)',
            'ms' => 'Bahasa Melayu (Malay)',
            'sw' => 'Kiswahili (Swahili)',
            'ta' => 'தமிழ் (Tamil)',
            'te' => 'తెలుగు (Telugu)',
            'mr' => 'मराठी (Marathi)',
            'gu' => 'ગુજરાતી (Gujarati)',
            'kn' => 'ಕನ್ನಡ (Kannada)',
            'pa' => 'ਪੰਜਾਬੀ (Punjabi)',
            'fa' => 'فارسی (Persian/Farsi)',
            'he' => 'עברית (Hebrew)',
            'cs' => 'Čeština (Czech)',
            'sv' => 'Svenska (Swedish)',
            'ro' => 'Română (Romanian)',
            'hu' => 'Magyar (Hungarian)',
            'el' => 'Ελληνικά (Greek)',
            'da' => 'Dansk (Danish)',
            'fi' => 'Suomi (Finnish)',
            'no' => 'Norsk (Norwegian)',
            'sk' => 'Slovenčina (Slovak)',
            'bg' => 'Български (Bulgarian)',
            'hr' => 'Hrvatski (Croatian)',
            'sr' => 'Српски (Serbian)',
            'uk' => 'Українська (Ukrainian)',
            'ca' => 'Català (Catalan)',
            'eu' => 'Euskara (Basque)',
            'ga' => 'Gaeilge (Irish)',
            'cy' => 'Cymraeg (Welsh)',
            'mt' => 'Malti (Maltese)',
            'is' => 'Íslenska (Icelandic)',
            'lv' => 'Latviešu (Latvian)',
            'lt' => 'Lietuvių (Lithuanian)',
            'et' => 'Eesti (Estonian)',
            'sl' => 'Slovenščina (Slovenian)',
            'mk' => 'Македонски (Macedonian)',
            'sq' => 'Shqip (Albanian)',
            'bs' => 'Bosanski (Bosnian)',
            'ka' => 'ქართული (Georgian)',
            'hy' => 'Հայերեն (Armenian)',
            'az' => 'Azərbaycan (Azerbaijani)',
            'kk' => 'Қазақ (Kazakh)',
            'uz' => 'Oʻzbek (Uzbek)',
            'ky' => 'Кыргызча (Kyrgyz)',
            'mn' => 'Монгол (Mongolian)',
            'ne' => 'नेपाली (Nepali)',
            'si' => 'සිංහල (Sinhala)',
            'my' => 'မြန်မာ (Burmese)',
            'km' => 'ខ្មែរ (Khmer)',
            'lo' => 'ລາວ (Lao)',
            'am' => 'አማርኛ (Amharic)',
            'zu' => 'isiZulu (Zulu)',
            'af' => 'Afrikaans',
            'xh' => 'isiXhosa (Xhosa)',
            'yo' => 'Yorùbá (Yoruba)',
            'ig' => 'Igbo',
            'ha' => 'Hausa',
            'so' => 'Soomaali (Somali)',
            'rw' => 'Kinyarwanda',
            'mg' => 'Malagasy',
            'jv' => 'Basa Jawa (Javanese)',
            'su' => 'Basa Sunda (Sundanese)',
            'ceb' => 'Cebuano',
            'tl' => 'Tagalog (Filipino)',
            'haw' => 'ʻŌlelo Hawaiʻi (Hawaiian)',
            'mi' => 'Te Reo Māori (Māori)',
        ];
        
        return view('admin.settings.index', compact('settings', 'timezones', 'currencies', 'languages'));
    }

    /**
     * Update the specified settings.
     */
    public function update(Request $request)
    {
        // Validate non-file fields first
        $validated = $request->validate([
            'settings' => 'array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
            'settings.*.clear' => 'nullable|string',
        ]);

        // Get all files from request
        $allFiles = $request->allFiles();
        $settings = $request->input('settings', []);

        // Validate file uploads manually for image settings
        foreach ($settings as $settingKey => $settingData) {
            $actualSettingKey = $settingData['key'] ?? null;
            
            if (in_array($actualSettingKey, ['site_logo', 'logo_light', 'site_favicon'])) {
                // Check if file exists in the request - try multiple access methods
                $file = null;
                
                // Method 1: Direct array access
                if (isset($allFiles['settings'][$settingKey]['file'])) {
                    $file = $allFiles['settings'][$settingKey]['file'];
                }
                // Method 2: Try hasFile with dot notation
                elseif ($request->hasFile("settings.{$settingKey}.file")) {
                    $file = $request->file("settings.{$settingKey}.file");
                }
                // Method 3: Try hasFile with array notation
                elseif ($request->hasFile("settings[{$settingKey}][file]")) {
                    $file = $request->file("settings[{$settingKey}][file]");
                }
                
                // Check for file upload errors
                if ($file) {
                    // Check if file upload failed
                    if (!$file->isValid()) {
                        $errorMessage = 'File upload failed.';
                        $errorCode = $file->getError();
                        
                        switch ($errorCode) {
                            case UPLOAD_ERR_INI_SIZE:
                            case UPLOAD_ERR_FORM_SIZE:
                                $errorMessage = 'The file size exceeds the maximum allowed size (5MB). Please compress your image or choose a smaller file.';
                                break;
                            case UPLOAD_ERR_PARTIAL:
                                $errorMessage = 'The file was only partially uploaded.';
                                break;
                            case UPLOAD_ERR_NO_FILE:
                                $errorMessage = 'No file was uploaded.';
                                break;
                            case UPLOAD_ERR_NO_TMP_DIR:
                                $errorMessage = 'Missing a temporary folder.';
                                break;
                            case UPLOAD_ERR_CANT_WRITE:
                                $errorMessage = 'Failed to write file to disk.';
                                break;
                            case UPLOAD_ERR_EXTENSION:
                                $errorMessage = 'A PHP extension stopped the file upload.';
                                break;
                        }
                        
                        return redirect()->back()
                            ->withErrors(["settings.{$settingKey}.file" => $errorMessage])
                            ->withInput();
                    }
                    
                    // Check file type
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/x-icon', 'image/vnd.microsoft.icon'];
                    if (!in_array($file->getMimeType(), $allowedMimes)) {
                        return redirect()->back()
                            ->withErrors(["settings.{$settingKey}.file" => 'The file must be an image (jpeg, png, jpg, gif, svg, ico).'])
                            ->withInput();
                    }
                    
                    // Check file size (5MB = 5120 KB)
                    $maxSize = 5 * 1024 * 1024; // 5MB in bytes
                    if ($file->getSize() > $maxSize) {
                        $fileSizeMB = round($file->getSize() / (1024 * 1024), 2);
                        return redirect()->back()
                            ->withErrors(["settings.{$settingKey}.file" => "The file size ({$fileSizeMB}MB) exceeds the maximum allowed size (5MB). Please compress your image or choose a smaller file."])
                            ->withInput();
                    }
                }
            }
        }

        // Process settings
        if (isset($validated['settings'])) {
            foreach ($validated['settings'] as $settingKey => $settingData) {
                $actualSettingKey = $settingData['key'];
                $settingValue = $settingData['value'] ?? null;
                
                // Handle image settings (logo and favicon)
                if (in_array($actualSettingKey, ['site_logo', 'logo_light', 'site_favicon'])) {
                    // Get the old setting first
                    $oldSetting = Setting::where('key', $actualSettingKey)->first();
                    
                    // Check if clear flag is set (handle both string "1" and boolean true)
                    $clearFlag = $request->input("settings.{$settingKey}.clear", '0');
                    $shouldClear = $clearFlag === '1' || $clearFlag === 1 || $clearFlag === true;
                    
                    // Get file from request - try multiple access methods
                    $file = null;
                    
                    // Method 1: Direct array access
                    if (isset($allFiles['settings'][$settingKey]['file'])) {
                        $file = $allFiles['settings'][$settingKey]['file'];
                    }
                    // Method 2: Try hasFile with dot notation
                    elseif ($request->hasFile("settings.{$settingKey}.file")) {
                        $file = $request->file("settings.{$settingKey}.file");
                    }
                    // Method 3: Try hasFile with array notation
                    elseif ($request->hasFile("settings[{$settingKey}][file]")) {
                        $file = $request->file("settings[{$settingKey}][file]");
                    }
                    
                    if ($shouldClear) {
                        // Delete existing file
                        if ($oldSetting) {
                            $oldRawValue = $oldSetting->getAttributes()['value'] ?? null;
                            if ($oldRawValue) {
                                // Clean the path before deleting
                                $oldPath = trim(trim($oldRawValue, '"\''), '/');
                                if ($oldPath) {
                                    try {
                                        Storage::disk('public')->delete($oldPath);
                                    } catch (\Exception $e) {
                                        // Log error but continue
                                        \Log::warning("Failed to delete setting file: {$oldPath}", ['error' => $e->getMessage()]);
                                    }
                                }
                            }
                        }
                        $settingValue = null; // Clear the setting
                    }
                    // Handle new file upload (only if clear is not set)
                    elseif ($file && $file->isValid()) {
                        // Delete old file if exists
                        if ($oldSetting) {
                            $oldRawValue = $oldSetting->getAttributes()['value'] ?? null;
                            if ($oldRawValue) {
                                // Clean the path before deleting
                                $oldPath = trim(trim($oldRawValue, '"\''), '/');
                                if ($oldPath) {
                                    try {
                                        Storage::disk('public')->delete($oldPath);
                                    } catch (\Exception $e) {
                                        // Log error but continue
                                        \Log::warning("Failed to delete setting file: {$oldPath}", ['error' => $e->getMessage()]);
                                    }
                                }
                            }
                        }
                        
                        // Store new file using Storage facade
                        $fileName = $actualSettingKey . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('settings', $fileName, 'public');
                        $settingValue = $filePath;
                    }
                    // If no clear and no new file, keep existing value
                    elseif ($oldSetting && $oldSetting->value) {
                        // Get raw value from database to preserve it
                        $rawValue = $oldSetting->getAttributes()['value'] ?? null;
                        $settingValue = $rawValue;
                    }
                } else {
                    // For non-image settings, clean the value before saving
                    $setting = Setting::where('key', $actualSettingKey)->first();
                    $settingType = $setting->type ?? 'string';
                    
                    if ($settingType === 'boolean') {
                        // Convert to '1' or '0' string for boolean settings
                        $settingValue = ($settingValue == '1' || $settingValue == 1 || $settingValue === true) ? '1' : '0';
                    } elseif ($settingType === 'integer' || $settingType === 'number') {
                        // Ensure integer values are properly formatted
                        $settingValue = $settingValue !== null ? (string) (int) $settingValue : null;
                    } elseif (is_string($settingValue) && !empty($settingValue)) {
                        $settingValue = trim($settingValue);
                        // Don't trim quotes for text fields, only clean whitespace
                    }
                }
                
                Setting::updateOrCreate(
                    ['key' => $actualSettingKey],
                    ['value' => $settingValue]
                );
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}