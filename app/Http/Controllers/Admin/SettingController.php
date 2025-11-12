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
        
        return view('admin.settings.index', compact('settings'));
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
                        if ($oldSetting && $oldSetting->value) {
                            Storage::disk('public')->delete($oldSetting->value);
                        }
                        $settingValue = null; // Clear the setting
                    }
                    // Handle new file upload (only if clear is not set)
                    elseif ($file && $file->isValid()) {
                        // Delete old file if exists
                        if ($oldSetting && $oldSetting->value) {
                            Storage::disk('public')->delete($oldSetting->value);
                        }
                        
                        // Store new file using Storage facade
                        $fileName = $actualSettingKey . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('settings', $fileName, 'public');
                        $settingValue = $filePath;
                    }
                    // If no clear and no new file, keep existing value
                    elseif ($oldSetting && $oldSetting->value) {
                        $settingValue = $oldSetting->value;
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