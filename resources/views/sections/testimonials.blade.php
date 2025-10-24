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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16 scroll-reveal">
            @forelse($testimonis as $testimoni)
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 scroll-reveal">
                <div class="flex items-center mb-6">
                    <div class="relative">
                        @if($testimoni->foto)
                            <img src="{{ asset('storage/' . $testimoni->foto) }}" alt="{{ $testimoni->nama_testimoni }}, {{ $testimoni->jabatan }}" class="w-16 h-16 rounded-full object-cover ring-4 ring-rose-100" />
                        @else
                            <div class="w-16 h-16 rounded-full object-cover ring-4 ring-rose-100 bg-gray-300 flex items-center justify-center">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                        @endif
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-lg text-gray-900">{{ $testimoni->nama_testimoni }}</h4>
                        <p class="text-sm text-gray-500">{{ $testimoni->jabatan }}</p>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="flex items-center mb-6">
                    <div class="flex testimonial-rating mr-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimoni->rating)
                                <i class="fas fa-star text-yellow-400"></i>
                            @else
                                <i class="fas fa-star text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500 font-medium">{{ $testimoni->rating }}.0 Rating</span>
                </div>
                
                <!-- Testimonial Text -->
                <blockquote class="text-gray-600 leading-relaxed mb-6 italic">
                    "{{ $testimoni->pesan }}"
                </blockquote>
                
                <!-- Result Badge -->
                <div class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas fa-check-circle text-xs"></i>
                    Verified Customer
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-12">
                <p>Tidak ada testimoni yang tersedia</p>
            </div>
            @endforelse
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