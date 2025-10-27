<style>
    /* ============================================
   FAQ SECTION - Dedicated Styles
   ============================================ */
    .faq-item {
        transition: all 0.3s ease;
        min-height: 100px;
        /* Tinggi minimum untuk konsistensi */
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
        min-height: 3.5rem;
        /* Tinggi minimum untuk judul */
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 scroll-reveal">
            <div
                class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                F.A.Q
            </div>
            @if (isset($faq) && $faq)
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    {{ $faq->judul }}
                </h2>
                <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                    {{ $faq->sub_judul }}
                </p>
            @else
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">
                    Yang sering ditanyakan
                </h2>
                <p class="text-gray-600 text-xl max-w-3xl mx-auto">
                    Orang orang banyak nanya ini
                </p>
            @endif
        </div>

        <!-- FAQ Grid Layout 2 Columns -->
        <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto faq-grid scroll-reveal">
            @php
                $faqs_array = $faqs->toArray();
                $mid = ceil(count($faqs_array) / 2);
                $column1 = array_slice($faqs_array, 0, $mid);
                $column2 = array_slice($faqs_array, $mid);
            @endphp

            <!-- Column 1 -->
            <div class="space-y-6">
                @forelse($column1 as $faq)
                    <div class="faq-item cursor-pointer group">
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 pr-4">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                        {{ $faq['pertanyaan'] }}
                                    </h3>
                                    <div
                                        class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                        <p class="text-gray-600 leading-relaxed pb-4">
                                            {{ $faq['jawaban'] }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                    <i
                                        class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500">
                        <p>Tidak ada FAQ yang tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- Column 2 -->
            <div class="space-y-6">
                @forelse($column2 as $faq)
                    <div class="faq-item cursor-pointer group">
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 pr-4">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-rose-600 transition-colors">
                                        {{ $faq['pertanyaan'] }}
                                    </h3>
                                    <div
                                        class="faq-answer max-h-0 overflow-hidden transition-all duration-300 ease-out opacity-0">
                                        <p class="text-gray-600 leading-relaxed pb-4">
                                            {{ $faq['jawaban'] }}
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="faq-icon w-8 h-8 flex items-center justify-center flex-shrink-0 rounded-full bg-gray-100 group-hover:bg-rose-100 transition-colors">
                                    <i
                                        class="fas fa-chevron-down text-gray-500 text-sm transition-transform duration-300 group-hover:text-rose-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500">
                        <p>Tidak ada FAQ yang tersedia</p>
                    </div>
                @endforelse
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
