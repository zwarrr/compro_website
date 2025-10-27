<style>
    /* ============================================
   FITUR SECTION - Dedicated Styles
   ============================================ */

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .fitur-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .fitur-card:hover {
        transform: translateY(-8px) scale(1.02);
    }

    .fitur-icon {
        transition: all 0.4s ease;
    }

    .fitur-card:hover .fitur-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .fitur-card.active {
        animation: slideInUp 0.6s ease-out;
    }

    @media (max-width: 768px) {
        .fitur-card {
            margin-bottom: 1.5rem;
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    }
</style>

<!-- Fitur Section -->
<section id="fitur" class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <div
                class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 px-4 py-2 rounded-full text-sm font-medium mb-4">
                <i class="fas fa-star"></i>
                FEATURES
            </div>
            @if (isset($features) && $features)
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    {{ $features->judul }}
                </h2>
                <p class="text-lg md:text-xl max-w-2xl text-gray-600 mx-auto md:mx-0 leading-relaxed">
                    {{ $features->sub_judul }}
                </p>
            @else
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    Mengapa harus memilih kami?
                </h2>
            @endif
        </div>

        <!-- New Layout: Left Illustration + Right Features -->
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left Side: Illustration -->
            <div class="relative scroll-reveal">
                <!-- Main illustration with floating animation -->
                <div class="text-center">
                    <img src="{{ asset(isset($features) && $features ? 'storage/' . $features->ilustrasi->image : 'img/featurs_default.svg') }}"
                        alt="TMS Features Illustration"
                        class="w-full max-w-3xl mx-auto h-auto object-contain rounded-2xl animate-float">
                </div>
            </div>

            <!-- Right Side: Features List -->
            <div class="space-y-8">
                <!-- Features Grid (2 columns) -->

                <div class="grid sm:grid-cols-2 gap-6">
                    @if (isset($fiturs) && count($fiturs) > 0)
                        @foreach ($fiturs as $fitur)
                            @if ($fitur->status === 'public')
                                <div class="flex items-start gap-4 group">
                                    <div
                                        class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                            {{ $fitur->judul }}
                                        </h3>
                                        @if (!empty($fitur->sub_judul))
                                            <p class="text-gray-600 text-sm leading-relaxed">
                                                {{ $fitur->sub_judul }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($fiturs->where('status', 'public')->count() == 0)
                            <div class="col-span-2 text-center text-gray-500 py-8">
                                <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                Tidak ada fitur yang tersedia.
                            </div>
                        @endif
                    @else
                        <!-- Features Grid (2 columns) -->
                        <!-- Feature 1 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Aksesnya mudah
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Platform mudah digunakan oleh semua kalangan dengan interface yang intuitif.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Fitur Lengkap
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Dukungan pulsa, pembayaran, voucher, dan layanan bisnis dalam satu platform.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Komunitas Besar
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Ribuan pengguna aktif dan partner bisnis yang saling mendukung.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 4 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Aman & Terpercaya
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Keamanan berlapis dan enkripsi untuk melindungi setiap transaksi.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 5 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Cocok untuk semua kalangan
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Mendukung individu, UMKM, dan enterprise dengan solusi terbaik.
                                </p>
                            </div>
                        </div>

                        <!-- Feature 6 -->
                        <div class="flex items-start gap-4 group">
                            <div
                                class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-colors duration-300 group-hover:bg-red-500">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-900 mb-1">
                                    Terjangkau
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Biaya layanan kompetitif untuk berbagai kebutuhan bisnis Anda.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    /* ============================================
   FITUR SECTION - JavaScript
   ============================================ */
    (function() {
        const initFiturSection = () => {
            console.log('🚀 Initializing Fitur Section...');

            // Animate features on scroll
            const featureItems = document.querySelectorAll('.flex.items-start.gap-4.group');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            // Set initial state and observe
            featureItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'all 0.6s ease-out';
                observer.observe(item);
            });

            // Animate illustration elements
            const illustrationElements = document.querySelectorAll(
                '.animate-bounce, .animate-pulse, .animate-ping');
            illustrationElements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.animationDelay = `${index * 0.2}s`;
                }, 500);
            });

            console.log('✅ Fitur Section initialized');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFiturSection);
        } else {
            initFiturSection();
        }
    })();
</script>
