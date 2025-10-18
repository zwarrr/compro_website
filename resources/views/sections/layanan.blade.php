<!-- Pastikan library Swiper@11 di-load -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
/* ========== STYLING TETAP SAMA, TIDAK DIUBAH SEDIKITPUN ========== */
.layanan-card {
  width: 380px;
  height: 450px;
  flex-shrink: 0;
  transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.layanan-card:hover {
  transform: translateY(-12px) scale(1.02);
}

.layanan-swiper {
  padding: 30px 0 80px;
  overflow: visible;
  /* Ensure smooth autoplay */
  user-select: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
}

/* Force hardware acceleration for smooth animations */
.layanan-swiper .swiper-wrapper {
  transform-style: preserve-3d;
  backface-visibility: hidden;
  will-change: transform;
}

.layanan-swiper .swiper-slide {
  width: 380px;
  height: auto;
  transition: all 0.4s ease;
  z-index: 1;
}

/* Center card effect - Card yang berada di tengah dengan styling yang stabil */
.layanan-swiper .swiper-slide .swiper-center-card {
  transform: scale(1.05) !important;
  z-index: 10 !important;
  transition: all 0.4s ease !important;
}

.layanan-swiper .swiper-slide .swiper-center-card .bg-white {
  box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15) !important;
}

/* Side cards effect - Card yang berada di samping */
.layanan-swiper .swiper-slide .swiper-side-card {
  transform: scale(0.95);
  opacity: 0.8;
  transition: all 0.4s ease;
}

/* Default state untuk semua slides - PASTIKAN DESKTOP BERFUNGSI */
.layanan-swiper .swiper-slide-active .layanan-card {
  transform: scale(1.05) !important;
  z-index: 10 !important;
  transition: all 0.4s ease !important;
}

.layanan-swiper .swiper-slide-active .layanan-card .bg-white {
  box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15) !important;
}

/* Non-active slides styling - Side cards dengan opacity yang jelas */
.layanan-swiper .swiper-slide:not(.swiper-slide-active) .layanan-card {
  transform: scale(0.9);
  opacity: 0.5; /* Opacity lebih rendah untuk efek fade yang jelas */
  transition: all 0.4s ease;
}

/* Pastikan hanya 3 slide yang terlihat dengan fade effect di sisi */
.layanan-swiper .swiper-slide {
  opacity: 1;
  transition: opacity 0.4s ease, transform 0.4s ease;
}

/* Slide yang tidak berada di posisi tengah 3 frame */
.layanan-swiper .swiper-slide:not(.swiper-slide-prev):not(.swiper-slide-active):not(.swiper-slide-next) {
  opacity: 0; /* Sembunyikan slide di luar frame 3 */
  pointer-events: none;
}

/* Responsif slide width - DESKTOP PRIORITAS */

/* Mobile - 480px ke bawah */
@media (max-width: 480px) {
  .layanan-swiper .swiper-slide {
    width: 300px !important;
  }
  
  .layanan-card {
    width: 300px;
  }
  
  /* Gradient overlay mobile */
  .absolute.left-0 {
    width: 15px !important;
  }
  
  .absolute.right-0 {
    width: 15px !important;
  }
}

/* Tablet - 481px sampai 768px */
@media (min-width: 481px) and (max-width: 768px) {
  .layanan-swiper .swiper-slide {
    width: 340px !important;
  }
  
  /* Gradient overlay tablet */
  .absolute.left-0 {
    width: 20px !important;
  }
  
  .absolute.right-0 {
    width: 20px !important;
  }
}

/* Desktop - 769px ke atas - FOKUS UTAMA */
@media (min-width: 769px) {
  .layanan-swiper .swiper-slide {
    width: 380px !important;
  }
  
  .layanan-card {
    width: 380px;
  }
  
  /* Pastikan center effect berfungsi di desktop */
  .layanan-swiper .swiper-slide-active .layanan-card {
    transform: scale(1.05) !important;
  }
  
  .layanan-swiper .swiper-slide .swiper-center-card {
    transform: scale(1.05) !important;
  }
  
  /* Gradient overlay desktop */
  .absolute.left-0 {
    width: 32px !important;
  }
  
  .absolute.right-0 {
    width: 32px !important;
  }
}

/* Large Desktop - 1280px ke atas */
@media (min-width: 1280px) {
  .layanan-swiper .swiper-slide {
    width: 380px !important;
  }
}

/* Compatibility untuk mobile yang sangat kecil */
@media (max-width: 320px) {
  .layanan-card {
    width: 280px;
    margin: 0 auto;
  }
}
</style>

<!-- Layanan Section -->
<section id="layanan" class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>
  
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-16">
      <div class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
        <i class="fas fa-briefcase"></i>
        LAYANAN KAMI
      </div>
      <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                Layanan Unggulan Kami
            </h2>
      <p class="text-gray-600 text-xl max-w-3xl mx-auto">
        Bergabunglah dengan ribuan perusahaan yang telah merasakan transformasi bisnis bersama solusi teknologi kami
      </p>
    </div>

    <!-- Layanan Swiper Slider -->
    <div class="relative">
        <!-- Gradient Fade Overlay untuk efek fade di sisi kiri dan kanan - LEBIH TEBAL -->
        <div class="absolute inset-0 z-10 pointer-events-none">
        </div>
        
        <div class="swiper layanan-swiper">
            <div class="swiper-wrapper">
                @php
                    $gradients = [
                        'from-rose-500 to-pink-600',
                        'from-blue-500 to-indigo-600',
                        'from-green-500 to-emerald-600',
                        'from-purple-500 to-indigo-600',
                        'from-pink-500 to-rose-600',
                        'from-orange-500 to-red-600'
                    ];
                    $icons = [
                        'fa-handshake',
                        'fa-cash-register',
                        'fa-credit-card',
                        'fa-mobile-alt',
                        'fa-piggy-bank',
                        'fa-city'
                    ];
                    $colorSchemes = [
                        ['bg' => 'rose', 'text' => 'rose'],
                        ['bg' => 'blue', 'text' => 'blue'],
                        ['bg' => 'green', 'text' => 'green'],
                        ['bg' => 'purple', 'text' => 'purple'],
                        ['bg' => 'pink', 'text' => 'pink'],
                        ['bg' => 'orange', 'text' => 'orange']
                    ];
                @endphp

                @forelse($layanans as $index => $layanan)
                    @php
                        $gradient = $gradients[$index % count($gradients)];
                        $icon = $icons[$index % count($icons)];
                        $colorScheme = $colorSchemes[$index % count($colorSchemes)];
                    @endphp
                    <div class="swiper-slide">
                        <div class="layanan-card group cursor-pointer" data-layanan="{{ strtolower(str_replace(' ', '-', $layanan->judul)) }}">
                            <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden h-full flex flex-col">
                                <!-- Visual Header with Icon -->
                                <div class="h-40 bg-gradient-to-br {{ $gradient }} relative overflow-hidden p-6 flex items-center justify-center">
                                    <div class="w-20 h-20 bg-white bg-opacity-20 backdrop-blur-md rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                        <i class="fas {{ $icon }} text-white text-3xl"></i>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <!-- Title & Icon -->
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-2xl font-bold text-gray-900">{{ strtoupper($layanan->judul) }}</h3>
                                        <div class="w-10 h-10 bg-{{ $colorScheme['bg'] }}-50 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-external-link-alt text-{{ $colorScheme['text'] }}-600 text-sm"></i>
                                        </div>
                                    </div>
                                    
                                    <!-- Badge & Stats -->
                                    <div class="flex items-center justify-between mb-6">
                                        <span class="px-2 py-1.5 bg-{{ $colorScheme['bg'] }}-100 text-{{ $colorScheme['text'] }}-700 rounded-full text-[10px] font-medium">{{ $layanan->slog ?? 'Layanan' }}</span>
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <i class="fas fa-users text-sm"></i>
                                            <span class="text-sm font-semibold">100+</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Description -->
                                    <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-1">
                                        {{ $layanan->deskripsi ?? 'Layanan terpercaya untuk mendukung bisnis Anda.' }}
                                    </p>
                                    
                                    <!-- Link Button -->
                                    <div class="flex justify-end">
                                        <button class="client-detail-btn flex items-center gap-2 text-{{ $colorScheme['text'] }}-600 hover:text-{{ $colorScheme['text'] }}-700 font-semibold text-sm transition-all duration-300 group">
                                            Lihat Detail 
                                            <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="layanan-card">
                            <div class="bg-white rounded-3xl shadow-xl overflow-hidden h-full flex items-center justify-center p-6">
                                <div class="text-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500">Tidak ada layanan yang tersedia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
  </div>
</section>

<!-- Stable Auto Center Start -->
<script>
(function () {
  'use strict';
  
  const initLayananSwiper = () => {
    const container = document.querySelector('.layanan-swiper');
    if (!container) return;

    // Sembunyikan container untuk prevent flicker
    container.style.opacity = '0';
    container.style.transition = 'opacity 0.4s ease-out';

    const totalSlides = document.querySelectorAll('.layanan-swiper .swiper-slide').length;
    const centerIndex = Math.floor(totalSlides / 2); // Index tengah

    const swiper = new Swiper('.layanan-swiper', {
      // === CORE CONFIGURATION ===
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      spaceBetween: 30,
      speed: 1000, // Smooth but not too fast
      
      // === INTERACTION ===
      grabCursor: true,
      allowTouchMove: true,
      watchSlidesProgress: true,
      
      // === LOOP OPTIMIZATION ===
      loopedSlides: totalSlides,
      
      // === AUTOPLAY - STABLE INFINITE ===
      autoplay: {
        delay: 2000, // Reasonable delay for smooth experience
        disableOnInteraction: false,
        pauseOnMouseEnter: false,
        reverseDirection: false,
      },
      
      // === RESPONSIVE BREAKPOINTS ===
      breakpoints: {
        320: { 
          slidesPerView: 3, 
          spaceBetween: 15, 
          centeredSlides: true
        },
        480: { 
          slidesPerView: 3, 
          spaceBetween: 20, 
          centeredSlides: true
        },
        768: { 
          slidesPerView: 3, 
          spaceBetween: 25, 
          centeredSlides: true
        },
        1024: { 
          slidesPerView: 3, 
          spaceBetween: 30, 
          centeredSlides: true
        },
        1280: { 
          slidesPerView: 3, 
          spaceBetween: 40, 
          centeredSlides: true
        }
      },

      // === EVENT HANDLERS ===
      on: {
        init() {
          // Set posisi tengah tanpa animasi
          this.slideToLoop(centerIndex, 0, false);
          
          // Update state cards
          updateSlideStates(this);
          
          // Start autoplay dengan delay
          setTimeout(() => {
            this.autoplay.start();
          }, 200);
          
          // Fade in container setelah setup selesai
          setTimeout(() => {
            container.style.opacity = '1';
          }, 300);
        },
        
        slideChange() {
          updateSlideStates(this);
        },
        
        transitionEnd() {
          updateSlideStates(this);
        }
      }
    });

    // === UPDATE CARD STATES FUNCTION ===
    function updateSlideStates(swiperInstance) {
      if (!swiperInstance || !swiperInstance.slides) return;
      
      const slides = swiperInstance.slides;
      const activeIndex = swiperInstance.activeIndex;
      
      slides.forEach((slide, index) => {
        const card = slide.querySelector('.layanan-card');
        if (!card) return;
        
        // Reset all classes
        card.classList.remove('swiper-center-card', 'swiper-side-card');
        slide.style.zIndex = '1';
        
        // Apply appropriate class based on position
        if (index === activeIndex) {
          card.classList.add('swiper-center-card');
          slide.style.zIndex = '5';
        } else {
          card.classList.add('swiper-side-card');
          slide.style.zIndex = '1';
        }
      });
    }

    // === AUTOPLAY GUARDIAN - KEEP IT RUNNING SAFELY ===
    const autoplayGuardian = () => {
      if (swiper && swiper.autoplay && !swiper.destroyed) {
        if (!swiper.autoplay.running && !swiper.autoplay.paused) {
          swiper.autoplay.start();
        }
      }
    };

    // Monitor autoplay every 2 seconds (less frequent to prevent conflicts)
    setInterval(autoplayGuardian, 2000);

    // Handle visibility changes
    document.addEventListener('visibilitychange', () => {
      if (!document.hidden && swiper && swiper.autoplay) {
        setTimeout(() => {
          swiper.autoplay.start();
        }, 100);
      }
    });

    // Handle window focus
    window.addEventListener('focus', () => {
      if (swiper && swiper.autoplay) {
        setTimeout(() => {
          swiper.autoplay.start();
        }, 100);
      }
    });

    return swiper;
  };

  // === INITIALIZATION ===
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        initLayananSwiper();
      }, 100);
    });
  } else {
    setTimeout(() => {
      initLayananSwiper();
    }, 100);
  }
})();
</script>
