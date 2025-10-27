<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog — India Tourisme</title>
  <meta name="description" content="Découvrez nos conseils de voyage, récits d'expériences et actualités de l'Inde, du Sri Lanka, du Népal et du Bhoutan.">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: 'hsl(220, 70%, 25%)',
            'primary-dark': 'hsl(220, 70%, 20%)',
            'primary-light': 'hsl(220, 60%, 35%)',
            accent: 'hsl(75, 45%, 40%)',
            'accent-light': 'hsl(80, 50%, 45%)',
            background: 'hsl(0, 0%, 98%)',
            foreground: 'hsl(215, 25%, 27%)'
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
  </style>
</head>
  <body class="bg-[hsl(0,0%,98%)] text-[hsl(215,25%,27%)] font-sans antialiased">
  <!-- Header Container -->
  <div id="header-container"></div>

  <main>
<!-- Hero Section -->
<section class="relative py-16 sm:py-20 lg:py-32 overflow-hidden" style="background-color: hsl(220, 70%, 25%);"
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%238B5CF6" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        <div class="text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-purple-100 border border-purple-200 text-purple-800 font-medium text-sm mb-8">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
                Blog & Conseils
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Blog Voyages
            </h1>
            <p class="text-xl text-gray-300 mb-8 leading-relaxed">
                Découvrez nos conseils de voyage, récits d'expériences et actualités de l'Inde, du Sri Lanka, du Népal et du Bhoutan.
            </p>
        </div>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-16 sm:py-20 lg:py-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 2xl:px-20">
        @if($blogs->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $index => $blog)
              @php
                $gradients = [
                  'from-purple-400 to-pink-500',
                  'from-teal-400 to-cyan-600', 
                  'from-amber-400 to-orange-600',
                  'from-emerald-400 to-green-600',
                  'from-indigo-400 to-purple-600',
                  'from-rose-400 to-red-500'
                ];
                $gradient = $gradients[$index % count($gradients)];
                $blogCategories = ['Guide Voyage', 'Visa Info', 'Budget Guide', 'Culture Guide', 'Conseils', 'Actualités'];
                $category = $blogCategories[$index % count($blogCategories)];
              @endphp
              <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-slate-200">
                <a href="{{ route('blog.show', $blog->slug) }}" class="block">
                  <div class="relative overflow-hidden">
                    @if($blog->featured_image)
                      <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                      <div class="w-full h-48 bg-gradient-to-br {{ $gradient }} flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <span class="text-white text-lg font-bold">{{ $category }}</span>
                      </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                  </div>
                </a>
                <div class="p-6">
                  <div class="text-sm text-slate-500 mb-2">{{ $blog->created_at->format('d M Y') }}</div>
                  <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-200">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="hover:text-primary transition-colors">{{ $blog->title }}</a>
                  </h3>
                  <p class="text-slate-600 mb-4">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 100) }}</p>
                  <div class="flex flex-col gap-3">
                    <span class="text-sm text-slate-500">{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min de lecture</span>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition-all duration-200 group">
                      Lire l'article
                      <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                      </svg>
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h8"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">Aucun article disponible</h3>
            <p class="mt-1 text-sm text-slate-500">Les articles de blog seront bientôt publiés.</p>
          </div>
        @endif
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