<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - Technology Multi System</title>
    <meta name="description" content="{{ $profile->deskripsi ?? 'Profil perusahaan Technology Multi System' }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#FD0103',
                        secondary: '#0066CC',
                    }
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(59, 130, 246, 0.1) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .colored-text {
            color: #FD0103;
        }

        /* Scroll animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Swiper customization */
        .company-swiper {
            background: #ffffff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .company-swiper .swiper-wrapper {
            background: #ffffff;
        }

        .company-swiper .swiper-pagination-bullet {
            background: #FD0103;
            opacity: 0.3;
        }

        .company-swiper .swiper-pagination-bullet-active {
            opacity: 1;
            background: #FD0103;
        }

        .company-swiper .swiper-button-next,
        .company-swiper .swiper-button-prev {
            color: #FD0103;
            background: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 640px) {
            .company-swiper .swiper-button-next,
            .company-swiper .swiper-button-prev {
                width: 36px;
                height: 36px;
            }

            .company-swiper .swiper-button-next:after,
            .company-swiper .swiper-button-prev:after {
                font-size: 14px;
            }
        }

        .company-swiper .swiper-button-next:after,
        .company-swiper .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }

        /* Parallax effect */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Image Container - Desktop Fixed Height */
        .swiper-image-container {
            aspect-ratio: 4/3;
            width: 100%;
            background: #f3f4f6;
        }

        @media (min-width: 1024px) {
            .swiper-image-container {
                aspect-ratio: unset !important;
                height: 380px !important;
                width: 100% !important;
                background: #ffffff !important;
            }
        }

        /* Scroll to top button */
        .scroll-to-top {
            position: fixed;
            bottom: 8px;
            left: 8px;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #FD0103, #ff0000ff);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 40;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .scroll-to-top:hover {
            background: linear-gradient(135deg, #B80000, #ff0000ff);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Include Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        <!-- Hero Section dengan Slider dan Deskripsi -->
        <section class="relative bg-gray-50 min-h-screen pt-24 pb-16">
            <div class="absolute inset-0 bg-pattern opacity-20"></div>
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-8 sm:mb-12">
                    <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-3 sm:mb-4">
                        {{ $profile->nama_perusahaan ?? 'Profil Perusahaan' }}
                    </h1>
                    @if($profile->slogan)
                    <p class="text-lg sm:text-xl md:text-3xl font-semibold colored-text">
                        {{ $profile->slogan }}
                    </p>
                    @endif
                </div>

                <!-- Main Content: Slider + Description -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center mb-24">
                    <!-- Left Side: Photo Slider Dinamis -->
                    <div class="relative w-full">
                        <div class="swiper company-swiper rounded-3xl overflow-hidden shadow-2xl">
                            <div class="swiper-wrapper">
                                @forelse ($galeri as $item)
                                    <div class="swiper-slide">
                                        <div class="relative swiper-image-container">
                                            @php
                                                // Cek apakah gambar sudah memiliki path folder atau belum
                                                $gambarPath = $item->gambar;
                                                if ($gambarPath && !str_contains($gambarPath, '/')) {
                                                    // Jika hanya nama file, tambahkan folder galeri/
                                                    $gambarPath = 'galeri/' . $gambarPath;
                                                }
                                                $imagePath = $gambarPath ? asset('storage/' . $gambarPath) : asset('img/logo_tms.png');
                                            @endphp
                                            <img src="{{ $imagePath }}" 
                                                 alt="{{ $item->judul }}"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='{{ asset('img/logo_tms.png') }}'">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent">
                                            </div>
                                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 text-white">
                                                <h3 class="text-base sm:text-lg md:text-xl font-bold line-clamp-1">{{ $item->judul }}</h3>
                                                <p class="text-xs sm:text-sm opacity-90 line-clamp-1">{{ $item->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="swiper-slide">
                                        <div class="relative swiper-image-container">
                                            <img src="https://placehold.co/400x300?text=no-image" 
                                                 alt="Default Image"
                                                 class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent">
                                            </div>
                                            <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4 text-white">
                                                <h3 class="text-base sm:text-lg md:text-xl font-bold">Galeri Perusahaan</h3>
                                                <p class="text-xs sm:text-sm opacity-90">Belum ada foto tersedia</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                    <!-- Right Side: Company Description -->
                    <div class="space-y-6 sm:space-y-8">
                        <div class="space-y-4 sm:space-y-6">
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">
                                Sejarah & <span class="colored-text">Perjalanan</span>
                            </h2>
                            <div class="prose prose-sm sm:prose-base lg:prose-lg text-gray-600 space-y-3 sm:space-y-4 max-w-none">
                                <p class="text-base sm:text-lg leading-relaxed">
                                    {{ $profile->deskripsi ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Visi & Misi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-16 sm:mb-24">
                    <!-- Visi -->
                    <div
                        class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 scroll-animate">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div
                                class="w-12 sm:w-14 h-12 sm:h-14 bg-blue-500 rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg flex-shrink-0">
                                <i class="fas fa-award text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Visi</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg">
                            {{ $profile->visi ?? '-' }}
                        </p>
                    </div>

                    <!-- Misi -->
                    <div
                        class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 scroll-animate">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div
                                class="w-12 sm:w-14 h-12 sm:h-14 bg-red-500 rounded-2xl flex items-center justify-center mr-3 sm:mr-4 shadow-lg flex-shrink-0">
                                <i class="fas fa-lightbulb text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Misi</h3>
                        </div>
                        @php
                            $misiList = isset($profile->misi) ? preg_split('/\r?\n|;/', $profile->misi) : [];
                        @endphp
                        @if (count($misiList) > 1)
                            <ul class="text-gray-600 space-y-2 sm:space-y-3">
                                @foreach ($misiList as $misi)
                                    @if (trim($misi) !== '')
                                        <li class="flex items-start text-sm sm:text-base">
                                            <i class="fas fa-check-circle text-blue-500 mt-1 mr-2 sm:mr-3 text-base sm:text-lg flex-shrink-0"></i>
                                            <span>{{ $misi }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base md:text-lg">
                                {{ $profile->misi ?? '-' }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Nilai-Nilai Perusahaan -->
                <div class="mb-16 sm:mb-24">
                    <div class="text-center mb-10 sm:mb-16">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">
                            Nilai-Nilai <span class="colored-text">Perusahaan</span>
                        </h2>
                        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                            Nilai-nilai fundamental yang menjadi landasan setiap keputusan dan tindakan kami
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                        <!-- Inovasi -->
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-lightbulb text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Inovasi</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                                Selalu mencari cara baru dan lebih baik untuk memecahkan masalah teknologi
                            </p>
                        </div>

                        <!-- Kualitas -->
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-green-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-award text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Kualitas</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                                Berkomitmen memberikan produk dan layanan dengan standar kualitas tertinggi
                            </p>
                        </div>

                        <!-- Integritas -->
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-purple-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-handshake text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Integritas</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                                Membangun kepercayaan melalui transparansi dan kejujuran dalam setiap interaksi
                            </p>
                        </div>

                        <!-- Kolaborasi -->
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-red-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-users text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Kolaborasi</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                                Bekerja sama dengan klien dan mitra untuk mencapai tujuan bersama
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistik Perusahaan -->
                <div class="text-center mb-16 sm:mb-24">
                    <div class="mb-10 sm:mb-16">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">Pencapaian Kami</h2>
                        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed px-4">
                            Angka-angka yang menunjukkan dedikasi dan komitmen kami dalam memberikan layanan terbaik
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-3 sm:mb-4">
                                <i class="fas fa-calendar-alt text-gray-800 text-3xl sm:text-4xl"></i>
                            </div>
                            <div class="text-3xl sm:text-5xl font-bold text-gray-500 mb-2 sm:mb-4" data-count="19">0</div>
                            <div class="text-base sm:text-lg text-gray-900 font-semibold mb-1">Tahun</div>
                            <div class="text-xs sm:text-sm text-gray-600">Pengalaman</div>
                        </div>
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-3 sm:mb-4">
                                <i class="fas fa-handshake text-gray-800 text-3xl sm:text-4xl"></i>
                            </div>
                            <div class="text-3xl sm:text-5xl font-bold text-gray-500 mb-2 sm:mb-4" data-count="500">0</div>
                            <div class="text-base sm:text-lg text-gray-900 font-semibold mb-1">Klien</div>
                            <div class="text-xs sm:text-sm text-gray-600">Dilayani</div>
                        </div>
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-3 sm:mb-4">
                                <i class="fas fa-cube text-gray-800 text-3xl sm:text-4xl"></i>
                            </div>
                            <div class="text-3xl sm:text-5xl font-bold text-gray-500 mb-2 sm:mb-4" data-count="6">0</div>
                            <div class="text-base sm:text-lg text-gray-900 font-semibold mb-1">Produk</div>
                            <div class="text-xs sm:text-sm text-gray-600">Unggulan</div>
                        </div>
                        <div
                            class="text-center p-6 sm:p-8 bg-white rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-3 sm:mb-4">
                                <i class="fas fa-users text-gray-800 text-3xl sm:text-4xl"></i>
                            </div>
                            <div class="text-3xl sm:text-5xl font-bold text-gray-500 mb-2 sm:mb-4" data-count="50">0</div>
                            <div class="text-base sm:text-lg text-gray-900 font-semibold mb-1">Tim</div>
                            <div class="text-xs sm:text-sm text-gray-600">Profesional</div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikasi & Penghargaan -->
                <div class="mb-16 sm:mb-24">
                    <div class="text-center mb-10 sm:mb-16">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">
                            Sertifikasi & <span class="colored-text">Penghargaan</span>
                        </h2>
                        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
                            Pengakuan atas komitmen kami terhadap kualitas dan inovasi dalam industri teknologi
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                        <div
                            class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-yellow-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-certificate text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">ISO 9001:2015</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Sertifikasi manajemen kualitas internasional untuk standar operasional terbaik</p>
                        </div>

                        <div
                            class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-shield-alt text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">ISO 27001</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Sertifikasi keamanan informasi untuk perlindungan data optimal</p>
                        </div>

                        <div
                            class="bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div
                                class="w-16 sm:w-20 h-16 sm:h-20 bg-green-500 rounded-3xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <i class="fas fa-trophy text-white text-xl sm:text-2xl"></i>
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Top IT Company</h4>
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">Penghargaan perusahaan IT terbaik tahun 2023 dari Indonesia Tech Awards</p>
                        </div>
                    </div>
                </div>

                <!-- Struktur Organisasi Section -->
                @include('sections.struktur', [
                    'generalManager' => $generalManager,
                    'marketings' => $marketings,
                    'sdms' => $sdms,
                    'accountings' => $accountings,
                    'supports' => $supports,
                    'umbs' => $umbs,
                ])
            </div>
        </section>
    </main>

    <!-- Include Footer -->
    @include('partials.footer')

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Scripts -->
    <script>
        // Initialize Swiper
        const swiper = new Swiper('.company-swiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 1000,
        });

        // Counter Animation
        const counters = document.querySelectorAll('[data-count]');
        const startCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-count'));
            const increment = target / 50;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 40);
        };

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Scroll animations
                    if (entry.target.classList.contains('scroll-animate')) {
                        entry.target.classList.add('active');
                    }

                    // Counter animations
                    const counter = entry.target.querySelector('[data-count]');
                    if (counter && !counter.classList.contains('counted')) {
                        counter.classList.add('counted');
                        startCounter(counter);
                    }
                }
            });
        }, observerOptions);

        // Observe elements
        document.addEventListener('DOMContentLoaded', () => {
            // Observe scroll animations
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });

            // Observe counter section
            const counterSection = document.querySelector('[data-count]')?.closest('.text-center');
            if (counterSection) {
                observer.observe(counterSection);
            }

            // Scroll to Top Button
            const scrollTopBtn = document.createElement('button');
            scrollTopBtn.className = 'scroll-to-top';
            scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            scrollTopBtn.setAttribute('aria-label', 'Scroll to top');
            document.body.appendChild(scrollTopBtn);

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollTopBtn.classList.add('show');
                } else {
                    scrollTopBtn.classList.remove('show');
                }
            });

            scrollTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });

        // Back to top functionality (legacy - akan dihapus)
        const backToTopBtn = document.getElementById('backToTop');

        if (backToTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                    backToTopBtn.classList.remove('opacity-100', 'visible');
                }
            });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Smooth page transitions
        window.addEventListener('beforeunload', () => {
            document.body.style.opacity = '0';
        });

        window.addEventListener('load', () => {
            document.body.style.opacity = '1';
            document.body.style.transition = 'opacity 0.3s ease-in-out';
        });
    </script>
</body>

</html>
