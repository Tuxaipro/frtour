<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(10, true),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(10),
            'featured_image' => null,
            'is_published' => true,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the blog should be unpublished.
     */
    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the blog has a featured image.
     */
    public function withImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured_image' => 'blog_images/' . Str::random(10) . '.jpg',
        ]);
    }
}

