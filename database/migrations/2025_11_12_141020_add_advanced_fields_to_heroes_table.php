<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            // Layout & Design
            $table->enum('layout_type', ['full-width', 'split', 'minimal', 'video', 'carousel'])
                  ->default('full-width')->after('is_active');
            $table->enum('content_alignment', ['left', 'center', 'right'])
                  ->default('center')->after('layout_type');
            $table->string('overlay_color', 7)->default('#000000')->after('background_image');
            $table->decimal('overlay_opacity', 3, 2)->default(0.50)->after('overlay_color');
            
            // Media
            $table->string('background_video')->nullable()->after('background_image');
            $table->string('video_poster')->nullable()->after('background_video');
            $table->boolean('video_autoplay')->default(true)->after('video_poster');
            $table->boolean('video_loop')->default(true)->after('video_autoplay');
            $table->boolean('video_muted')->default(true)->after('video_loop');
            
            // Animation
            $table->enum('animation_type', ['none', 'fade', 'slide', 'zoom'])
                  ->default('fade')->after('video_muted');
            $table->integer('animation_duration')->default(500)->after('animation_type');
            
            // Carousel Settings
            $table->boolean('carousel_autoplay')->default(true)->after('animation_duration');
            $table->integer('carousel_interval')->default(5000)->after('carousel_autoplay');
            $table->boolean('carousel_pause_on_hover')->default(true)->after('carousel_interval');
            
            // SEO
            $table->string('meta_title')->nullable()->after('carousel_pause_on_hover');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            
            // Advanced
            $table->text('custom_css')->nullable()->after('meta_keywords');
            $table->text('custom_js')->nullable()->after('custom_css');
            
            // Responsive Images
            $table->json('responsive_images')->nullable()->after('background_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn([
                'layout_type',
                'content_alignment',
                'overlay_color',
                'overlay_opacity',
                'background_video',
                'video_poster',
                'video_autoplay',
                'video_loop',
                'video_muted',
                'animation_type',
                'animation_duration',
                'carousel_autoplay',
                'carousel_interval',
                'carousel_pause_on_hover',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'custom_css',
                'custom_js',
                'responsive_images',
            ]);
        });
    }
};
