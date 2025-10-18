<style>
/* ============================================
   TESTIMONIALS SECTION - Dedicated Styles
   ============================================ */
.testimonial-card {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.testimonial-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.testimonial-rating {
    color: #fbbf24;
}

.testimonial-rating i {
    transition: all 0.2s ease;
}

.testimonial-card:hover .testimonial-rating i {
    transform: scale(1.2);
}

.testimonial-card.active {
    animation: fadeInScale 0.6s ease-out;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<!-- Testimonials Section -->
<section id="testimonials" class="py-24 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <div class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                <i class="fas fa-quote-left"></i>
                TESTIMONIALS
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                Apa kata mereka?
            </h2>
            <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                Dengarkan langsung dari para pemimpin perusahaan yang telah merasakan transformasi bisnis bersama solusi teknologi kami
            </p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Testimonial 1 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 scroll-reveal">
                <div class="flex items-center mb-6">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1505715229805-a1ae4025e73a" alt="Rudi Setiawan, CEO PT Teknologi Maju" class="w-16 h-16 rounded-full object-cover ring-4 ring-rose-100" onerror="this.src='https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-lg text-gray-900">Rudi Setiawan</h4>
                        <p class="text-sm text-gray-500">CEO, PT Teknologi Maju</p>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="flex items-center mb-6">
                    <div class="flex testimonial-rating mr-3">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">5.0 Rating</span>
                </div>
                
                <!-- Testimonial Text -->
                <blockquote class="text-gray-600 leading-relaxed mb-6 italic">
                    "Transformasi digital yang dilakukan TMS meningkatkan efisiensi operasional kami sebesar 60% dalam 4 bulan. Tim yang sangat profesional dan hasil yang terukur."
                </blockquote>
                
                <!-- Result Badge -->
                <div class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas fa-chart-line text-xs"></i>
                    ROI: 250% dalam 6 bulan
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 scroll-reveal">
                <div class="flex items-center mb-6">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1479800800845-03752b6188fa" alt="Lisa Permata, CFO PT Global Solutions" class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100" onerror="this.src='https://images.pexels.com/photos/3785077/pexels-photo-3785077.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-lg text-gray-900">Lisa Permata</h4>
                        <p class="text-sm text-gray-500">CFO, PT Global Solutions</p>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="flex items-center mb-6">
                    <div class="flex testimonial-rating mr-3">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">5.0 Rating</span>
                </div>
                
                <!-- Testimonial Text -->
                <blockquote class="text-gray-600 leading-relaxed mb-6 italic">
                    "Implementasi sistem analitik yang mereka berikan memberikan insight bisnis yang sangat valuable. Sekarang kami bisa membuat keputusan berdasarkan data real-time."
                </blockquote>
                
                <!-- Result Badge -->
                <div class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas fa-bullseye text-xs"></i>
                    Akurasi Prediksi: 85%
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 scroll-reveal">
                <div class="flex items-center mb-6">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1666249246648-04876acb35a6" alt="Ahmad Pratama, CTO PT Inovasi Digital" class="w-16 h-16 rounded-full object-cover ring-4 ring-green-100" onerror="this.src='https://images.pexels.com/photos/2182970/pexels-photo-2182970.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-lg text-gray-900">Ahmad Pratama</h4>
                        <p class="text-sm text-gray-500">CTO, PT Inovasi Digital</p>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="flex items-center mb-6">
                    <div class="flex testimonial-rating mr-3">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <span class="text-sm text-gray-500 font-medium">5.0 Rating</span>
                </div>
                
                <!-- Testimonial Text -->
                <blockquote class="text-gray-600 leading-relaxed mb-6 italic">
                    "Migrasi ke cloud yang mereka handle berjalan sangat smooth. Zero downtime dan performa sistem meningkat drastis. Highly recommended!"
                </blockquote>
                
                <!-- Result Badge -->
                <div class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas fa-rocket text-xs"></i>
                    Performa: +300%
                </div>
            </div>
        </div>
    </div>
</section>

<script>
/* ============================================
   TESTIMONIALS SECTION - JavaScript
   ============================================ */
(function() {
    const initTestimonialsSection = () => {
        console.log('🚀 Initializing Testimonials Section...');
        
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('active');
                    }, index * 150);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        testimonialCards.forEach(card => observer.observe(card));
        
        console.log('✅ Testimonials Section initialized');
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTestimonialsSection);
    } else {
        initTestimonialsSection();
    }
})();
</script>