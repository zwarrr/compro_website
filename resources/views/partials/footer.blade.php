<!-- Floating animation style -->
<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>


<!-- Footer -->
<footer class="bg-gray-50 border-t border-gray-200 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <!-- Main Footer Content -->
        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-12">
            <!-- Left Side: Logo & Description -->
            <div class="lg:flex-shrink-0 lg:w-80">
                <a href="{{ url('/') }}" class="flex items-center mb-4 pointer-events-auto select-none"
                    style="all: unset; display: flex; align-items: center; gap: 0.75rem;">
                    <!-- Logo -->
                    <div
                        style="width: 3.5rem; height: 3.5rem; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('img/logo_tms.png') }}" alt="TMS"
                            style="width: 100%; height: 100%; object-fit: contain;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    </div>

                    <!-- Text -->
                    <span style="font-size: 1.25rem; font-weight: 700; color: #111;">
                        Technology Multi System
                    </span>
                </a>

                <p style="color: #4B5563; font-size: 1rem; margin-top: 0.5rem; line-height: 1.5;">
                    Solution for your technology.
                </p>

                <!-- Social Media -->
                <div class="flex space-x-4">
                    <!-- YouTube -->
                    <a href="https://www.youtube.com/@tmswebid"
                        class="w-9 h-9 flex items-center justify-center text-gray-500 transition-transform duration-300 hover:scale-125 hover:text-[#FD0103]">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/profile.php?id=61553618875482"
                        class="w-9 h-9 flex items-center justify-center text-gray-500 transition-transform duration-300 hover:scale-125 hover:text-[#1877F2]">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/tms.official.2005/"
                        class="w-9 h-9 flex items-center justify-center text-gray-500 transition-transform duration-300 hover:scale-125 hover:text-[#E1306C]">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Right Side: Three Columns in a row -->
            <div class="flex-1">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 lg:gap-16">
                    <!-- Useful Links -->
                    <div>
                        <h4 class="text-sm font-bold text-blue-900 mb-5 uppercase tracking-wide">
                            USEFUL LINKS
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('beranda') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Beranda</a>
                            </li>
                            <li><a href="{{ route('team') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Team</a></li>
                            <li><a href="{{ route('profil-perusahaan') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Profil Perusahaan</a></li>
                            <li><a href="{{ route('layanan') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Layanan</a></li>
                            <li><a href="{{ route('galeri') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Galeri</a>
                            </li>
                            <li><a href="{{ route('hubungi-kami') }}"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    <!-- Our Services -->
                    <div>
                        <h4 class="text-sm font-bold text-blue-900 mb-5 uppercase tracking-wide">
                            OUR SERVICES
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="https://kotaciamis.com/koci/home.php"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">KOCI</a>
                            </li>
                            <li><a href="#"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">TMS
                                    SERVER</a></li>
                            <li><a href="#"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">UMKM</a>
                            </li>
                            <li><a href="#"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">TASYA</a>
                            </li>
                            <li><a href="#"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">KRESYA</a>
                            </li>
                            <li><a href="https://kocimarket.productlink.id/koci-market"
                                    class="text-sm text-gray-700 hover:text-blue-600 transition-colors duration-200">KOCI
                                    MARKET</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-sm font-bold text-blue-900 mb-5 uppercase tracking-wide">
                            CONTACT US
                        </h4>
                        <div class="space-y-3 text-sm text-gray-700">
                            <!-- Alamat dengan link Google Maps -->
                            <div class="leading-relaxed">
                                <p class="font-semibold mb-2">Alamat:</p>
                                <a href="https://maps.app.goo.gl/X6D7uSgTV6Q9eXUf8" target="_blank" rel="noopener noreferrer"
                                    class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                    JL. Ciamis-Banjar Dusun Kidul RT/RW<br>
                                    007/003 Cijeungjing<br>
                                    Cijeungjing, Ciamis
                                </a>
                            </div>
                            <div class="pt-2">
                                <!-- Phone dengan link telp -->
                                <p class="mb-2">
                                    <span class="font-semibold">Phone:</span>
                                    <a href="tel:+6285223035426" class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                        085223035426
                                    </a>
                                </p>
                                <!-- Email dengan link mailto -->
                                <p>
                                    <span class="font-semibold">Email:</span>
                                    <a href="mailto:kocicenter@gmail.com" class="text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                        kocicenter@gmail.com
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="border-t border-gray-200 mt-8 pt-6">
            <p class="text-center text-sm text-gray-600">
                © Copyright
                <a href="{{ url('/') }}"
                    class="text-blue-500 font-semibold hover:text-blue-600 transition-colors duration-200">
                    TMS
                </a>
                All Rights Reserved
            </p>
        </div>
    </div>
</footer>

<!-- Chat Button -->
<div id="chatButton" class="fixed bottom-8 right-8 z-50 transition-all duration-300">
    <button onclick="openChatModal()"
        class="group flex items-center bg-gray-900 text-white rounded-full shadow-2xl hover:bg-[#FD0103] transition duration-300 overflow-hidden relative animate-float">
        <!-- Glow ring -->
        <div
            class="absolute inset-0 rounded-full bg-[#FD0103]/40 blur-xl opacity-0 group-hover:opacity-100 transition duration-500">
        </div>

        <!-- Mobile: hanya icon -->
        <div class="w-14 h-14 flex items-center justify-center md:hidden relative z-10">
            <img src="https://img.icons8.com/?size=100&id=Z1n6MSkfdSgd&format=png&color=ffffff" alt="Chat Icon"
                class="w-7 h-7 animate-pulse" />
        </div>

        <!-- Desktop: icon + text -->
        <div class="hidden md:flex items-center px-4 py-3 gap-3 relative z-10">
            <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center animate-pulse">
                <img src="https://img.icons8.com/?size=100&id=Z1n6MSkfdSgd&format=png&color=ffffff" alt="Chat Icon"
                    class="w-6 h-6" />
            </div>
            <div class="pr-2 text-left">
                <div class="text-sm font-semibold group-hover:text-white transition">Chat with us</div>
                <div class="text-[10px] opacity-80 group-hover:opacity-100 transition">We’re here to help</div>
            </div>
        </div>

        <!-- Pulse effect -->
        <span class="absolute inset-0 rounded-full bg-white/20 animate-ping opacity-10"></span>
    </button>
</div>

<!-- Include Chat Modal -->
@include('partials.modalchatbot')

<script>
    (function () {
        const initFooter = () => {
            console.log('🚀 Initializing Footer...');

            // Smooth hover effects for footer links
            const footerLinks = document.querySelectorAll('footer a:not(.social-link)');
            footerLinks.forEach(link => {
                link.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateX(2px)';
                });

                link.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateX(0)';
                });
            });

            console.log('✅ Footer initialized with exact layout matching');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFooter);
        } else {
            initFooter();
        }
    })();
</script>