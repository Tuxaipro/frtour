<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    // Don't cast value as array - values are stored as strings/text
    // protected $casts = [
    //     'value' => 'array',
    // ];

    /**
     * Accessor to clean the value when accessing it
     */
    public function getValueAttribute($value)
    {
        if (is_string($value) && !empty($value)) {
            $value = trim($value);
            $value = trim($value, '"\'');
            // Fix double slashes in paths
            $value = preg_replace('#/+#', '/', $value);
            // Decode Unicode escape sequences like \u00e9
            $value = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($match) {
                return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
            }, $value);
        }
        return $value;
    }

    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        try {
        $setting = self::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            // Return the raw value (as string/text)
            $value = $setting->getAttributes()['value'] ?? $default;
            
            // Clean the value: remove quotes and fix double slashes if it's a path
            if (is_string($value) && !empty($value)) {
                $value = trim($value);
                $value = trim($value, '"\'');
                // Fix double slashes in paths
                $value = preg_replace('#/+#', '/', $value);
                // Decode Unicode escape sequences like \u00e9
                $value = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($match) {
                    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
                }, $value);
            }
            
            return $value;
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Set a setting value by key.
     *
     * @param string $key
     * @param mixed $value
     * @param string $type
     * @param string $group
     * @return void
     */
    public static function set($key, $value, $type = 'string', $group = 'general')
    {
        self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group
            ]
        );
    }
}