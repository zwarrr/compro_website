<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Perusahaan - Technology Multi System</title>
    <meta name="description" content="Galeri dokumentasi perjalanan dan pencapaian Technology Multi System">

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
                    },
                    keyframes: {
                        modalSlideIn: {
                            'from': {
                                opacity: '0',
                                transform: 'scale(0.95) translateY(-20px)',
                            },
                            'to': {
                                opacity: '1',
                                transform: 'scale(1) translateY(0)',
                            },
                        },
                    },
                    animation: {
                        modalSlideIn: 'modalSlideIn 0.3s ease-out',
                    },
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
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
    </style>
</head>

<body class="bg-gray-50">
    <!-- Include Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        <section class="relative min-h-screen bg-gray-50 pt-24 pb-16">
            <div class="absolute inset-0 opacity-20 pointer-events-none"
                style="background-image: radial-gradient(circle at 1px 1px, rgba(59, 130, 246, 0.1) 1px, transparent 0); background-size: 40px 40px;">
            </div>
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 opacity-0 translate-y-8 transition-all duration-700 scroll-animate">
                    @if (isset($galeri) && $galeri)
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            Galeri <span class="text-red-600">Perusahaan</span>
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            {{$galeri->deskripsi}}
                        </p>
                    @else
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            Galeri <span class="text-red-600">Perusahaan</span>
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Dokumentasi perjalanan, pencapaian, dan momen berkesan dalam pengembangan Technology Multi
                            System
                        </p>
                    @endif
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @forelse($galeris as $galeri)
                        <div class="group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer opacity-0 translate-y-8 transition-all duration-700 scroll-animate hover:-translate-y-3 hover:scale-105"
                            onclick="openDetailModal({
                                'gambar': '{{ asset('storage/galeri/' . $galeri->gambar) }}',
                                'judul': '{{ addslashes($galeri->judul) }}',
                                'deskripsi': '{{ addslashes($galeri->deskripsi) }}',
                                'kategori': '{{ addslashes($galeri->kategori?->nama_kategori ?? 'Umum') }}',
                                'tanggal': '{{ $galeri->created_at->format('d M Y') }}'
                             })">
                            <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-transparent to-black/85 opacity-0 group-hover:opacity-100 transition-all duration-500">
                            </div>
                            <div
                                class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                                <h4 class="text-xl font-bold mb-2">{{ $galeri->judul }}</h4>
                                <p class="text-sm opacity-90">{{ Str::limit($galeri->deskripsi, 60) }}</p>
                                <div class="flex items-center mt-2">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <span class="text-xs">Klik untuk detail</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">Tidak ada galeri yang tersedia</p>
                        </div>
                    @endforelse
                </div>

                <!-- Statistics Section -->
                <div class="mb-16 opacity-0 translate-y-8 transition-all duration-700 scroll-animate">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-16 text-center">
                        Pencapaian <span class="text-red-600">Kami</span>
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        <div
                            class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-briefcase text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="50">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Proyek</div>
                            <div class="text-sm text-gray-600">Selesai dengan sukses</div>
                        </div>
                        <div
                            class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-handshake text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="30">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Klien</div>
                            <div class="text-sm text-gray-600">Terpuaskan</div>
                        </div>
                        <div
                            class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-calendar-alt text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="19">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Tahun</div>
                            <div class="text-sm text-gray-600">Pengalaman</div>
                        </div>
                        <div
                            class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-users text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="50">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Tim</div>
                            <div class="text-sm text-gray-600">Profesional</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="text-center opacity-0 translate-y-8 transition-all duration-700 scroll-animate">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Ingin Melihat <span class="text-red-600">Portfolio Lengkap?</span>
                    </h3>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                        Jelajahi lebih banyak proyek dan pencapaian yang telah kami raih bersama klien-klien terbaik
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('hubungi-kami') }}"
                            class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 text-lg shadow-lg hover:shadow-xl">
                            <i class="fas fa-phone mr-2"></i>
                            Hubungi Kami
                        </a>
                        <a href="{{ url('/') }}"
                            class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-xl font-semibold hover:bg-gray-50 hover:border-red-300 transition-all duration-300 text-lg">
                            <i class="fas fa-folder mr-2"></i>
                            Lihat Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Include Modal Galeri -->
    @include('partials.modal_galeri')

    <!-- Include Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <script>
        // Scroll animations
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
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

        // Initialize counter animations
        document.addEventListener('DOMContentLoaded', () => {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target.querySelector('[data-count]');
                        if (counter && !counter.classList.contains('counted')) {
                            counter.classList.add('counted');
                            startCounter(counter);
                        }
                    }
                });
            }, {
                threshold: 0.5
            });

            document.querySelectorAll('[data-count]').forEach(counter => {
                const parent = counter.closest('.bg-white');
                if (parent) counterObserver.observe(parent);
            });

            // Scroll to Top Button
            const scrollTopBtn = document.createElement('button');
            scrollTopBtn.className =
                'fixed bottom-2 left-2 w-12 h-12 bg-gradient-to-br from-red-600 to-red-700 text-white rounded-xl flex items-center justify-center opacity-0 invisible translate-y-5 transition-all duration-300 z-40 border-0 shadow-md hover:bg-gradient-to-br hover:from-red-700 hover:to-red-800 hover:-translate-y-1 hover:shadow-xl';
            scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            scrollTopBtn.setAttribute('aria-label', 'Scroll to top');
            document.body.appendChild(scrollTopBtn);

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-5');
                    scrollTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
                } else {
                    scrollTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-5');
                    scrollTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
                }
            });

            scrollTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });

        // Smooth page transitions
        window.addEventListener('beforeunload', () => {
            document.body.classList.add('opacity-0');
        });

        window.addEventListener('load', () => {
            document.body.classList.remove('opacity-0');
            document.body.classList.add('opacity-100', 'transition-opacity', 'duration-300');
        });
    </script>
</body>

</html>
