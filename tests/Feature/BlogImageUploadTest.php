<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // Create an admin user
    $this->user = User::factory()->create([
        'is_admin' => true,
    ]);
    
    $this->actingAs($this->user);
});

test('it can display blog create form with image upload field', function () {
    $response = $this->get(route('admin.blogs.create'));
    
    $response->assertStatus(200);
    $response->assertSee('Featured Image', false);
    $response->assertSee('featured_image', false);
});

test('it can upload featured image when creating blog', function () {
    Storage::fake('public');
    
    $image = UploadedFile::fake()->image('blog-image.jpg', 800, 600);
    
    $data = [
        'title' => 'Test Blog Post',
        'content' => 'This is test content for blog post.',
        'featured_image' => $image,
        'is_published' => true,
    ];

    $response = $this->post(route('admin.blogs.store'), $data);
    
    $response->assertRedirect(route('admin.blogs.index'));
    $response->assertSessionHas('success');
    
    $blog = Blog::where('title', 'Test Blog Post')->first();
    expect($blog)->not()->toBeNull();
    expect($blog->featured_image)->not()->toBeNull();
    expect($blog->featured_image)->toContain('blog_images/');
    
    // Assert file was stored
    Storage::disk('public')->assertExists($blog->featured_image);
});

test('it can display current image in edit form', function () {
    Storage::fake('public');
    
    $blog = Blog::factory()->create([
        'featured_image' => 'blog_images/test-image.jpg',
    ]);
    
    // Create a fake file in storage
    Storage::disk('public')->put('blog_images/test-image.jpg', 'fake image content');
    
    $response = $this->get(route('admin.blogs.edit', $blog));
    
    $response->assertStatus(200);
    $response->assertSee('Current Image');
    $response->assertSee('test-image.jpg');
    $response->assertSee('View');
    $response->assertSee('Remove');
});

test('it can update featured image', function () {
    Storage::fake('public');
    
    // Create blog with initial image
    $blog = Blog::factory()->create([
        'featured_image' => 'blog_images/old-image.jpg',
    ]);
    
    Storage::disk('public')->put('blog_images/old-image.jpg', 'old content');
    
    // Upload new image
    $newImage = UploadedFile::fake()->image('new-blog-image.jpg', 800, 600);
    
    $data = [
        'title' => $blog->title,
        'content' => $blog->content,
        'featured_image' => $newImage,
        'is_published' => $blog->is_published,
    ];

    $response = $this->put(route('admin.blogs.update', $blog), $data);
    
    $response->assertRedirect(route('admin.blogs.index'));
    $response->assertSessionHas('success');
    
    $blog->refresh();
    expect($blog->featured_image)->not()->toBeNull();
    expect($blog->featured_image)->toContain('blog_images/');
    expect($blog->featured_image)->not()->toBe('blog_images/old-image.jpg');
    
    // Assert old image was deleted and new image was stored
    Storage::disk('public')->assertMissing('blog_images/old-image.jpg');
    Storage::disk('public')->assertExists($blog->featured_image);
});

test('it can remove featured image', function () {
    Storage::fake('public');
    
    $blog = Blog::factory()->create([
        'featured_image' => 'blog_images/test-image.jpg',
    ]);
    
    Storage::disk('public')->put('blog_images/test-image.jpg', 'fake content');
    
    $data = [
        'title' => $blog->title,
        'content' => $blog->content,
        'remove_featured_image' => '1',
        'is_published' => $blog->is_published,
    ];

    $response = $this->put(route('admin.blogs.update', $blog), $data);
    
    $response->assertRedirect(route('admin.blogs.index'));
    $response->assertSessionHas('success');
    
    $blog->refresh();
    expect($blog->featured_image)->toBeNull();
    
    // Assert file was deleted
    Storage::disk('public')->assertMissing('blog_images/test-image.jpg');
});

test('it validates image file type', function () {
    Storage::fake('public');
    
    $file = UploadedFile::fake()->create('document.pdf', 100);
    
    $data = [
        'title' => 'Test Blog Post',
        'content' => 'This is test content.',
        'featured_image' => $file,
    ];

    $response = $this->post(route('admin.blogs.store'), $data);
    
    $response->assertSessionHasErrors('featured_image');
});

test('it validates image file size', function () {
    Storage::fake('public');
    
    $image = UploadedFile::fake()->image('large-image.jpg')->size(3000); // 3MB
    
    $data = [
        'title' => 'Test Blog Post',
        'content' => 'This is test content.',
        'featured_image' => $image,
    ];

    $response = $this->post(route('admin.blogs.store'), $data);
    
    $response->assertSessionHasErrors('featured_image');
});

test('blog can exist without featured image', function () {
    Storage::fake('public');
    
    $data = [
        'title' => 'Test Blog Post',
        'content' => 'This is test content for blog post.',
        'is_published' => true,
    ];

    $response = $this->post(route('admin.blogs.store'), $data);
    
    $response->assertRedirect(route('admin.blogs.index'));
    
    $blog = Blog::where('title', 'Test Blog Post')->first();
    expect($blog)->not()->toBeNull();
    expect($blog->featured_image)->toBeNull();
});

test('featured image displays on frontend blog list', function () {
    Storage::fake('public');
    
    $blog = Blog::factory()->create([
        'title' => 'Test Blog',
        'featured_image' => 'blog_images/test.jpg',
        'is_published' => true,
    ]);
    
    Storage::disk('public')->put('blog_images/test.jpg', 'fake content');
    
    $response = $this->get(route('blog'));
    
    $response->assertStatus(200);
    $response->assertSee('storage/blog_images/test.jpg');
});

test('featured image displays on frontend blog detail', function () {
    Storage::fake('public');
    
    $blog = Blog::factory()->create([
        'title' => 'Test Blog',
        'slug' => 'test-blog',
        'featured_image' => 'blog_images/test.jpg',
        'is_published' => true,
    ]);
    
    Storage::disk('public')->put('blog_images/test.jpg', 'fake content');
    
    $response = $this->get(route('blog.show', 'test-blog'));
    
    $response->assertStatus(200);
    $response->assertSee('storage/blog_images/test.jpg');
    $response->assertSee($blog->title);
});

test('blog without image shows fallback gradient', function () {
    $blog = Blog::factory()->create([
        'title' => 'Test Blog Without Image',
        'slug' => 'test-blog-no-image',
        'featured_image' => null,
        'is_published' => true,
    ]);
    
    $response = $this->get(route('blog.show', 'test-blog-no-image'));
    
    $response->assertStatus(200);
    $response->assertDontSee('storage/blog_images/', false);
});

test('blog model includes featured image in fillable', function () {
    $fillable = (new Blog())->getFillable();
    
    expect($fillable)->toContain('featured_image');
});
