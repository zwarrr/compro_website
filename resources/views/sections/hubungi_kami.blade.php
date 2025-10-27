<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - PT. Technology Multi System</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">

    <!-- CSS External -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content with padding for fixed header -->
    <main class="pt-20">
        <!-- Hubungi Kami Section -->
        <section id="hubungi-kami" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center gap-2 bg-rose-100 text-rose-700 px-4 py-2 rounded-full text-sm font-medium mb-4">
                        <i class="fas fa-envelope"></i>
                        HUBUNGI KAMI
                    </div>
                    @if (isset($kontak) && $kontak)
                        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                            Kami Siap Membantu Anda
                        </h2>
                        <p class="text-gray-600 text-base max-w-2xl mx-auto">
                            {{$kontak->deskripsi}}
                        </p>
                    @else
                        <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">
                            Kami Siap Membantu Anda
                        </h2>
                        <p class="text-gray-600 text-base max-w-2xl mx-auto">
                            Hubungi kami untuk informasi lebih lanjut tentang layanan kami
                        </p>
                    @endif
                </div>

                <!-- Main Grid - Side by Side Layout -->
                <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <!-- Contact Information - Left Side -->
                    <div class="lg:col-span-1 space-y-4">
                        <!-- Alamat -->
                        <div
                            class="bg-white rounded-12 p-5 shadow-sm border border-gray-100 hover:shadow-2xl hover:border-gray-200 hover:-translate-y-2 transition-all duration-300 cursor-pointer group">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-gray-200 transition-colors duration-300">
                                    <i
                                        class="fas fa-map-marker-alt text-gray-700 text-lg group-hover:text-gray-900 transition-colors duration-300"></i>
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-gray-900 text-sm group-hover:text-gray-950 transition-colors duration-300">
                                        Alamat</h3>
                                    <p
                                        class="text-gray-600 text-xs mt-1 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                        Jl. Contoh Jalan No. 123<br>Jakarta Selatan 12345<br>Indonesia</p>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div
                            class="bg-white rounded-12 p-5 shadow-sm border border-gray-100 hover:shadow-2xl hover:border-gray-200 hover:-translate-y-2 transition-all duration-300 cursor-pointer group">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-gray-200 transition-colors duration-300">
                                    <i
                                        class="fas fa-envelope text-gray-700 text-lg group-hover:text-gray-900 transition-colors duration-300"></i>
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-gray-900 text-sm group-hover:text-gray-950 transition-colors duration-300">
                                        Email</h3>
                                    <p class="text-gray-600 text-xs mt-1">
                                        <a href="mailto:info@tms.com"
                                            class="text-gray-700 font-semibold hover:text-gray-900 transition-colors duration-300">info@tms.com</a><br>
                                        <a href="mailto:support@tms.com"
                                            class="text-gray-700 font-semibold hover:text-gray-900 transition-colors duration-300">support@tms.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div
                            class="bg-white rounded-12 p-5 shadow-sm border border-gray-100 hover:shadow-2xl hover:border-gray-200 hover:-translate-y-2 transition-all duration-300 cursor-pointer group">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-gray-200 transition-colors duration-300">
                                    <i
                                        class="fas fa-phone text-gray-700 text-lg group-hover:text-gray-900 transition-colors duration-300"></i>
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-gray-900 text-sm group-hover:text-gray-950 transition-colors duration-300">
                                        Telepon</h3>
                                    <p class="text-gray-600 text-xs mt-1">
                                        <a href="tel:+62212345678"
                                            class="text-gray-700 font-semibold hover:text-gray-900 transition-colors duration-300">+62
                                            21 2345 6789</a><br>
                                        <a href="tel:+62987654321"
                                            class="text-gray-700 font-semibold hover:text-gray-900 transition-colors duration-300">+62
                                            98 765 4321</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div
                            class="bg-white rounded-12 p-5 shadow-sm border border-gray-100 hover:shadow-2xl hover:border-gray-200 hover:-translate-y-2 transition-all duration-300 cursor-pointer group">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-gray-200 transition-colors duration-300">
                                    <i
                                        class="fas fa-clock text-gray-700 text-lg group-hover:text-gray-900 transition-colors duration-300"></i>
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-gray-900 text-sm group-hover:text-gray-950 transition-colors duration-300">
                                        Jam Operasional</h3>
                                    <p
                                        class="text-gray-600 text-xs mt-1 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                                        Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 12:00<br>Minggu: Libur</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form - Right Side -->
                    <div class="lg:col-span-2">
                        <div
                            class="bg-white rounded-12 p-8 shadow-sm border border-gray-100 hover:shadow-lg hover:border-gray-200 transition-all duration-300">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>

                            <form id="contactForm" class="space-y-4">
                                @csrf
                                <!-- Nama dan Email (2 Kolom) -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="name"
                                            class="block text-xs font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" placeholder="Nama Anda"
                                            required
                                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:border-gray-300 focus:outline-none focus:border-gray-700 focus:ring-1 focus:ring-gray-300 transition-all duration-300">
                                        <span class="error-message text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block text-xs font-semibold text-gray-700 mb-2">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Email Anda"
                                            required
                                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:border-gray-300 focus:outline-none focus:border-gray-700 focus:ring-1 focus:ring-gray-300 transition-all duration-300">
                                        <span class="error-message text-red-500 text-xs mt-1"></span>
                                    </div>
                                </div>

                                <!-- Telepon dan Subjek (2 Kolom) -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="phone"
                                            class="block text-xs font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                        <input type="tel" id="phone" name="phone" placeholder="Nomor Telepon"
                                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:border-gray-300 focus:outline-none focus:border-gray-700 focus:ring-1 focus:ring-gray-300 transition-all duration-300">
                                        <span class="error-message text-red-500 text-xs mt-1"></span>
                                    </div>
                                    <div>
                                        <label for="subject"
                                            class="block text-xs font-semibold text-gray-700 mb-2">Subjek</label>
                                        <input type="text" id="subject" name="subject"
                                            placeholder="Topik Pertanyaan" required
                                            class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:border-gray-300 focus:outline-none focus:border-gray-700 focus:ring-1 focus:ring-gray-300 transition-all duration-300">
                                        <span class="error-message text-red-500 text-xs mt-1"></span>
                                    </div>
                                </div>

                                <!-- Pesan (Full Width) -->
                                <div>
                                    <label for="message"
                                        class="block text-xs font-semibold text-gray-700 mb-2">Pesan</label>
                                    <textarea id="message" name="message" placeholder="Tuliskan pesan Anda..." required
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-lg hover:border-gray-300 focus:outline-none focus:border-gray-700 focus:ring-1 focus:ring-gray-300 transition-all duration-300 resize-none"
                                        rows="5"></textarea>
                                    <span class="error-message text-red-500 text-xs mt-1"></span>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="w-full bg-gray-900 hover:bg-gray-950 active:bg-black text-white font-semibold py-2.5 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 mt-6 shadow-sm hover:shadow-md">
                                    <i class="fas fa-paper-plane"></i>
                                    <span id="submitText">Kirim Pesan</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <script>
        (function() {
            const initContactForm = () => {
                console.log('🚀 Initializing Contact Form...');

                const form = document.getElementById('contactForm');

                if (!form) return;

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const submitBtn = form.querySelector('button[type="submit"]');
                    const submitText = document.getElementById('submitText');
                    const originalText = submitText.textContent;

                    // Disable button and show loading state
                    submitBtn.disabled = true;
                    submitText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

                    // Clear previous errors
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                    const formData = new FormData(form);

                    try {
                        const response = await fetch(form.action ||
                            '{{ route('hubungi-kami.store') }}', {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json',
                                },
                                body: formData
                            });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            // Show success modal
                            showSuccessModal(data.message);

                            // Reset form
                            setTimeout(() => {
                                form.reset();
                            }, 500);
                        } else {
                            // Validation errors
                            if (data.errors) {
                                Object.keys(data.errors).forEach(key => {
                                    const errorElement = document.querySelector(`#${key}`)
                                        .closest('div').querySelector('.error-message');
                                    if (errorElement) {
                                        errorElement.textContent = data.errors[key][0];
                                    }
                                });
                            }

                            showNotification(data.message || 'Terjadi kesalahan!', 'error');
                            submitBtn.disabled = false;
                            submitText.textContent = originalText;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Gagal mengirim pesan. Silakan coba lagi.', 'error');
                        submitBtn.disabled = false;
                        submitText.textContent = originalText;
                    }
                });

                // Set form action
                const form_elem = document.getElementById('contactForm');
                if (form_elem && !form_elem.action) {
                    form_elem.action = '{{ route('hubungi-kami.store') }}';
                }

                console.log('✅ Contact Form initialized');
            };

            // Success Modal Function
            const showSuccessModal = (message) => {
                const modalOverlay = document.createElement('div');
                modalOverlay.id = 'successModalOverlay';
                modalOverlay.className =
                    'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm transition-opacity duration-300 opacity-0';

                const modal = document.createElement('div');
                modal.className =
                    'bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-95';

                modal.innerHTML = `
            <div class="text-center">
                <!-- Success Icon -->
                <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4 animate-bounce">
                    <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                </div>
                
                <!-- Title -->
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Pesan Terkirim!</h3>
                
                <!-- Message -->
                <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                    ${message || 'Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda segera.'}
                </p>
                
                <!-- Divider -->
                <div class="w-12 h-1 bg-gradient-to-r from-transparent via-green-500 to-transparent mx-auto mb-6"></div>
                
                <!-- Close Button -->
                <button id="closeModalBtn" class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-semibold py-3 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                    <i class="fas fa-check"></i>
                    Tutup
                </button>
            </div>
        `;

                modalOverlay.appendChild(modal);
                document.body.appendChild(modalOverlay);

                // Trigger animations
                setTimeout(() => {
                    modalOverlay.classList.remove('opacity-0');
                    modalOverlay.classList.add('opacity-100');
                    modal.classList.remove('scale-95');
                    modal.classList.add('scale-100');
                }, 10);

                // Close button handler
                const closeBtn = document.getElementById('closeModalBtn');
                closeBtn.addEventListener('click', () => {
                    // Fade out animation
                    modalOverlay.classList.remove('opacity-100');
                    modalOverlay.classList.add('opacity-0');
                    modal.classList.remove('scale-100');
                    modal.classList.add('scale-95');

                    // Reload after animation
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                });

                // Auto refresh after 5 seconds
                setTimeout(() => {
                    if (document.getElementById('successModalOverlay')) {
                        location.reload();
                    }
                }, 5000);
            };

            // Error Notification Function
            const showNotification = (message, type = 'info') => {
                const alertDiv = document.createElement('div');
                alertDiv.className = `fixed top-4 right-4 px-4 py-3 rounded-lg text-white text-sm z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
        }`;
                alertDiv.innerHTML = `
            <div class="flex items-center gap-2">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `;

                document.body.appendChild(alertDiv);

                // Remove after 4 seconds
                setTimeout(() => {
                    alertDiv.style.opacity = '0';
                    setTimeout(() => alertDiv.remove(), 300);
                }, 4000);
            };

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initContactForm);
            } else {
                initContactForm();
            }
        })();
    </script>
</body>

</html>
