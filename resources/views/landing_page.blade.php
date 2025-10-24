<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Technology Multi System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">
    
    <!-- CSS External -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Swiper CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <style>
        
        /* Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * { 
            font-family: 'Poppins', sans-serif; 
        }
        
        html { 
            scroll-behavior: smooth; 
        }
        
        body {
            transition: opacity 0.5s ease-in-out;
        }
        
        /* Global Section Spacing */
        section {
            scroll-margin-top: 80px;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            line-height: 1.2;
            color: #111827;
        }
        
        p {
            line-height: 1.6;
            color: #6b7280;
        }
        
        /* ============================================
           ANIMATIONS
           ============================================ */
        
        /* Page Entrance Animation */
        @keyframes pageEnter {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        body.page-loaded {
            animation: pageEnter 0.5s ease-out;
        }
        
        /* Scroll Reveal */
        .scroll-reveal { 
            opacity: 0; 
            transform: translateY(30px); 
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
        }
        
        .scroll-reveal.active { 
            opacity: 1; 
            transform: translateY(0); 
        }
        
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Floating Animation */
        @keyframes floating { 
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .animate-floating { 
            animation: floating 6s ease-in-out infinite; 
        }
        
        /* Blob Animation */
        @keyframes blob {
            0%, 100% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Shimmer Loading */
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }
        
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }
        
        /* Pulse Animation */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .icon-pulse:hover {
            animation: pulse 1s infinite;
        }
        
        /* Gradient Text Animation */
        .gradient-text {
            background: linear-gradient(-45deg, #FD0103, #3b82f6, #10b981, #f59e0b);
            background-size: 400% 400%;
            animation: gradient 3s ease infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* ============================================
           BUTTONS & INTERACTIVE ELEMENTS
           ============================================ */
        
        .btn-primary { 
            position: relative; 
            overflow: hidden; 
            background: linear-gradient(135deg, #FD0103, #FD0103);
            transition: all 0.3s ease;
        }
        
        .btn-primary::before { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: -100%; 
            width: 100%; 
            height: 100%; 
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .btn-primary:hover::before { 
            left: 100%; 
        }
        
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 10px 25px rgba(225, 29, 72, 0.3); 
        }
        
        /* Hover Effects */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Focus States */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.1);
            border-color: #e11d48;
        }
        
        /* ============================================
           UTILITY CLASSES
           ============================================ */
        
        /* Gradient Backgrounds */
        .bg-gradient-rose {
            background: linear-gradient(135deg, #e11d48, #be185d, #9f1239);
        }
        
        .bg-gradient-blue {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8, #1e40af);
        }
        
        .bg-gradient-green {
            background: linear-gradient(135deg, #10b981, #059669, #047857);
        }
        
        .bg-gradient-purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed, #6d28d9);
        }
        
        .bg-gradient-orange {
            background: linear-gradient(135deg, #f97316, #ea580c, #dc2626);
        }
        
        /* Shadows */
        .shadow-professional {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .shadow-professional-lg {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Badges */
        .badge-premium {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #92400e;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(146, 64, 14, 0.1);
        }
        
        .badge-popular {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #065f46;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(6, 95, 70, 0.1);
        }
        
        /* Text Utilities */
        .overflow-wrap-break-word {
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
        }
        
        /* ============================================
           SCROLL TO TOP BUTTON
           ============================================ */
        
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
        
        /* ============================================
           RESPONSIVE STYLES
           ============================================ */
        
        @media (max-width: 640px) {
            .text-responsive {
                font-size: 0.875rem;
                line-height: 1.5;
            }
        }
    </style>
</head>
<body class="bg-white text-slate-900">

    @include('partials.header')
    
    @include('sections.hero')
    
    @include('sections.fitur')
    
    @include('sections.client')
    
    @include('sections.faq')
    
    @include('sections.testimonials')
    
    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Flag untuk mencegah duplikasi inisialisasi
            if (window.landingPageInitialized) return;
            window.landingPageInitialized = true;
            
            // Page fade-in animation dengan class
            document.body.classList.add('page-loaded');
            
            // Scroll Reveal Animation dengan observer
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        // Cegah duplikasi dengan mengecek class
                        if (!entry.target.classList.contains('active')) {
                            entry.target.classList.add('active');
                            // Unobserve setelah animated untuk performa
                            observer.unobserve(entry.target);
                        }
                    }
                });
            }, observerOptions);
            
            // Observe semua scroll-reveal elements
            const scrollRevealElements = document.querySelectorAll('.scroll-reveal');
            scrollRevealElements.forEach(el => {
                observer.observe(el);
            });
            
            // Scroll to Top Button dengan smooth scroll
            const scrollTopBtn = document.createElement('button');
            scrollTopBtn.className = 'scroll-to-top';
            scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
            scrollTopBtn.setAttribute('aria-label', 'Scroll to top');
            scrollTopBtn.setAttribute('type', 'button');
            document.body.appendChild(scrollTopBtn);
            
            // Show/hide scroll to top button dengan smooth transition
            let scrollTimeout;
            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > 300) {
                    scrollTopBtn.classList.add('show');
                } else {
                    scrollTopBtn.classList.remove('show');
                }
            }, { passive: true });
            
            // Click handler untuk scroll to top
            scrollTopBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Smooth scroll untuk anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    
                    // Skip jika href hanya "#"
                    if (href === '#' || href === '') return;
                    
                    const target = document.querySelector(href);
                    
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }, { once: true }); // Tambahkan { once: true } untuk memastikan hanya jalan satu kali
    </script>
</body>
</html>