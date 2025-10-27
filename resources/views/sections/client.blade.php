<!-- Pastikan library Swiper@11 di-load -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* ========== STYLING TETAP SAMA, TIDAK DIUBAH SEDIKITPUN ========== */
    .client-card {
        width: 380px;
        height: 450px;
        flex-shrink: 0;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Hover hanya berfungsi ketika card ada di tengah (swiper-center-card) */
    .swiper-center-card {
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .swiper-center-card:hover {
        /* Hapus transform dari card itu sendiri */
    }

    /* Hover effect HANYA pada icon button untuk center card */
    .swiper-center-card .center-card-button:hover {
        background-color: #dc2626 !important;
        transform: scale(1.1);
    }

    /* Hover effect pada shadow icon - hanya untuk center card */
    .swiper-center-card:hover [data-card-shadow] {
        box-shadow: 0 20px 45px -5px rgba(0, 0, 0, 0.2) !important;
    }

    /* Hover effect HANYA pada detail link text untuk center card */
    .swiper-center-card [data-detail-link]:hover {
        color: #dc2626 !important;
    }

    .swiper-center-card [data-detail-link]:hover i {
        transform: translateX(4px);
    }

    /* Side card - tidak ada hover effect */
    .swiper-side-card {
        cursor: not-allowed;
    }

    .swiper-side-card:hover {
        /* No hover effect untuk side cards */
    }

    .client-swiper {
        padding: 30px 0 80px;
        overflow: visible;
        /* Ensure smooth autoplay */
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        width: 100%;
        margin: 0 auto;
    }

    /* Force hardware acceleration for smooth animations */
    .client-swiper .swiper-wrapper {
        transform-style: preserve-3d;
        backface-visibility: hidden;
        will-change: transform;
    }

    .client-swiper .swiper-slide {
        width: 380px;
        height: auto;
        transition: all 0.4s ease;
        z-index: 1;
    }

    /* Center card effect - Card yang berada di tengah dengan styling yang stabil */
    .client-swiper .swiper-slide .swiper-center-card {
        transform: scale(1.05) !important;
        z-index: 10 !important;
        transition: all 0.4s ease !important;
    }

    .client-swiper .swiper-slide .swiper-center-card .bg-white {
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15) !important;
    }

    /* Side cards effect - Card yang berada di samping */
    .client-swiper .swiper-slide .swiper-side-card {
        transform: scale(0.95);
        opacity: 0.8;
        transition: all 0.4s ease;
    }

    /* Default state untuk semua slides - PASTIKAN DESKTOP BERFUNGSI */
    .client-swiper .swiper-slide-active .client-card {
        transform: scale(1.05) !important;
        z-index: 10 !important;
        transition: all 0.4s ease !important;
    }

    .client-swiper .swiper-slide-active .client-card .bg-white {
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.15) !important;
    }

    /* Non-active slides styling - Side cards dengan opacity yang jelas */
    .client-swiper .swiper-slide:not(.swiper-slide-active) .client-card {
        transform: scale(0.9);
        opacity: 0.5;
        /* Opacity lebih rendah untuk efek fade yang jelas */
        transition: all 0.4s ease;
    }

    /* Pastikan hanya 3 slide yang terlihat dengan fade effect di sisi */
    .client-swiper .swiper-slide {
        opacity: 1;
        transition: opacity 0.4s ease, transform 0.4s ease;
    }

    /* Slide yang tidak berada di posisi tengah 3 frame */
    .client-swiper .swiper-slide:not(.swiper-slide-prev):not(.swiper-slide-active):not(.swiper-slide-next) {
        opacity: 0;
        /* Sembunyikan slide di luar frame 3 */
        pointer-events: none;
    }

    /* MOBILE & TABLET - TAMPILKAN SEMUA SLIDE (TIDAK HIDE) */
    @media (max-width: 768px) {
        .client-swiper .swiper-slide:not(.swiper-slide-prev):not(.swiper-slide-active):not(.swiper-slide-next) {
            opacity: 1 !important;
            pointer-events: auto !important;
        }
    }

    /* Responsif slide width - DESKTOP PRIORITAS */

    /* Mobile - 320px ke bawah - UKURAN MINI */
    @media (max-width: 320px) {
        .client-card {
            width: 270px;
            height: 370px;
        }

        .client-swiper .swiper-slide {
            width: 270px !important;
        }

        .client-swiper {
            padding: 15px 0 50px;
        }
    }

    /* Mobile - 321px sampai 480px - UKURAN SMALL */
    @media (min-width: 321px) and (max-width: 480px) {
        .client-card {
            width: 290px;
            height: 390px;
        }

        .client-swiper .swiper-slide {
            width: 290px !important;
        }

        .client-swiper {
            padding: 15px 0 50px;
        }
    }

    /* Tablet - 481px sampai 768px - TAMPILKAN 2 CARDS */
    @media (min-width: 481px) and (max-width: 768px) {
        .client-swiper .swiper-slide {
            width: 320px !important;
        }

        .client-card {
            width: 320px;
            height: 420px;
        }

        .client-swiper {
            padding: 25px 0 70px;
        }
    }

    /* Desktop - 769px ke atas - TAMPILKAN 3 CARDS (TETAP SAMA) */
    @media (min-width: 769px) {
        .client-swiper .swiper-slide {
            width: 380px !important;
        }

        .client-card {
            width: 380px;
            height: 450px;
        }

        /* Pastikan center effect berfungsi di desktop */
        .client-swiper .swiper-slide-active .client-card {
            transform: scale(1.05) !important;
        }

        .client-swiper .swiper-slide .swiper-center-card {
            transform: scale(1.05) !important;
        }
    }

    /* Large Desktop - 1280px ke atas */
    @media (min-width: 1280px) {
        .client-swiper .swiper-slide {
            width: 380px !important;
        }
    }

    /* Compatibility untuk mobile yang sangat kecil */
    @media (max-width: 320px) {
        .client-card {
            width: 280px;
            margin: 0 auto;
        }
    }
</style>

<!-- Layanan Section -->
<section id="client" class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <div
                class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <i class="fas fa-briefcase"></i>
                CLIENT KAMI
            </div>
            @if (isset($client) && $client)
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    {{$client->judul}}
                </h2>
                <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                    {{$client->sub_judul}}
                </p>
            @else
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    Client Unggulan Kami
                </h2>
                <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                    Bergabunglah dengan ribuan perusahaan yang telah merasakan transformasi bisnis bersama solusi
                    teknologi
                    kami
                </p>
            @endif
        </div>

        <!-- Client Swiper Slider -->
        <div class="relative scroll-reveal">
            <!-- Gradient Fade Overlay untuk efek fade di sisi kiri dan kanan - LEBIH TEBAL -->
            <div class="absolute inset-0 z-10 pointer-events-none">
            </div>

            <div class="swiper client-swiper">
                <div class="swiper-wrapper">
                    @forelse($layanans as $index => $layanan)
                        @php
                            $gambarPath = $layanan->gambar
                                ? asset('storage/' . $layanan->gambar)
                                : asset('images/placeholder-layanan.jpg');
                        @endphp
                        <div class="swiper-slide">
                            <div class="client-card group {{ $layanan->link ? 'cursor-pointer' : 'cursor-default' }}"
                                data-client="{{ strtolower(str_replace(' ', '-', $layanan->judul)) }}">
                                <div class="bg-white rounded-3xl shadow-xl transition-all duration-500 overflow-hidden h-full flex flex-col"
                                    data-card-shadow>
                                    <!-- Visual Header with Background Image -->
                                    <div
                                        class="h-40 relative overflow-hidden flex items-center justify-center bg-gray-200">
                                        <!-- Background Image Dinamis -->
                                        @php
                                            $backgroundPath = $layanan->background
                                                ? asset('storage/' . $layanan->background)
                                                : asset('img/mentahan_bg_client.svg');
                                        @endphp
                                        <div class="absolute inset-0">
                                            <img src="{{ $backgroundPath }}" alt="Background {{ $layanan->judul }}"
                                                class="w-full h-full object-cover"
                                                style="object-fit:cover; filter: blur(1.5px);">
                                            <div class="absolute inset-0 bg-black bg-opacity-15"></div>
                                            <!-- Info Teks Ukuran - DINONAKTIFKAN (UNCOMMENT UNTUK MENGAKTIFKAN) -->
                                            {{-- <div class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-[10px] px-2 py-1 rounded-md font-semibold">
                                                {{ $layanan->judul }}
                                            </div> --}}
                                        </div>

                                        <!-- Icon di atas background dengan Glass Effect -->
                                        <div class="relative z-10">
                                            @if ($layanan->gambar)
                                                <img src="{{ $gambarPath }}" alt="{{ $layanan->judul }}"
                                                    class="w-24 h-24 object-cover rounded-[20px] transition-transform duration-500 shadow-lg backdrop-blur-2xl border border-white border-opacity-30 bg-white bg-opacity-20">
                                            @else
                                                <div
                                                    class="w-24 h-24 bg-white bg-opacity-20 rounded-[20px] flex items-center justify-center transition-transform duration-500 shadow-lg backdrop-blur-2xl border border-white border-opacity-30">
                                                    <i class="fas fa-image text-white text-3xl opacity-50"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6 flex-1 flex flex-col">
                                        <!-- Title & Icon -->
                                        <div class="flex items-center justify-between mb-4">
                                            <h3 class="text-lg font-bold text-gray-900 truncate">
                                                {{ strtoupper($layanan->judul) }}</h3>
                                            @if ($layanan->link)
                                                <a href="{{ $layanan->link }}" target="_blank" rel="noopener noreferrer"
                                                    onclick="event.stopPropagation()"
                                                    class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center flex-shrink-0 ml-2 transition-all duration-300 group center-card-button"
                                                    title="Buka Link" data-link-button>
                                                    <i
                                                        class="fas fa-external-link-alt text-white text-sm transition-all duration-300"></i>
                                                </a>
                                            @else
                                                <div
                                                    class="w-10 h-10 bg-gray-900 rounded-xl flex items-center justify-center flex-shrink-0 ml-2 opacity-50 cursor-not-allowed">
                                                    <i class="fas fa-external-link-alt text-white text-sm"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Badge & Stats -->
                                        <div class="flex items-center justify-between mb-6">
                                            <span
                                                class="px-2 py-1.5 bg-red-100 text-red-700 rounded-full text-[10px] font-medium">{{ $layanan->slog ?? 'Layanan' }}</span>
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
                                            @if ($layanan->link)
                                                <a href="{{ $layanan->link }}" target="_blank"
                                                    rel="noopener noreferrer" onclick="event.stopPropagation()"
                                                    class="client-detail-btn flex items-center gap-2 text-black font-semibold text-sm transition-all duration-300 detail-link-button"
                                                    data-detail-link>
                                                    Lihat Detail
                                                    <i
                                                        class="fas fa-arrow-right text-[10px] transition-transform duration-300"></i>
                                                </a>
                                            @else
                                                <button disabled
                                                    class="client-detail-btn flex items-center gap-2 text-gray-400 font-semibold text-sm cursor-not-allowed opacity-50">
                                                    Lihat Detail
                                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="client-card">
                                <div
                                    class="bg-white rounded-3xl shadow-xl overflow-hidden h-full flex items-center justify-center p-6">
                                    <div class="text-center">
                                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-gray-500">Tidak ada client yang tersedia</p>
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
    (function() {
        'use strict';

        const initClientSwiper = () => {
            const container = document.querySelector('.client-swiper');
            if (!container) return;

            // Sembunyikan container untuk prevent flicker
            container.style.opacity = '0';
            container.style.transition = 'opacity 0.4s ease-out';

            const totalSlides = document.querySelectorAll('.client-swiper .swiper-slide').length;
            const centerIndex = Math.floor(totalSlides / 2); // Index tengah

            const swiper = new Swiper('.client-swiper', {
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
                        spaceBetween: 10,
                        centeredSlides: true
                    },
                    481: {
                        slidesPerView: 2,
                        spaceBetween: 15,
                        centeredSlides: true
                    },
                    769: {
                        slidesPerView: 3,
                        spaceBetween: 30,
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
                    const card = slide.querySelector('.client-card');
                    if (!card) return;

                    // Reset all classes
                    card.classList.remove('swiper-center-card', 'swiper-side-card');
                    slide.style.zIndex = '1';

                    // Apply appropriate class based on position
                    if (index === activeIndex) {
                        card.classList.add('swiper-center-card');
                        slide.style.zIndex = '5';

                        // Enable button untuk center card
                        const linkButton = card.querySelector('[data-link-button]');
                        if (linkButton) {
                            linkButton.style.pointerEvents = 'auto';
                            linkButton.style.opacity = '1';
                            linkButton.style.cursor = 'pointer';
                        }

                        // Enable detail link untuk center card
                        const detailLink = card.querySelector('[data-detail-link]');
                        if (detailLink) {
                            detailLink.style.pointerEvents = 'auto';
                            detailLink.style.opacity = '1';
                            detailLink.style.cursor = 'pointer';
                        }
                    } else {
                        card.classList.add('swiper-side-card');
                        slide.style.zIndex = '1';

                        // Disable button untuk side card
                        const linkButton = card.querySelector('[data-link-button]');
                        if (linkButton) {
                            linkButton.style.pointerEvents = 'none';
                            linkButton.style.opacity = '0.5';
                            linkButton.style.cursor = 'not-allowed';
                        }

                        // Disable detail link untuk side card
                        const detailLink = card.querySelector('[data-detail-link]');
                        if (detailLink) {
                            detailLink.style.pointerEvents = 'none';
                            detailLink.style.opacity = '0.5';
                            detailLink.style.cursor = 'not-allowed';
                        }
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
                    initClientSwiper();
                }, 100);
            });
        } else {
            setTimeout(() => {
                initClientSwiper();
            }, 100);
        }
    })();
</script>
