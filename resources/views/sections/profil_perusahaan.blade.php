<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - Technology Multi System</title>
    <meta name="description" content="Profil perusahaan Technology Multi System - Penyedia solusi teknologi terdepan sejak 2005">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
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
            width: 44px;
            height: 44px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .company-swiper .swiper-button-next:after,
        .company-swiper .swiper-button-prev:after {
            font-size: 18px;
            font-weight: bold;
        }
        
        /* Parallax effect */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Profil <span class="colored-text">Perusahaan</span>
                    </h1>
                </div>

                <!-- Main Content: Slider + Description -->
                <div class="grid lg:grid-cols-2 gap-16 items-center mb-24">
                    <!-- Left Side: Photo Slider -->
                    <div class="relative">
                        <div class="swiper company-swiper rounded-3xl overflow-hidden shadow-2xl">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="aspect-w-4 aspect-h-3 relative">
                                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1926&q=80" 
                                             alt="TMS Office Building" 
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                        <div class="absolute bottom-4 left-4 text-white">
                                            <h3 class="text-xl font-bold">Kantor Pusat TMS</h3>
                                            <p class="text-sm opacity-90">Ciamis, Jawa Barat</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="aspect-w-4 aspect-h-3 relative">
                                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1926&q=80" 
                                             alt="TMS Team Meeting" 
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                        <div class="absolute bottom-4 left-4 text-white">
                                            <h3 class="text-xl font-bold">Tim Profesional</h3>
                                            <p class="text-sm opacity-90">50+ Expert Developer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="aspect-w-4 aspect-h-3 relative">
                                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=1926&q=80" 
                                             alt="TMS Technology" 
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                        <div class="absolute bottom-4 left-4 text-white">
                                            <h3 class="text-xl font-bold">Inovasi Teknologi</h3>
                                            <p class="text-sm opacity-90">Solusi Digital Modern</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="aspect-w-4 aspect-h-3 relative">
                                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=1926&q=80" 
                                             alt="TMS Awards" 
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                        <div class="absolute bottom-4 left-4 text-white">
                                            <h3 class="text-xl font-bold">Penghargaan</h3>
                                            <p class="text-sm opacity-90">Top IT Company 2023</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                    <!-- Right Side: Company Description -->
                    <div class="space-y-8">
                        <div class="space-y-6">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                                Sejarah & <span class="colored-text">Perjalanan</span>
                            </h2>
                            <div class="prose prose-lg text-gray-600 space-y-4">
                                <p class="text-lg leading-relaxed">
                                    Didirikan pada tahun <span class="font-semibold text-blue-600">2005</span>, Technology Multi System (TMS) 
                                    telah berkembang dari sebuah startup teknologi kecil menjadi penyedia solusi digital terdepan di Indonesia.
                                </p>
                                <p class="text-lg leading-relaxed">
                                    Perjalanan kami dimulai dengan visi sederhana: memberikan teknologi yang mudah diakses dan bermanfaat 
                                    bagi semua kalangan. Selama hampir dua dekade, kami telah melayani <span class="font-semibold text-red-500">500+ klien</span> 
                                    dari berbagai sektor.
                                </p>
                                <p class="text-lg leading-relaxed">
                                    Hari ini, dengan tim yang berpengalaman dan teknologi terdepan, kami terus berkomitmen untuk memberikan 
                                    solusi terbaik yang mendorong transformasi digital di Indonesia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Visi & Misi -->
                <div class="grid md:grid-cols-2 gap-8 mb-24">
                    <!-- Visi -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 scroll-animate">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i class="fas fa-award text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Visi</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            Menjadi penyedia solusi teknologi terdepan yang menghadirkan inovasi berkelanjutan untuk 
                            mendukung transformasi digital Indonesia menuju masa depan yang lebih cerdas dan terhubung.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 scroll-animate">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-red-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i class="fas fa-lightbulb text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
                        </div>
                        <ul class="text-gray-600 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3 text-lg"></i>
                                <span>Mengembangkan solusi teknologi yang inovatif dan mudah digunakan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3 text-lg"></i>
                                <span>Memberikan layanan berkualitas tinggi dengan dukungan penuh</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3 text-lg"></i>
                                <span>Membangun kemitraan jangka panjang dengan klien</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-blue-500 mt-1 mr-3 text-lg"></i>
                                <span>Berkontribusi pada kemajuan teknologi di Indonesia</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Nilai-Nilai Perusahaan -->
                <div class="mb-24">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Nilai-Nilai <span class="colored-text">Perusahaan</span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Nilai-nilai fundamental yang menjadi landasan setiap keputusan dan tindakan kami
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Inovasi -->
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-lightbulb text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Inovasi</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Selalu mencari cara baru dan lebih baik untuk memecahkan masalah teknologi
                            </p>
                        </div>

                        <!-- Kualitas -->
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-green-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-award text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Kualitas</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Berkomitmen memberikan produk dan layanan dengan standar kualitas tertinggi
                            </p>
                        </div>

                        <!-- Integritas -->
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-purple-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-handshake text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Integritas</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Membangun kepercayaan melalui transparansi dan kejujuran dalam setiap interaksi
                            </p>
                        </div>

                        <!-- Kolaborasi -->
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Kolaborasi</h4>
                            <p class="text-gray-600 leading-relaxed">
                                Bekerja sama dengan klien dan mitra untuk mencapai tujuan bersama
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistik Perusahaan -->
                <div class="text-center mb-24">
                    <div class="mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Pencapaian Kami</h2>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            Angka-angka yang menunjukkan dedikasi dan komitmen kami dalam memberikan layanan terbaik
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-calendar-alt text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="19">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Tahun</div>
                            <div class="text-sm text-gray-600">Pengalaman</div>
                        </div>
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-handshake text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="500">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Klien</div>
                            <div class="text-sm text-gray-600">Dilayani</div>
                        </div>
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-cube text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="6">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Produk</div>
                            <div class="text-sm text-gray-600">Unggulan</div>
                        </div>
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-users text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="50">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Tim</div>
                            <div class="text-sm text-gray-600">Profesional</div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikasi & Penghargaan -->
                <div class="mb-24">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                            Sertifikasi & <span class="colored-text">Penghargaan</span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            Pengakuan atas komitmen kami terhadap kualitas dan inovasi dalam industri teknologi
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-yellow-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-certificate text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">ISO 9001:2015</h4>
                            <p class="text-gray-600 leading-relaxed">Sertifikasi manajemen kualitas internasional untuk standar operasional terbaik</p>
                        </div>

                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-shield-alt text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">ISO 27001</h4>
                            <p class="text-gray-600 leading-relaxed">Sertifikasi keamanan informasi untuk perlindungan data optimal</p>
                        </div>

                        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 text-center hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 scroll-animate">
                            <div class="w-20 h-20 bg-green-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <i class="fas fa-trophy text-white text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-4">Top IT Company</h4>
                            <p class="text-gray-600 leading-relaxed">Penghargaan perusahaan IT terbaik tahun 2023 dari Indonesia Tech Awards</p>
                        </div>
                    </div>
                </div>
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