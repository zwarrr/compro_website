<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team - Technology Multi System</title>
    <meta name="description" content="Tim ahli Technology Multi System yang berdedikasi memberikan solusi teknologi terbaik">
    
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
        * {
            box-sizing: border-box;
        }
        
        html {
            overflow-x: hidden;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
        }
        
        html::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            width: 100%;
            max-width: 100vw;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer 10+ */
        }
        
        body::-webkit-scrollbar {
            display: none; /* Safari and Chrome */
        }
        
        /* Hide all scrollbars */
        *::-webkit-scrollbar {
            display: none;
        }
        
        * {
            scrollbar-width: none;
            -ms-overflow-style: none;
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
        
        /* Wave melengkung halus - MEMOTONG FOTO DI BAWAH */
        .custom-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            z-index: 30;
        }
        .custom-wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 75px;
        }
        .custom-wave path {
            fill: #ffffff;
            stroke: none;
        }

        /* Team card hover effects */
        .team-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            position: relative;
            overflow: visible;
            width: 100%;
            max-width: 384px;
            margin: 0 auto;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: none !important;
            outline: none !important;
        }
        
        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.35);
            border: none !important;
            outline: none !important;
        }
        
        .team-card *, .team-card *:hover, .team-card *:focus {
            border: none !important;
            outline: none !important;
        }
        
        .team-card-header {
            position: relative;
            height: 260px;
            background: linear-gradient(135deg, #1f2937, #000000, #374151);
            overflow: visible;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
        }
        
        .team-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("img/team_cards/bg_cards.png") }}') center/cover;
            opacity: 0.3;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
        }
        
        .team-avatar {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            overflow: visible;
        }
        
        .team-card:hover .team-avatar {
            transform: translateX(-50%) scale(1.02);
            transition: all 0.4s ease;
        }
        
        .team-member-photo {
            height: 380px;
            width: auto;
            max-width: none;
            object-fit: contain;
            object-position: top;
            border-radius: 24px;
        }
        
        .team-info-box {
            padding: 0 32px 40px;
            text-align: center;
        }
        
        .name-title {
            font-size: 16px;
            font-weight: 900;
            color: #1e3a8a;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
            line-height: 1.2;
            text-transform: uppercase;
            white-space: nowrap;
        }
        
        .job-title {
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .nik-number {
            color: #9ca3af;
            font-size: 10px;
            font-weight: 500;
            margin-bottom: 24px;
        }
        
        .description-text {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            text-align: center;
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

        /* Container Image Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes float-small {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-3px, 4px); }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
        .animate-float-small {
            animation: float-small 4s ease-in-out infinite;
        }

        @keyframes bounce-gentle {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-4px);
            }
            60% {
                transform: translateY(-2px);
            }
        }

        @keyframes pulse-subtle {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .pulse-subtle {
            animation: pulse-subtle 2s infinite;
        }

        @keyframes label-glow-pulse {
            0%, 100% { 
                transform: scale(1) translateY(0px);
                box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            }
            50% { 
                transform: scale(1.05) translateY(-8px);
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9), 0 0 25px rgba(239, 68, 68, 0.15);
            }
        }

        @keyframes card-shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        @keyframes cardBounce {
            0%, 100% {
                transform: scale(1) translateY(0px);
            }
            50% {
                transform: scale(1.05) translateY(-6px);
            }
        }

        .label-animate {
            animation: label-glow-pulse 3.5s ease-in-out infinite, cardBounce 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .label-shimmer {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: card-shimmer 3s ease infinite;
            pointer-events: none;
        }

        @keyframes card-deep-glow {
            0%, 100% { 
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12), 
                            0 0 30px rgba(59, 130, 246, 0.05),
                            0 0 60px rgba(239, 68, 68, 0.03);
            }
            50% { 
                box-shadow: 0 35px 80px rgba(0, 0, 0, 0.2), 
                            0 0 50px rgba(59, 130, 246, 0.1),
                            0 0 100px rgba(239, 68, 68, 0.08);
            }
        }

        @keyframes layer-depth {
            0%, 100% { filter: brightness(1) saturate(1); }
            50% { filter: brightness(1.1) saturate(1.05); }
        }

        @keyframes container-subtle-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.01); }
        }

        @keyframes glow-soft {
            0%, 100% { box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15); }
            50% { box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2); }
        }

        .soft-shadow {
            animation: card-deep-glow 7s ease-in-out infinite;
        }

        .red-layer {
            transform: rotate(-8deg) translate(-30px, 40px);
            animation: layer-float 6s ease-in-out infinite, layer-depth 8s ease-in-out infinite;
        }
        .blue-layer {
            transform: rotate(8deg) translate(30px, -30px);
            animation: layer-float-blue 7s ease-in-out infinite, layer-depth 9s ease-in-out infinite reverse;
        }

        @keyframes layer-float {
            0%, 100% { transform: rotate(-8deg) translate(-30px, 40px); }
            50% { transform: rotate(-8deg) translate(-30px, 35px); }
        }

        @keyframes layer-float-blue {
            0%, 100% { transform: rotate(8deg) translate(30px, -30px); }
            50% { transform: rotate(8deg) translate(30px, -35px); }
        }

        .soft-shadow {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Include Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main>
        <!-- Section 1: Hero/Header Section -->
        <section class="relative min-h-screen bg-gray-50 pt-24 pb-16 flex items-center justify-center">
            <div class="absolute inset-0 bg-pattern opacity-20"></div>
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <!-- Header Section - Centered -->
                <div class="scroll-animate">
                    <!-- Content Section with Grid Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-7xl mx-auto px-4 overflow-visible">
                        <!-- Left Content -->
                        <div class="text-left">
                            <!-- Title -->
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                                Tim <span class="colored-text">Profesional</span> Kami
                            </h1>
                            
                            <!-- Description -->
                            <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                Bertemu dengan tim ahli yang berdedikasi untuk memberikan solusi teknologi terbaik bagi bisnis Anda. Setiap anggota tim memiliki keahlian khusus dalam bidangnya masing-masing.
                            </p>
                            
                            <!-- Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 mt-8">
                                <a href="#team-cards" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 text-center">
                                    Lihat Tim
                                </a>
                                <a href="#contact" class="border-2 border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 hover:border-red-300 transition-all duration-300 text-center">
                                    Bergabung 
                                </a>
                            </div>
                        </div>
                        
                        <!-- Right Image - TMS Container Layout -->
                        <div class="flex justify-center lg:justify-end items-center overflow-visible">
                            <!-- Container utama -->
                            <div class="relative w-64 md:w-80 lg:w-96 animate-float">

                                <!-- Layer belakang merah -->
                                <div class="absolute inset-0 rounded-2xl red-layer z-0 bg-gradient-to-br from-red-500 to-red-700"></div>

                                <!-- Layer belakang biru -->
                                <div class="absolute inset-0 rounded-2xl blue-layer z-0 bg-gradient-to-br from-blue-500 to-blue-900"></div>

                                <!-- Kartu putih -->
                                <div class="relative bg-white rounded-2xl overflow-hidden soft-shadow z-10">
                                    <div class="w-[full] h-80 md:h-96 lg:h-[420px] flex items-center justify-center bg-white overflow-hidden">
                                        <img src="{{ asset('img/team_cards/full_team.png') }}" 
                                             alt="Tim Kami" 
                                             class="w-[700] h-auto object-contain object-bottom translate-y-10 translate-x-3 scale-[1.15]"
                                             onerror="this.style.display='none'">
                                    </div>
                                </div>

                                <!-- Label melayang di luar kartu -->
                                <div class="absolute top-2 -left-28 bg-white rounded-2xl px-4 py-3 shadow-2xl z-20 border border-gray-100 pulse-subtle" style="box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12)">
                                    <div class="flex items-center gap-2 relative z-10">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-red-600 tracking-wide text-center">Solution For</p>
                                            <p class="text-xs font-bold text-gray-900">Your Technology</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Team Cards Section -->
        <section id="team-cards" class="relative bg-white py-20 overflow-x-hidden">
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-hidden w-full">
                <!-- Team Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16 w-full">
                    @forelse($karyawans as $karyawan)
                    <!-- Team Member Card -->
                    <div class="team-card shadow-xl hover:shadow-2xl scroll-animate" style="margin-top: 120px;">
                        <div class="team-card-header">
                            <img src="{{ asset('img/team_cards/bg_cards.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-30 rounded-t-3xl">
                            
                            <!-- FOTO PROFIL -->
                            <div class="team-avatar">
                                @if($karyawan->foto)
                                    <img src="{{ asset('images/karyawan/' . $karyawan->foto) }}" 
                                         alt="{{ $karyawan->nama }}" 
                                         class="team-member-photo"
                                         onerror="this.style.display='none'">
                                @else
                                    <img src="{{ asset('img/team_cards/eja.png') }}" 
                                         alt="{{ $karyawan->nama }}" 
                                         class="team-member-photo"
                                         onerror="this.style.display='none'">
                                @endif
                            </div>

                            <!-- Wave putih MEMOTONG foto di bawah -->
                            <div class="custom-wave">
                                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                                    <path d="M0,50 C300,110 500,20 600,60 C700,100 900,20 1200,60 L1200,120 L0,120 Z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Konten bawah putih -->
                        <div class="team-info-box">
                            <h3 class="name-title">{{ strtoupper($karyawan->nama) }}</h3>
                            <p class="job-title">{{ $karyawan->kategori->nama_kategori ?? '-' }}</p>
                            <p class="nik-number">NIK : {{ $karyawan->nik }}</p>
                            <p class="description-text">
                                {{ $karyawan->deskripsi ?? 'Tim profesional yang siap memberikan solusi terbaik.' }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Tidak ada data karyawan yang ditampilkan.</p>
                    </div>
                    @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: CTA Section -->
        <section class="relative bg-gray-50 py-20 overflow-x-hidden">
            <!-- Background decoration -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
                <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
                <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-x-hidden w-full">
                <!-- CTA Section -->
                <div class="text-center scroll-animate">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">
                        Ingin Bergabung dengan <span class="colored-text">Tim Kami?</span>
                    </h3>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                        Kami selalu mencari talenta terbaik untuk bergabung dalam misi mengembangkan teknologi
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="#contact" class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 text-lg">
                            <i class="fas fa-users mr-2"></i>
                            Bergabung dengan Kami
                        </a>
                        <a href="#careers" class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-xl font-semibold hover:bg-gray-50 hover:border-red-300 transition-all duration-300 text-lg">
                            <i class="fas fa-briefcase mr-2"></i>
                            Lihat Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>    <!-- Include Footer -->
    @include('partials.footer')
    
    <!-- Scripts -->
    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        // Initialize animations
        document.addEventListener('DOMContentLoaded', () => {
            // Observe scroll animations
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
            
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