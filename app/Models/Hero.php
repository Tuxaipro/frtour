<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'tertiary_button_text',
        'tertiary_button_url',
        'background_image',
        'badge_text',
        'is_active',
        'sort_order',
        // Layout & Design
        'layout_type',
        'content_alignment',
        'overlay_color',
        'overlay_opacity',
        // Media
        'background_video',
        'video_poster',
        'video_autoplay',
        'video_loop',
        'video_muted',
        // Animation
        'animation_type',
        'animation_duration',
        // Carousel Settings
        'carousel_autoplay',
        'carousel_interval',
        'carousel_pause_on_hover',
        // SEO
        'meta_title',
        'meta_description',
        'meta_keywords',
        // Advanced
        'custom_css',
        'custom_js',
        // Responsive Images
        'responsive_images',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'video_autoplay' => 'boolean',
        'video_loop' => 'boolean',
        'video_muted' => 'boolean',
        'carousel_autoplay' => 'boolean',
        'carousel_pause_on_hover' => 'boolean',
        'overlay_opacity' => 'decimal:2',
        'responsive_images' => 'array',
    ];

    /**
     * Scope a query to only include active heroes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    /**
     * Get the background image URL.
     */
    public function getBackgroundImageUrlAttribute()
    {
        if (!$this->background_image) {
            return null;
        }
        return asset('storage/' . $this->background_image);
    }

    /**
     * Get the background video URL.
     */
    public function getBackgroundVideoUrlAttribute()
    {
        if (!$this->background_video) {
            return null;
        }
        return asset('storage/' . $this->background_video);
    }

    /**
     * Get the video poster URL.
     */
    public function getVideoPosterUrlAttribute()
    {
        if (!$this->video_poster) {
            return $this->background_image_url;
        }
        return asset('storage/' . $this->video_poster);
    }

    /**
     * Get overlay style for background.
     */
    public function getOverlayStyleAttribute()
    {
        $color = $this->overlay_color ?? '#000000';
        $opacity = $this->overlay_opacity ?? 0.50;
        
        // Convert hex to rgba
        $rgb = $this->hexToRgb($color);
        return "background-color: rgba({$rgb['r']}, {$rgb['g']}, {$rgb['b']}, {$opacity});";
    }

    /**
     * Convert hex color to RGB.
     */
    private function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return ['r' => $r, 'g' => $g, 'b' => $b];
    }

    /**
     * Get content alignment classes.
     */
    public function getContentAlignmentClassesAttribute()
    {
        return match($this->content_alignment ?? 'center') {
            'left' => 'text-left items-start',
            'right' => 'text-right items-end',
            default => 'text-center items-center',
        };
    }
}
