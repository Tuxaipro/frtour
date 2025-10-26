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
  </style>
</head>
<body class="bg-white text-slate-900 font-sans antialiased">
  <!-- Header Container -->
  <div id="header-container"></div>

  <main>
<!-- Article Header -->
<section class="py-16 sm:py-20 lg:py-32">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16">
    <div class="text-center mb-8">
      <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary/10 border border-primary/20 text-primary font-medium text-sm mb-6">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"></path>
        </svg>
        Guide Voyage
      </div>
      
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight mb-6">
        {{ $blog->title }}
      </h1>
      
      @if($blog->excerpt)
        <p class="text-xl text-slate-600 mb-8 leading-relaxed">
          {{ $blog->excerpt }}
        </p>
      @endif
      
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-slate-500">
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          {{ $blog->created_at->format('d M Y') }}
        </div>
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min de lecture
        </div>
        <div class="flex items-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          Par l'équipe India Tourisme
        </div>
      </div>
    </div>
    
    <!-- Featured Image -->
    @if($blog->featured_image)
      <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-12">
        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-64 sm:h-80 lg:h-96 object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
      </div>
    @endif
  </div>
</section>

<!-- Article Content -->
<section class="pb-16 sm:pb-20 lg:pb-32">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16">
    <div class="prose prose-lg prose-slate max-w-none">
      {!! $blog->content !!}

      <!-- Call to Action -->
      <div class="bg-gradient-to-r from-primary to-blue-600 rounded-2xl p-8 text-center text-white mb-12">
        <h3 class="text-2xl font-bold mb-4">Besoin d'aide pour planifier votre voyage ?</h3>
        <p class="text-lg mb-6 opacity-90">Nos experts vous conseillent gratuitement sur les meilleures périodes selon votre itinéraire.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="https://calendly.com/votre-calendly/rdv-15min" class="bg-white/20 text-white border border-white/30 px-8 py-3 rounded-xl font-semibold hover:bg-white/30 transition-all duration-200">
            RDV visio 15 min
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Related Articles -->
<section class="py-16 sm:py-20 lg:py-32 bg-slate-50">
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
            <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="block">
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
              <div class="p-6">
                <div class="text-sm text-slate-500 mb-2">{{ $relatedBlog->created_at->format('d M Y') }}</div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-200">{{ $relatedBlog->title }}</h3>
                <p class="text-slate-600">{{ Str::limit($relatedBlog->excerpt ?? strip_tags($relatedBlog->content), 100) }}</p>
              </div>
            </a>
          </article>
        @endforeach
      </div>
    @endif
    
    <div class="text-center mt-12">
      <a href="{{ route('blog') }}" class="inline-flex items-center bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-semibold transition-all duration-200">
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