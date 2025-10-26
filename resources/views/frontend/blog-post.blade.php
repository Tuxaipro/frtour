<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ ($blog->meta_title ?? $blog->title) . ' — India Tourisme' }}</title>
  <meta name="description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',
            'primary-dark': '#1E40AF',
            'primary-light': '#DBEAFE'
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif']
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    html { scroll-behavior: smooth; }
    
    /* Ensure sticky positioning works */
    #header-container {
      position: -webkit-sticky !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 50 !important;
      width: 100% !important;
    }
    
    #header-container > nav {
      position: -webkit-sticky !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 50 !important;
      background-color: rgba(255, 255, 255, 0.95) !important;
      backdrop-filter: blur(10px) !important;
      -webkit-backdrop-filter: blur(10px) !important;
    }
    
    /* Enhanced Prose Styles */
    .prose-custom {
      @apply text-slate-700 leading-relaxed;
    }
    
    .prose-custom h2 {
      @apply text-3xl font-bold text-slate-900 mt-12 mb-6;
    }
    
    .prose-custom h3 {
      @apply text-2xl font-bold text-slate-900 mt-8 mb-4;
    }
    
    .prose-custom p {
      @apply mb-6 leading-relaxed;
    }
    
    .prose-custom ul, .prose-custom ol {
      @apply mb-6 ml-6;
    }
    
    .prose-custom li {
      @apply mb-3;
    }
    
    .prose-custom strong {
      @apply font-bold text-slate-900;
    }
    
    .prose-custom a {
      @apply text-primary hover:text-primary-dark underline;
    }
    
    .prose-custom blockquote {
      @apply border-l-4 border-primary pl-6 italic my-8;
    }
    
    .prose-custom img {
      @apply rounded-lg shadow-lg my-8;
    }
  </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">
  <!-- Header Container -->
  <div id="header-container"></div>

  <main>
<!-- Article Hero Section with Featured Image -->
@if($blog->featured_image)
<section class="relative h-[400px] lg:h-[500px] overflow-hidden">
  <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="absolute inset-0 w-full h-full object-cover">
  <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/60 to-black/80"></div>
  <div class="relative h-full max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
    <div class="flex flex-col justify-end h-full pb-12">
      <div class="max-w-4xl">
        <nav class="flex items-center space-x-2 text-sm sm:text-base mb-6 text-white/80">
          <a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a>
          <span>/</span>
          <a href="{{ route('blog') }}" class="hover:text-white transition-colors">Blog</a>
          <span>/</span>
          <span class="text-white font-medium">{{ $blog->title }}</span>
        </nav>
        
        <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-white text-xs font-medium mb-6">
          Guide Voyage
        </div>
        
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-white">
          {{ $blog->title }}
        </h1>
        
        @if($blog->excerpt)
        <p class="text-xl text-white/90 mb-8 leading-relaxed">
          {{ $blog->excerpt }}
        </p>
        @endif
      </div>
    </div>
  </div>
</section>
@else
<!-- Hero Section without Featured Image -->
<section class="relative bg-gradient-to-br from-primary via-primary-dark to-indigo-900 text-white py-16 sm:py-20 lg:py-32">
  <div class="absolute inset-0 bg-black/20"></div>
  <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
    <div class="max-w-4xl mx-auto text-center">
      <nav class="flex items-center justify-center space-x-2 text-sm sm:text-base mb-6">
        <a href="{{ route('home') }}" class="hover:text-white/80 transition-colors">Accueil</a>
        <span>/</span>
        <a href="{{ route('blog') }}" class="hover:text-white/80 transition-colors">Blog</a>
        <span>/</span>
        <span class="font-medium">{{ $blog->title }}</span>
      </nav>
      
      <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-xs font-medium mb-6">
        Guide Voyage
      </div>
      
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
        {{ $blog->title }}
      </h1>
      
      @if($blog->excerpt)
      <p class="text-xl text-white/90 mb-8 leading-relaxed">
        {{ $blog->excerpt }}
      </p>
      @endif
    </div>
  </div>
</section>
@endif

<!-- Meta Information Bar -->
<section class="bg-white border-b border-slate-200">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-8">
    <div class="flex flex-wrap items-center justify-between gap-4 py-4">
      <div class="flex flex-wrap items-center gap-6 text-sm text-slate-600">
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          {{ $blog->created_at->format('d M Y') }}
        </div>
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min de lecture
        </div>
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          Par l'équipe India Tourisme
        </div>
      </div>
      
      <div class="flex items-center gap-3">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="p-2 rounded-lg bg-slate-100 hover:bg-primary hover:text-white text-slate-600 transition-colors duration-200" title="Partager sur Facebook">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
          </svg>
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="p-2 rounded-lg bg-slate-100 hover:bg-blue-400 hover:text-white text-slate-600 transition-colors duration-200" title="Partager sur Twitter">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path>
          </svg>
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="p-2 rounded-lg bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 transition-colors duration-200" title="Partager sur LinkedIn">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.025H3.555V9h3.564v11.458zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Article Content -->
<section class="py-12 sm:py-16 lg:py-20">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-8">
    <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-8 lg:p-10">
      <div class="prose-custom max-w-none">
        {!! $blog->content !!}
      </div>
      
    </article>
  </div>
</section>

<!-- Related Articles -->
<section class="py-16 sm:py-20 lg:py-32 bg-white">
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
    <div class="text-center mb-12">
      <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">Articles similaires</h2>
      <p class="text-xl text-slate-600">Continuez votre lecture</p>
    </div>
    
    @php
      $relatedBlogs = \App\Models\Blog::where('is_published', true)
        ->where('id', '!=', $blog->id)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    @endphp
    
    @if($relatedBlogs->count() > 0)
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($relatedBlogs as $index => $relatedBlog)
          @php
            $gradients = [
              'from-teal-400 to-cyan-600',
              'from-amber-400 to-orange-600',
              'from-emerald-400 to-green-600',
              'from-indigo-400 to-purple-600',
              'from-rose-400 to-red-500',
              'from-purple-400 to-pink-500'
            ];
            $gradient = $gradients[$index % count($gradients)];
            $blogCategories = ['Guide Voyage', 'Visa Info', 'Budget Guide', 'Culture Guide', 'Conseils', 'Actualités'];
            $category = $blogCategories[$index % count($blogCategories)];
          @endphp
          <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-200">
            <a href="{{ route('blog.show', $relatedBlog->slug) }}">
              <div class="relative overflow-hidden">
                @if($relatedBlog->featured_image)
                  <img src="{{ asset('storage/' . $relatedBlog->featured_image) }}" alt="{{ $relatedBlog->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                  <div class="w-full h-48 bg-gradient-to-br {{ $gradient }} flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                    <span class="text-white text-lg font-bold">{{ $category }}</span>
                  </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
              </div>
            </a>
            <div class="p-6">
              <div class="text-sm text-slate-500 mb-2">{{ $relatedBlog->created_at->format('d M Y') }}</div>
              <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors">
                <a href="{{ route('blog.show', $relatedBlog->slug) }}">{{ $relatedBlog->title }}</a>
              </h3>
              <p class="text-slate-600 mb-4">{{ Str::limit($relatedBlog->excerpt ?? strip_tags($relatedBlog->content), 100) }}</p>
              <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="inline-flex items-center text-primary hover:text-primary-dark font-semibold">
                Lire la suite
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </article>
        @endforeach
      </div>
    @endif
    
    <div class="text-center mt-12">
      <a href="{{ route('blog') }}" class="inline-flex items-center bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200">
        Voir tous les articles
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </a>
    </div>
  </div>
</section>

  </main>

  <!-- Footer Container -->
  <div id="footer-container"></div>

  <!-- Load Common Components -->
  <script src="/components/header.js"></script>
  <script src="/components/footer.js"></script>
  <script>
    // Load components when page loads
    document.addEventListener('DOMContentLoaded', function() {
      loadHeader();
      loadFooter();
    });
  </script>
</body>
</html>
