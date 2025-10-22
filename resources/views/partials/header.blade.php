<style>
    header.scrolled {
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }

    .nav-link {
        position: relative;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
    }

    /* Underline effect */
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

    /* Hover state */
    .nav-link:hover {
        color: #d10002 !important;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* Active state */
    .nav-link.active {
        color: #FD0103 !important;
    }

    .nav-link.active::after {
        width: 100%;
    }

    /* Dropdown toggle styling */
    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 6px;
        position: relative;
        transition: color 0.3s ease;
    }

    .dropdown-toggle:hover {
        color: #d10002 !important;
    }

    .dropdown-toggle:hover::after {
        width: 100%;
    }

    .dropdown-toggle:hover .dropdown-icon {
        color: #d10002 !important;
    }

    .dropdown-toggle:hover .dropdown-icon i {
        color: #d10002 !important;
    }

    /* Active state untuk dropdown toggle */
    .dropdown-toggle.active {
        color: #FD0103 !important;
    }

    .dropdown-toggle.active::after {
        width: 100%;
    }

    .dropdown-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 18px;
        height: 18px;
        color: #9ca3af;
        transition: color 0.3s ease, transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dropdown.active .dropdown-icon {
        transform: rotate(90deg);
    }

    /* Dropdown hover effect - jika ada parent yang hover, tampilkan underline */
    .dropdown:hover .dropdown-toggle::after {
        width: 100%;
    }

    /* Hover active class untuk trigger underline */
    .dropdown-toggle.hover-active::after {
        width: 100% !important;
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

    /* Dropdown menu */
    .dropdown {
        position: relative;
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
        color: #FD0103 !important;
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
                    <a href="javascript:void(0)"
                        class="nav-link dropdown-toggle text-gray-700 transition-colors duration-200 font-medium flex items-center cursor-pointer">
                        Tentang Kami
                        <span class="dropdown-icon">
                            <i class="fas fa-chevron-right"></i>
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
                        <a href="{{ route('loker') }}">
                            <i class="fas fa-briefcase"></i>
                            <span>Lowongan Kerja</span>
                        </a>
                        <a href="{{ route('hubungi-kami') }}">
                            <i class="fas fa-envelope"></i>
                            <span>Hubungi Kami</span>
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
                            <a href="{{ route('loker') }}" class="nav-link block text-gray-600 flex items-center gap-2">
                                <i class="fas fa-briefcase text-sm"></i>
                                <span>Lowongan Kerja</span>
                            </a>
                            <a href="{{ route('hubungi-kami') }}" class="nav-link block text-gray-600 flex items-center gap-2">
                                <i class="fas fa-envelope text-sm"></i>
                                <span>Hubungi Kami</span>
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
            const hamburger = document.querySelector('.hamburger-icon');
            const mobileMenu = document.querySelector('.mobile-menu');
            const dropdowns = document.querySelectorAll('.dropdown');

            // Scroll effect pada header
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

            // Mobile menu toggle
            hamburger?.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                mobileMenu?.classList.toggle('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!hamburger?.contains(e.target) && !mobileMenu?.contains(e.target)) {
                    hamburger?.classList.remove('active');
                    mobileMenu?.classList.remove('active');
                }
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
        console.log('🚀 Initializing Navigation Links with Section Support...');
        
        const currentPath = window.location.pathname;
        const currentHash = window.location.hash;
        
        // Desktop navigation links
        const navLinkElements = document.querySelectorAll('nav .nav-link:not(.dropdown-toggle)');
        
        navLinkElements.forEach(link => {
            const href = link.getAttribute('href');
            
            // Handle click untuk semua links
            link.addEventListener('click', (e) => {
                // Jika link memiliki # (section scroll)
                if (href && href.includes('#')) {
                    e.preventDefault();
                    
                    // Ambil section ID dari href
                    const sectionId = href.substring(href.indexOf('#'));
                    const sectionName = sectionId.replace('#', '');
                    
                    // Jika di halaman beranda, scroll ke section
                    if (currentPath === '/' || currentPath === '/beranda') {
                        const section = document.querySelector(sectionId);
                        if (section) {
                            section.scrollIntoView({ behavior: 'smooth' });
                            // Update URL tanpa hashtag
                            const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                            history.replaceState(null, '', newUrl);
                            updateActiveLink(sectionId);
                        }
                    }
                    // Jika di halaman lain, redirect ke beranda dengan section
                    else {
                        const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                        window.location.href = newUrl;
                    }
                    
                    // Tutup mobile menu jika ada
                    const mobileMenu = document.querySelector('.mobile-menu');
                    const hamburger = document.querySelector('.hamburger-icon');
                    if (mobileMenu) mobileMenu.classList.remove('active');
                    if (hamburger) hamburger.classList.remove('active');
                }
                // Jika link adalah route biasa
                else {
                    // Tutup mobile menu jika ada
                    const mobileMenu = document.querySelector('.mobile-menu');
                    const hamburger = document.querySelector('.hamburger-icon');
                    if (mobileMenu) mobileMenu.classList.remove('active');
                    if (hamburger) hamburger.classList.remove('active');
                }
            });
            
            // Set initial active state
            setInitialActiveState(link, href, currentPath, currentHash);
        });

        // Mobile navigation links
        const mobileNavLinks = document.querySelectorAll('.mobile-menu .nav-link:not(.dropdown-toggle)');
        
        mobileNavLinks.forEach(link => {
            const href = link.getAttribute('href');
            
            link.addEventListener('click', (e) => {
                // Jika link memiliki # (section scroll)
                if (href && href.includes('#')) {
                    e.preventDefault();
                    
                    // Ambil section ID dari href
                    const sectionId = href.substring(href.indexOf('#'));
                    const sectionName = sectionId.replace('#', '');
                    
                    // Jika di halaman beranda, scroll ke section
                    if (currentPath === '/' || currentPath === '/beranda') {
                        const section = document.querySelector(sectionId);
                        if (section) {
                            section.scrollIntoView({ behavior: 'smooth' });
                            // Update URL tanpa hashtag
                            const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                            history.replaceState(null, '', newUrl);
                            updateActiveLink(sectionId);
                        }
                    }
                    // Jika di halaman lain, redirect ke beranda dengan section
                    else {
                        const newUrl = sectionName === 'beranda' ? '/' : `/${sectionName}`;
                        window.location.href = newUrl;
                    }
                }
                
                // Tutup mobile menu
                const mobileMenu = document.querySelector('.mobile-menu');
                const hamburger = document.querySelector('.hamburger-icon');
                if (mobileMenu) mobileMenu.classList.remove('active');
                if (hamburger) hamburger.classList.remove('active');
            });
            
            setInitialActiveState(link, href, currentPath, currentHash);
        });

        // Dropdown links
        const dropdownLinks = document.querySelectorAll('.dropdown-menu a');
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        
        dropdownLinks.forEach(link => {
            const href = link.getAttribute('href');
            
            // Set active state untuk dropdown
            if (href === '/profil-perusahaan' && currentPath === '/profil-perusahaan') {
                link.classList.add('active');
            } else if (href === '/team' && currentPath === '/team') {
                link.classList.add('active');
            } else if (href === '/galeri' && currentPath === '/galeri') {
                link.classList.add('active');
            } else if (href === '/hubungi-kami' && currentPath === '/hubungi-kami') {
                link.classList.add('active');
            }
        });
        
        // Check dan set dropdown toggle active state saat awal
        if (dropdownToggle) {
            const hasActiveChild = Array.from(dropdownLinks).some(link => link.classList.contains('active'));
            if (hasActiveChild) {
                dropdownToggle.classList.add('active');
                // Add hover effect juga
                const dropdown = dropdownToggle.closest('.dropdown');
                if (dropdown) {
                    dropdown.addEventListener('mouseenter', () => {
                        dropdownToggle.style.color = '#d10002';
                    });
                    dropdown.addEventListener('mouseleave', () => {
                        // Jika ada child active, tetap merah
                        if (hasActiveChild) {
                            dropdownToggle.style.color = '#FD0103';
                        } else {
                            dropdownToggle.style.color = '';
                        }
                    });
                }
            }
        }

        // Scroll event untuk update active state - DIPERBAIKI
        window.addEventListener('scroll', () => {
            // Hanya jalankan di halaman beranda
            if (currentPath !== '/' && currentPath !== '/beranda') return;
            
            const sections = ['#beranda', '#fitur', '#client', '#faq'];
            let currentSection = null;
            let currentSectionName = null;
            
            // Deteksi apakah sudah scroll ke footer
            const isAtFooter = window.scrollY + window.innerHeight >= document.body.scrollHeight - 300;
            
            if (isAtFooter) {
                // Jika sudah di footer, remove semua active state
                currentSection = null;
            } else {
                // Deteksi section mana yang sedang dilihat dengan threshold yang lebih akurat
                let maxVisibleArea = 0;
                let visibleSection = null;
                
                sections.forEach(sectionId => {
                    const section = document.querySelector(sectionId);
                    if (!section) return;
                    
                    const rect = section.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;
                    
                    // Hitung area section yang terlihat di viewport
                    const sectionTop = Math.max(rect.top, 0);
                    const sectionBottom = Math.min(rect.bottom, viewportHeight);
                    const visibleArea = Math.max(0, sectionBottom - sectionTop);
                    
                    // Gunakan section dengan area terlihat terbesar
                    if (visibleArea > maxVisibleArea) {
                        maxVisibleArea = visibleArea;
                        visibleSection = sectionId;
                        currentSectionName = sectionId.replace('#', '');
                    }
                });
                
                currentSection = visibleSection;
            }
            
            // Update URL tanpa hashtag berdasarkan section yang aktif
            if (currentSection && currentSectionName) {
                const newUrl = currentSectionName === 'beranda' ? '/' : `/${currentSectionName}`;
                if (window.location.pathname !== newUrl) {
                    history.replaceState(null, '', newUrl);
                }
            } else if (isAtFooter) {
                // Jika di footer, pastikan URL tetap di beranda
                if (window.location.pathname !== '/') {
                    history.replaceState(null, '', '/');
                }
            }
            
            updateActiveLink(currentSection);
        }, { passive: true });

        // Function untuk set initial active state
        function setInitialActiveState(link, href, currentPath, currentHash) {
            const isAtFooter = window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100;
            
            if (isAtFooter) {
                link.classList.remove('active');
                return;
            }
            
            // Check dropdown routes
            if (href === '/profil-perusahaan' && currentPath === '/profil-perusahaan') {
                link.classList.add('active');
            } else if (href === '/team' && currentPath === '/team') {
                link.classList.add('active');
            } else if (href === '/galeri' && currentPath === '/galeri') {
                link.classList.add('active');
            } else if (href === '/hubungi-kami' && currentPath === '/hubungi-kami') {
                link.classList.add('active');
            } else if (href && href.includes('#')) {
                const sectionId = href.substring(href.indexOf('#'));
                const sectionName = sectionId.replace('#', '');
                
                // Check apakah current path matches clean URL
                // Misal: /fitur, /layanan, /faq, /beranda, /
                if (currentPath === `/${sectionName}` || (sectionName === 'beranda' && currentPath === '/')) {
                    link.classList.add('active');
                    return;
                }
                
                // Jika di halaman beranda/beranda route, cek scroll position
                if (currentPath === '/' || currentPath === '/beranda') {
                    const section = document.querySelector(sectionId);
                    if (section) {
                        const rect = section.getBoundingClientRect();
                        const viewportHeight = window.innerHeight;
                        
                        // Section dianggap aktif jika berada di viewport (dengan buffer)
                        if (rect.top < viewportHeight * 0.6 && rect.bottom > viewportHeight * 0.2) {
                            link.classList.add('active');
                            return;
                        }
                    }
                    
                    // Set Beranda active jika di top halaman
                    if (sectionName === 'beranda' && window.scrollY < 100) {
                        link.classList.add('active');
                        return;
                    }
                }
            }
            
            link.classList.remove('active');
        }

        // Function untuk update active link
        function updateActiveLink(activeSection) {
            // Update desktop nav links
            document.querySelectorAll('nav .nav-link:not(.dropdown-toggle)').forEach(link => {
                const href = link.getAttribute('href');
                link.classList.remove('active');
                
                if (activeSection && href && href.includes('#')) {
                    const sectionId = href.substring(href.indexOf('#'));
                    if (sectionId === activeSection) {
                        link.classList.add('active');
                    }
                }
            });
            
            // Update mobile nav links
            document.querySelectorAll('.mobile-menu .nav-link:not(.dropdown-toggle)').forEach(link => {
                const href = link.getAttribute('href');
                link.classList.remove('active');
                
                if (activeSection && href && href.includes('#')) {
                    const sectionId = href.substring(href.indexOf('#'));
                    if (sectionId === activeSection) {
                        link.classList.add('active');
                    }
                }
            });
        }
        
        // Auto scroll ke section saat page load berdasarkan path yang bersih
        // Mapping untuk section routes
        const sectionMap = {
            '/fitur': '#fitur',
            '/client': '#client',
            '/faq': '#faq',
            '/beranda': '#beranda'
        };
        
        if (sectionMap[currentPath]) {
            setTimeout(() => {
                const targetSection = document.querySelector(sectionMap[currentPath]);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }, 100);
        }
        
        // Jika ada hash di URL (dari redirect), juga auto-scroll
        if (currentHash) {
            setTimeout(() => {
                const targetSection = document.querySelector(currentHash);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                    // Update URL ke clean format (tanpa #)
                    const hashName = currentHash.replace('#', '');
                    const newUrl = hashName === 'beranda' ? '/' : `/${hashName}`;
                    history.replaceState(null, '', newUrl);
                }
            }, 100);
        }
        
        // Initial call untuk update active link berdasarkan scroll position saat load
        setTimeout(() => {
            window.dispatchEvent(new Event('scroll'));
        }, 200);
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllNavLinks);
    } else {
        initAllNavLinks();
    }
})();
</script>