<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog — India Tourisme</title>
  <meta name="description" content="Découvrez nos conseils de voyage, récits d'expériences et actualités de l'Inde, du Sri Lanka, du Népal et du Bhoutan.">
  <!-- Tailwind CSS via Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <style>
    html { scroll-behavior: smooth; }
    
    /* Card Hover Effects */
    .card-hover {
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* Image Zoom Effect */
    .img-zoom {
      overflow: hidden;
    }
    
    .img-zoom img {
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .img-zoom:hover img {
      transform: scale(1.1);
    }
    
    /* Button Shimmer Effect */
    .btn-shimmer {
      position: relative;
      overflow: hidden;
    }
    
    .btn-shimmer::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s;
    }
    
    .btn-shimmer:hover::before {
      left: 100%;
    }
    
    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(135deg, hsl(201, 96%, 32%), hsl(142, 71%, 45%));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    /* Fade In Animation */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    
    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>
  <body class="bg-[hsl(0,0%,98%)] text-[hsl(215,25%,27%)] font-sans antialiased">
  <!-- Navigation -->
  @php
    include resource_path('views/includes/navigation.php');
  @endphp

  <main class="overflow-hidden">
<!-- Hero Section -->
<section class="relative py-20 sm:py-24 lg:py-32 bg-gradient-to-br from-primary via-primary-dark to-accent min-h-[500px] flex items-center justify-center">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto fade-in">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold text-sm mb-8">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Blog & Conseils
            </div>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight">
                Nos derniers <span class="text-white/90">articles</span>
            </h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto font-light leading-relaxed">
                Conseils, récits de voyage et informations pratiques pour préparer votre séjour en Inde, Sri Lanka, Népal et Bhoutan
            </p>
        </div>
    </div>
</section>

<!-- Blog Posts -->
<section class="py-20 sm:py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 fade-in">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold text-slate-900 mb-6">
                Découvrez nos <span class="gradient-text">articles</span>
            </h2>
            <p class="text-xl text-slate-600 max-w-3xl mx-auto font-light">
                Conseils d'experts, guides pratiques et récits de voyage pour préparer votre aventure
            </p>
        </div>

        @if($blogs->count() > 0)
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 fade-in">
            @foreach($blogs as $index => $blog)
              @php
                $gradients = [
                  'from-primary to-accent',
                  'from-accent to-primary', 
                  'from-sunset to-sunset-dark',
                  'from-primary-dark to-primary',
                  'from-accent-dark to-accent',
                  'from-primary to-primary-dark'
                ];
                $gradient = $gradients[$index % count($gradients)];
              @endphp
              <article class="group card-hover bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
                <!-- Image -->
                <div class="relative h-56 overflow-hidden img-zoom">
                  @if($blog->featured_image)
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" loading="lazy">
                  @else
                    <div class="w-full h-full bg-gradient-to-br {{ $gradient }}"></div>
                  @endif
                </div>
                
                <!-- Content -->
                <div class="p-8">
                  <div class="flex items-center gap-3 mb-4 text-sm text-slate-600">
                    <time datetime="{{ $blog->created_at->format('Y-m-d') }}" class="flex items-center">
                      <svg class="w-4 h-4 mr-1 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                      {{ $blog->created_at->format('d M Y') }}
                    </time>
                    <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                    <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min de lecture</span>
                  </div>
                  <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">{{ $blog->title }}</h3>
                  <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                  <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition-colors duration-300">
                    Lire l'article
                    <svg class="w-5 h-5 ml-2 transform transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                  </a>
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
  <script src="/components/footer.js"></script>
  <script>
    // Load components when page loads
    document.addEventListener('DOMContentLoaded', function() {
      loadFooter();
      
      // Fade In On Scroll
      const fadeElements = document.querySelectorAll('.fade-in');
      const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, {
        threshold: 0.1
      });
      
      fadeElements.forEach(el => fadeObserver.observe(el));
    });
  </script>
</body>
</html>