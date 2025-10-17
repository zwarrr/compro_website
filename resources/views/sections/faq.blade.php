<style>
/* ============================================
   FAQ SECTION - Dedicated Styles
   ============================================ */
.faq-item {
    transition: all 0.3s ease;
    min-height: 100px; /* Tinggi minimum untuk konsistensi */
}

.faq-item:hover {
    background-color: #f9fafb;
}

.faq-item.active {
    background-color: #fef2f2;
    border-color: #fecaca;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.faq-item.active .faq-answer {
    max-height: 500px;
    opacity: 1;
    padding-top: 1rem;
}

.faq-icon i {
    transition: transform 0.3s ease;
}

.faq-item.active .faq-icon i {
    transform: rotate(180deg);
}

/* Pastikan kedua kolom sejajar */
.faq-item h3 {
    line-height: 1.4;
    min-height: 3.5rem; /* Tinggi minimum untuk judul */
    display: flex;
    align-items: center;
}

/* Grid spacing yang konsisten */
.faq-grid {
    align-items: start;
}
</style>

<!-- FAQ Section -->
<section id="faq" class="py-24 bg-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <div class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                F.A.Q
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                Yang sering ditanyakan
            </h2>
        </div>

        <!-- FAQ Grid Layout 2 Columns -->
        <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto faq-grid">
            <!-- Column 1 -->
            <div class="space-y-6">
                <!-- FAQ Item 1 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Layanan apa saja yang tersedia di Technology Multi System?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        Kami menyediakan berbagai layanan teknologi seperti pulsa semua operator, voucher game, token listrik, PDAM, dan layanan pembayaran digital lainnya untuk kebutuhan bisnis Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Technology Multi System itu bergerak di bidang apa?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        PT. Technology Multi System bergerak di bidang teknologi informasi, khususnya dalam penyediaan platform pembayaran digital, pulsa, dan layanan UMKM sejak tahun 2005.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Bagaimana cara saya menghubungi layanan pelanggan Anda?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        Anda dapat menghubungi kami melalui WhatsApp, email, telepon, atau live chat di website. Tim customer service kami siap membantu 24/7 untuk semua kebutuhan Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="space-y-6">
                <!-- FAQ Item 4 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Bagaimana cara memulai transaksi?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        Daftar akun melalui website atau aplikasi mobile, lakukan verifikasi identitas, deposit saldo, kemudian Anda sudah bisa melakukan berbagai transaksi dengan mudah dan aman.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Apa fitur yang dimiliki KOCI?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        KOCI memiliki fitur lengkap seperti pembayaran digital, transfer antar bank, top up e-wallet, pembelian pulsa, voucher game, dan berbagai layanan keuangan syariah.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="faq-item cursor-pointer group">
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 pr-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                    Apa keuntungan layanan kami dibanding pesaing?
                                </h3>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                    <p class="text-gray-600 leading-relaxed pb-4">
                                        Keunggulan kami adalah harga kompetitif, proses transaksi instan, keamanan berlapis, dukungan 24/7, dan ekosistem lengkap yang mendukung pertumbuhan bisnis Anda.
                                    </p>
                                </div>
                            </div>
                            <div class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                <i class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
/* ============================================
   FAQ SECTION - JavaScript
   ============================================ */
(function() {
    const initFAQSection = () => {
        console.log('🚀 Initializing FAQ Section...');
        
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            item.addEventListener('click', function() {
                const isActive = this.classList.contains('active');
                const answer = this.querySelector('.faq-answer');
                const icon = this.querySelector('.faq-icon i');
                
                // Close all other FAQ items
                faqItems.forEach(otherItem => {
                    if (otherItem !== this) {
                        otherItem.classList.remove('active');
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        const otherIcon = otherItem.querySelector('.faq-icon i');
                        
                        if (otherAnswer) {
                            otherAnswer.style.maxHeight = '0px';
                            otherAnswer.style.opacity = '0';
                        }
                        if (otherIcon) {
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
                
                // Toggle current item
                if (!isActive) {
                    this.classList.add('active');
                    if (answer) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.opacity = '1';
                    }
                    if (icon) {
                        icon.style.transform = 'rotate(180deg)';
                    }
                } else {
                    this.classList.remove('active');
                    if (answer) {
                        answer.style.maxHeight = '0px';
                        answer.style.opacity = '0';
                    }
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                }
            });
        });
        
        console.log('✅ FAQ Section initialized');
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFAQSection);
    } else {
        initFAQSection();
    }
})();
</script>