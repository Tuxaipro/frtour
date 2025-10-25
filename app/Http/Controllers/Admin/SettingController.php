<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'settings' => 'array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
            'settings.*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            'settings.*.clear' => 'nullable|boolean',
        ]);

        if (isset($validated['settings'])) {
            foreach ($validated['settings'] as $key => $settingData) {
                $settingValue = $settingData['value'];
                
                // Handle image settings (logo and favicon)
                if (in_array($settingData['key'], ['site_logo', 'logo_light', 'site_favicon'])) {
                    // Check if clear flag is set
                    if (isset($settingData['clear']) && $settingData['clear']) {
                        // Delete existing file
                        $oldSetting = Setting::where('key', $settingData['key'])->first();
                        if ($oldSetting && $oldSetting->value) {
                            $oldFilePath = storage_path('app/public/' . $oldSetting->value);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $settingValue = null; // Clear the setting
                    }
                    // Handle new file upload
                    elseif ($request->hasFile("settings.{$key}.file")) {
                        $file = $request->file("settings.{$key}.file");
                        
                        // Delete old file if exists
                        $oldSetting = Setting::where('key', $settingData['key'])->first();
                        if ($oldSetting && $oldSetting->value) {
                            $oldFilePath = storage_path('app/public/' . $oldSetting->value);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        
                        // Store new file
                        $fileName = $settingData['key'] . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $filePath = $file->storeAs('settings', $fileName, 'public');
                        $settingValue = $filePath;
                    }
                }
                
                Setting::updateOrCreate(
                    ['key' => $settingData['key']],
                    ['value' => $settingValue]
                );
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}