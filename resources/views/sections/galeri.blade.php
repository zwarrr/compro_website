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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Gallery hover effects */
        .gallery-item {
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .gallery-item:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }
        
        .gallery-overlay {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.85) 100%);
        }
        
        .gallery-text {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        /* Lightbox styles */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .lightbox.active {
            display: flex;
        }
        
        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            animation: slideUp 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .counter:hover {
            transform: translateY(-4px);
        }
        
        .counter-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .counter:hover .counter-icon {
            transform: scale(1.2) rotateY(180deg);
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
        <section class="relative min-h-screen bg-gray-50 pt-24 pb-16">
            <div class="absolute inset-0 bg-pattern opacity-20"></div>
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 scroll-animate">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Galeri <span class="colored-text">Perusahaan</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Dokumentasi perjalanan, pencapaian, dan momen berkesan dalam pengembangan Technology Multi System
                    </p>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    <!-- Image 1 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Kantor TMS" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Kantor Pusat TMS</h4>
                            <p class="text-sm opacity-90">Ciamis, Jawa Barat</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Team Meeting" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Team Meeting</h4>
                            <p class="text-sm opacity-90">Diskusi strategi pengembangan</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image 3 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Development Process" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Proses Development</h4>
                            <p class="text-sm opacity-90">Tim developer sedang bekerja</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image 4 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Client Presentation" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Client Presentation</h4>
                            <p class="text-sm opacity-90">Presentasi solusi kepada klien</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image 5 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Award Ceremony" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Penghargaan</h4>
                            <p class="text-sm opacity-90">Top IT Company 2023</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Image 6 -->
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl cursor-pointer scroll-animate" 
                         onclick="openLightbox('https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80')">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Training Session" 
                             class="w-full h-72 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 gallery-overlay opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        <div class="absolute bottom-6 left-6 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                            <h4 class="text-xl font-bold mb-2">Training Session</h4>
                            <p class="text-sm opacity-90">Pelatihan teknologi terbaru</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-expand-arrows-alt mr-2"></i>
                                <span class="text-xs">Klik untuk memperbesar</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="mb-16 scroll-animate">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-16 text-center">
                        Pencapaian <span class="colored-text">Kami</span>
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-briefcase text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="50">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Proyek</div>
                            <div class="text-sm text-gray-600">Selesai dengan sukses</div>
                        </div>
                        <div class="text-center p-8 bg-white rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                            <div class="mb-4">
                                <i class="fas fa-handshake text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="30">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Klien</div>
                            <div class="text-sm text-gray-600">Terpuaskan</div>
                        </div>
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
                                <i class="fas fa-users text-gray-800 text-4xl"></i>
                            </div>
                            <div class="text-5xl font-bold text-gray-500 mb-4" data-count="50">0</div>
                            <div class="text-lg text-gray-900 font-semibold mb-1">Tim</div>
                            <div class="text-sm text-gray-600">Profesional</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="text-center scroll-animate">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                        Ingin Melihat <span class="colored-text">Portfolio Lengkap?</span>
                    </h3>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                        Jelajahi lebih banyak proyek dan pencapaian yang telah kami raih bersama klien-klien terbaik
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="#contact" class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 text-lg shadow-lg hover:shadow-xl">
                            <i class="fas fa-phone mr-2"></i>
                            Hubungi Kami
                        </a>
                        <a href="#portfolio" class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-xl font-semibold hover:bg-gray-50 hover:border-red-300 transition-all duration-300 text-lg">
                            <i class="fas fa-folder mr-2"></i>
                            Lihat Portfolio
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 transition-colors duration-300" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightbox-img" src="" alt="Gallery Image" class="rounded-2xl shadow-2xl">
    </div>
    
    <!-- Include Footer -->
    @include('partials.footer')
    
    <!-- Scripts -->
    <script>
        // Lightbox functionality
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imageSrc;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close lightbox with ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLightbox();
            }
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

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            // Observe scroll animations
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
            
            // Observe counter section
            const counterSection = document.querySelector('[data-count]')?.closest('.bg-white');
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