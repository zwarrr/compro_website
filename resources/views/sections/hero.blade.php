<style>
    /* Hero section styles - animasi dihandle oleh landing page */
    @keyframes fadeInOut1 {
        0%, 100% { opacity: 1; }
        40% { opacity: 1; }
        50% { opacity: 0; }
        60% { opacity: 0; }
    }
    
    @keyframes fadeInOut2 {
        0%, 100% { opacity: 0; }
        40% { opacity: 0; }
        50% { opacity: 1; }
        60% { opacity: 1; }
    }

    @keyframes floating {
        0%, 100% { transform: translate(-50%, -50%); }
        50% { transform: translate(-50%, calc(-50% - 15px)); }
    }
    
    .carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .carousel-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: opacity 0.5s ease-in-out;
        animation: floating 4s ease-in-out infinite;
    }
    
    .carousel-img:nth-child(1) {
        animation: fadeInOut1 12s ease-in-out infinite, floating 4s ease-in-out infinite;
    }
    
    .carousel-img:nth-child(2) {
        animation: fadeInOut2 12s ease-in-out infinite, floating 4s ease-in-out infinite;
    }

    .colored-text {
        background: linear-gradient(135deg, #FD0103 0%, #ff0000 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bg-pattern {
        background-image: radial-gradient(circle, #e5e7eb 1px, transparent 1px);
        background-size: 20px 20px;
    }
</style>

<!-- Hero Section -->
<section id="beranda" class="pt-28 pb-20 bg-gradient-to-br from-gray-50 to-white min-h-screen flex items-center relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-20"></div>

    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center min-h-[70vh]">
            <!-- Left Content -->
            <div class="space-y-8 text-center md:text-left scroll-reveal">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 bg-clip-text text-transparent">
                    PT. Technology Multi System
                </h1>
                
                <p class="text-lg md:text-xl max-w-2xl text-gray-600 mx-auto md:mx-0 leading-relaxed">
                    Solusi lengkap untuk kebutuhan teknologi digital Anda. Platform terintegrasi untuk pulsa, pembayaran, voucher, dan layanan UMKM dengan teknologi terdepan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="https://member.tms.web.id/" target="_blank" 
                       class="hero-btn-primary inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#FD0103] hover:bg-[#d10002] text-white rounded-xl font-semibold shadow-professional hover:shadow-professional-lg transform hover:scale-105 smooth-transition">
                        <span>Coba Sekarang</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>

                    <a href="#faq" 
                       class="hero-btn-secondary inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-gray-700 rounded-xl font-semibold border border-gray-200 shadow-md hover:shadow-lg hover:border-[#FD0103]/40 hover:text-[#FD0103] transform hover:scale-105 transition-all duration-300 ease-in-out">
                        <span>Pelajari Lebih Lanjut</span>
                    </a>
                </div>
            </div>

            <!-- Right Carousel Images -->
            <div class="relative flex items-center justify-center scroll-reveal">
                <div class="carousel-container w-full max-w-lg aspect-square">
                    <!-- Gambar 1 -->
                    <img src="{{ asset('img/ilustrasi_landing_page.svg') }}"
                         alt="PT. Technology Multi System Logo"
                         class="carousel-img">

                    <!-- Gambar 2 -->
                    <img src="{{ asset('img/ilustrasi_landingpage_team.svg') }}"
                         alt="PT. Technology Multi System Logo 2"
                         class="carousel-img">
                </div>
            </div>
        </div>
    </div>
</section>