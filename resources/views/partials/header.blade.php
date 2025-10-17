<style>
    header.scrolled {
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #FD0103;
        transition: width 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #FD0103;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    /* Hover effect yang lebih kuat */
    .nav-link:hover {
        color: #d10002;
    }

    .nav-link.active {
        color: #FD0103;
    }

    /* Dropdown toggle hover effect untuk icon */
    .dropdown-toggle:hover .dropdown-icon i,
    .dropdown-toggle:hover {
        color: #d10002;
    }

    .dropdown-toggle:hover .dropdown-icon i {
        color: #FD0103;
    }

    .mobile-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-menu.active {
        max-height: 500px;
    }

    .hamburger-icon span {
        transition: all 0.3s ease;
    }

    .hamburger-icon.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .hamburger-icon.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger-icon.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }

    /* Tambahan dropdown */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .dropdown-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown.active .dropdown-icon {
        transform: rotate(90deg);
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        min-width: 220px;
        padding: 8px 0;
        z-index: 50;
        animation: slideDown 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dropdown-menu a i {
        width: 18px;
        text-align: center;
        color: #9CA3AF;
        transition: all 0.3s ease;
    }

    .dropdown-menu a:hover {
        background-color: #fff0f0;
        color: #d10002;
        padding-left: 20px;
    }

    .dropdown-menu a:hover i {
        color: #FD0103;
    }

    .dropdown-menu a.active {
        background-color: #fff0f0;
        color: #FD0103;
        font-weight: 600;
    }

    .dropdown-menu a.active i {
        color: #FD0103;
    }

    /* Mobile menu active state */
    .mobile-menu .nav-link.active {
        color: #FD0103;
        font-weight: 600;
    }
</style>

<!-- Header/Navigation -->
<header class="fixed top-0 w-full z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 cursor-pointer">
                <div class="w-15 h-12 flex items-center justify-center">
                    <img src="{{ asset('img/logo_tms.png') }}" alt="Logo TMS" class="w-full h-full object-contain">
                </div>
                <span class="font-bold text-3xl text-gray-900">TMS</span>
            </a>


            <!-- Navigation -->
            <nav class="hidden md:flex items-center ml-auto space-x-6">
                <a href="{{ route('beranda') }}#beranda" class="nav-link" data-scroll="#beranda"
                    class="nav-link text-gray-700 transition-colors duration-200 font-medium">Beranda</a>
                <a href="#fitur" class="nav-link text-gray-700 transition-colors duration-200 font-medium">Fitur</a>
                <a href="#client" class="nav-link text-gray-700 transition-colors duration-200 font-medium">Client</a>
                <a href="#faq" class="nav-link text-gray-700 transition-colors duration-200 font-medium">FAQ</a>

                <!-- Tentang Kami dengan dropdown -->
                <div class="dropdown">
                    <a href="#tentangkami"
                        class="nav-link dropdown-toggle text-gray-700 transition-colors duration-200 font-medium flex items-center">
                        Tentang Kami
                        <span class="dropdown-icon">
                            <i class="fas fa-chevron-right text-gray-500"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('profil-perusahaan') }}">
                            <i class="fas fa-building"></i>
                            <span>Profil Perusahaan</span>
                        </a>
                        <a href="{{ route('team') }}">
                            <i class="fas fa-users"></i>
                            <span>Team</span>
                        </a>
                        <a href="{{ route('galeri') }}">
                            <i class="fas fa-images"></i>
                            <span>Galeri</span>
                        </a>
                    </div>
                </div>
            </nav>


            <!-- Mobile Menu Button -->
            <button class="md:hidden p-2 text-gray-900 hamburger-icon">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden mobile-menu">
            <div class="px-4 py-6 bg-white border-t border-gray-200">
                <nav class="space-y-4">
                    <a href="{{ route('beranda') }}" class="nav-link block text-gray-700 font-medium">Beranda</a>
                    <a href="#fitur" class="nav-link block text-gray-700 font-medium">Fitur</a>
                    <a href="#client" class="nav-link block text-gray-700 font-medium">Client</a>
                    <a href="#faq" class="nav-link block text-gray-700 font-medium">FAQ</a>
                    
                    <!-- Mobile Dropdown -->
                    <div class="space-y-2">
                        <div class="text-gray-700 font-medium">Tentang Kami</div>
                        <div class="pl-4 space-y-2">
                            <a href="{{ route('profil-perusahaan') }}" class="nav-link block text-gray-600 flex items-center gap-2">
                                <i class="fas fa-building text-sm"></i>
                                <span>Profil Perusahaan</span>
                            </a>
                            <a href="{{ route('team') }}" class="nav-link block text-gray-600 flex items-center gap-2">
                                <i class="fas fa-users text-sm"></i>
                                <span>Team</span>
                            </a>
                            <a href="{{ route('galeri') }}" class="nav-link block text-gray-600 flex items-center gap-2">
                                <i class="fas fa-images text-sm"></i>
                                <span>Galeri</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        const initHeader = () => {
            console.log('🚀 Initializing Header...');

            const header = document.querySelector('header');
            const navLinks = document.querySelectorAll('.nav-link');
            const hamburger = document.querySelector('.hamburger-icon');
            const mobileMenu = document.querySelector('.mobile-menu');
            const dropdowns = document.querySelectorAll('.dropdown');

            // Scroll effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header?.classList.add('scrolled');
                } else {
                    header?.classList.remove('scrolled');
                }
            });

            // Dropdown hover effect untuk desktop
            dropdowns.forEach(dropdown => {
                const toggleBtn = dropdown.querySelector('.dropdown-toggle');
                
                if (toggleBtn) {
                    dropdown.addEventListener('mouseenter', () => {
                        dropdown.classList.add('active');
                    });

                    dropdown.addEventListener('mouseleave', () => {
                        dropdown.classList.remove('active');
                    });
                }
            });

            // Set active state untuk halaman beranda dan routes lainnya
            const currentPath = window.location.pathname;
            const allNavLinks = document.querySelectorAll('.nav-link, .dropdown-menu a');
            
            allNavLinks.forEach(link => {
                const href = link.getAttribute('href');
                
                // Reset semua active state terlebih dahulu
                link.classList.remove('active');
                
                // Untuk halaman beranda
                if (currentPath === '/' && (href === '{{ route("beranda") }}' || href === '/')) {
                    link.classList.add('active');
                }
                // Untuk halaman profil-perusahaan
                else if (currentPath === '/profil-perusahaan' && href === '{{ route("profil-perusahaan") }}') {
                    link.classList.add('active');
                }
                // Untuk halaman team
                else if (currentPath === '/team' && href === '{{ route("team") }}') {
                    link.classList.add('active');
                }
                // Untuk halaman galeri
                else if (currentPath === '/galeri' && href === '{{ route("galeri") }}') {
                    link.classList.add('active');
                }
            });

            // Active link on scroll (hanya untuk section IDs di halaman beranda)
            const sections = document.querySelectorAll('section[id]');
            window.addEventListener('scroll', () => {
                // Hanya jalankan scroll detection jika di halaman beranda
                if (currentPath !== '/') return;
                
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.scrollY >= sectionTop - 200) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    // Update active untuk link dengan section ID (#) hanya di halaman beranda
                    if (href.startsWith('#')) {
                        link.classList.remove('active');
                        if (href === `#${current}`) {
                            link.classList.add('active');
                        }
                    }
                });
            });

            // Smooth scroll untuk link dengan #
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href');
                    
                    // Jika link menggunakan # (section ID), gunakan smooth scroll
                    if (href.startsWith('#')) {
                        e.preventDefault();
                        const targetSection = document.querySelector(href);
                        if (targetSection) {
                            targetSection.scrollIntoView({ behavior: 'smooth' });
                        }
                        mobileMenu?.classList.remove('active');
                        hamburger?.classList.remove('active');
                    }
                    // Jika link menggunakan route, tutup mobile menu
                    else {
                        mobileMenu?.classList.remove('active');
                        hamburger?.classList.remove('active');
                    }
                });
            });

            // Mobile menu toggle
            hamburger?.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                mobileMenu?.classList.toggle('active');
            });

            console.log('✅ Header initialized');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHeader);
        } else {
            initHeader();
        }
    })();
</script>

<script>
(function() {
    const initAllNavLinks = () => {
        // Semua nav links dengan section IDs dan routes
        const navMappings = [
            { selector: 'a[href="{{ route("beranda") }}#beranda"]', section: '#beranda', route: '/' },
            { selector: 'a[href="#fitur"]', section: '#fitur', route: '/' },
            { selector: 'a[href="#client"]', section: '#client', route: '/' },
            { selector: 'a[href="#faq"]', section: '#faq', route: '/' },
            { selector: 'a[href="{{ route("profil-perusahaan") }}"]', section: null, route: '/profil-perusahaan' },
            { selector: 'a[href="{{ route("team") }}"]', section: null, route: '/team' },
            { selector: 'a[href="{{ route("galeri") }}"]', section: null, route: '/galeri' }
        ];

        navMappings.forEach(mapping => {
            const link = document.querySelector(mapping.selector);
            if (!link) return;

            // Untuk links dengan section (beranda, fitur, client, faq)
            if (mapping.section) {
                // Smooth scroll jika di halaman yang benar, redirect jika di halaman lain
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const target = document.querySelector(mapping.section);
                    
                    // Jika di halaman beranda dan section ada, smooth scroll
                    if (target && window.location.pathname === mapping.route) {
                        target.scrollIntoView({ behavior: 'smooth' });
                        
                        // Update URL tanpa hash menggunakan history API
                        const sectionName = mapping.section.replace('#', '');
                        const newUrl = sectionName === 'beranda' ? mapping.route : `${mapping.route}${sectionName}`;
                        history.replaceState(null, '', newUrl);
                    }
                    // Jika di halaman lain, redirect ke halaman beranda dengan section
                    else {
                        const sectionName = mapping.section.replace('#', '');
                        const newUrl = sectionName === 'beranda' ? mapping.route : `${mapping.route}${sectionName}`;
                        window.location.href = newUrl;
                    }
                });

                // Set active berdasarkan URL path atau hash
                const sectionName = mapping.section.replace('#', '');
                const expectedPath = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                
                if ((window.location.pathname === expectedPath) || 
                    (window.location.pathname === mapping.route && window.location.hash === mapping.section)) {
                    link.classList.add('active');
                }

                // Deteksi scroll untuk section (hanya di halaman beranda)
                if (window.location.pathname === mapping.route || window.location.pathname.startsWith('/' + sectionName)) {
                    window.addEventListener('scroll', () => {
                        const section = document.querySelector(mapping.section);
                        if (!section) return;

                        const sectionTop = section.offsetTop;
                        const sectionHeight = section.offsetHeight;
                        const scrollPos = window.scrollY + 150; // offset

                        if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                            // Update URL without hash
                            const currentSectionName = mapping.section.replace('#', '');
                            const newUrl = currentSectionName === 'beranda' ? '/' : `/${currentSectionName}`;
                            if (window.location.pathname !== newUrl) {
                                history.replaceState(null, '', newUrl);
                            }
                            
                            // Remove active dari semua links section lain di halaman yang sama
                            navMappings.forEach(otherMapping => {
                                if (otherMapping.route === mapping.route && otherMapping.section) {
                                    const otherLink = document.querySelector(otherMapping.selector);
                                    if (otherLink && otherMapping.section !== mapping.section) {
                                        otherLink.classList.remove('active');
                                    }
                                }
                            });
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            }
            // Untuk links route saja (profil-perusahaan, team, galeri)
            else {
                // Set active jika di halaman yang sesuai
                if (window.location.pathname === mapping.route) {
                    link.classList.add('active');
                }
            }
        });

        // Mobile menu links juga
        const mobileNavMappings = [
            { selector: '.mobile-menu a[href="{{ route("beranda") }}"]', route: '/' },
            { selector: '.mobile-menu a[href="#fitur"]', section: '#fitur', route: '/' },
            { selector: '.mobile-menu a[href="#client"]', section: '#client', route: '/' },
            { selector: '.mobile-menu a[href="#faq"]', section: '#faq', route: '/' },
            { selector: '.mobile-menu a[href="{{ route("profil-perusahaan") }}"]', route: '/profil-perusahaan' },
            { selector: '.mobile-menu a[href="{{ route("team") }}"]', route: '/team' },
            { selector: '.mobile-menu a[href="{{ route("galeri") }}"]', route: '/galeri' }
        ];

        mobileNavMappings.forEach(mapping => {
            const link = document.querySelector(mapping.selector);
            if (!link) return;

            // Set active state untuk mobile menu
            const sectionName = mapping.section ? mapping.section.replace('#', '') : null;
            const expectedPath = sectionName ? (sectionName === 'beranda' ? '/' : `/${sectionName}`) : mapping.route;
            
            if (window.location.pathname === expectedPath || 
                (window.location.pathname === mapping.route && window.location.hash === mapping.section)) {
                link.classList.add('active');
            }

            // Add click handler untuk mobile links dengan section
            if (mapping.section) {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const target = document.querySelector(mapping.section);
                    
                    // Jika di halaman beranda dan section ada, smooth scroll
                    if (target && (window.location.pathname === mapping.route || window.location.pathname.startsWith('/' + sectionName))) {
                        target.scrollIntoView({ behavior: 'smooth' });
                        
                        // Update URL tanpa hash
                        const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                        history.replaceState(null, '', newUrl);
                        
                        // Tutup mobile menu
                        const mobileMenu = document.querySelector('.mobile-menu');
                        const hamburger = document.querySelector('.hamburger-icon');
                        mobileMenu?.classList.remove('active');
                        hamburger?.classList.remove('active');
                    }
                    // Jika di halaman lain, redirect ke section yang tepat
                    else {
                        const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                        window.location.href = newUrl;
                    }
                });
            }

            // Scroll detection untuk mobile menu sections
            if (mapping.section && (window.location.pathname === mapping.route || window.location.pathname.startsWith('/' + sectionName))) {
                window.addEventListener('scroll', () => {
                    const section = document.querySelector(mapping.section);
                    if (!section) return;

                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const scrollPos = window.scrollY + 150;

                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        // Update URL without hash
                        const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                        if (window.location.pathname !== newUrl) {
                            history.replaceState(null, '', newUrl);
                        }
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        });
        
        // Auto scroll ke section saat page load berdasarkan URL
        const currentPath = window.location.pathname;
        const sectionMapping = {
            '/fitur': '#fitur',
            '/client': '#client', 
            '/faq': '#faq'
        };
        
        if (sectionMapping[currentPath]) {
            setTimeout(() => {
                const targetSection = document.querySelector(sectionMapping[currentPath]);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllNavLinks);
    } else {
        initAllNavLinks();
    }
})();
</script>