<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi - Technology Multi System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .avatar-item {
            animation: fadeInScale 0.6s ease-out forwards;
        }

        .avatar-item:nth-child(1) { animation-delay: 0.1s; }
        .avatar-item:nth-child(2) { animation-delay: 0.2s; }
        .avatar-item:nth-child(3) { animation-delay: 0.3s; }
        .avatar-item:nth-child(4) { animation-delay: 0.35s; }
        .avatar-item:nth-child(5) { animation-delay: 0.4s; }
        .avatar-item:nth-child(6) { animation-delay: 0.45s; }
        .avatar-item:nth-child(7) { animation-delay: 0.5s; }
        .avatar-item:nth-child(8) { animation-delay: 0.55s; }
        .avatar-item:nth-child(9) { animation-delay: 0.6s; }
        .avatar-item:nth-child(10) { animation-delay: 0.65s; }
        .avatar-item:nth-child(11) { animation-delay: 0.7s; }
        .avatar-item:nth-child(12) { animation-delay: 0.75s; }
        .avatar-item:nth-child(13) { animation-delay: 0.8s; }

        .avatar-wrapper {
            position: relative;
            cursor: pointer;
        }

        .avatar-wrapper::before {
            content: '';
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FD0103 0%, #ff0000 100%);
            opacity: 0;
            z-index: -1;
            transition: all 0.4s ease;
        }

        .avatar-wrapper:hover::before {
            opacity: 0.2;
            inset: -8px;
        }

        .avatar-img {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .avatar-img:hover {
            transform: scale(1.12) translateY(-8px);
            filter: drop-shadow(0 16px 32px rgba(253, 1, 3, 0.25));
        }

        .profile-info {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            opacity: 0;
            visibility: hidden;
        }

        .avatar-wrapper:hover ~ .profile-info,
        .avatar-wrapper:focus ~ .profile-info,
        .profile-info.show {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto;
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
</head>
<body class="bg-white">
    <!-- Struktur Organisasi Section -->
    <section class="relative bg-gray-50 py-0">
        <div class="absolute inset-0 bg-pattern opacity-20"></div>

        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
        </div>

        <div class="relative w-full">
            <!-- Header -->
            <div class="text-center py-16 px-4">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Struktur <span class="colored-text">Organisasi</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Struktur organisasi Technology Multi System
                </p>
            </div>
            <!-- Image Container -->
            <div class="flex justify-center px-4 pb-16">
                <div class="w-full max-w-5xl">
                    <!-- PDF Viewer Container -->
                    <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
                        <!-- PDF Toolbar -->
                        <div class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between">
                            <div class="text-sm font-semibold">
                                <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                Struktur Organisasi
                            </div>
                            <a href="{{ asset('pdf/struktur.pdf') }}" target="_blank" 
                               class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded flex items-center gap-2 transition-colors">
                                <i class="fas fa-expand"></i>
                                <span class="text-sm">Fullscreen</span>
                            </a>
                        </div>
                        
                        <!-- PDF/Image Content -->
                        <div class="bg-gray-100 overflow-auto flex justify-center items-start pt-4 p-4" style="max-height: 900px;">
                            <img id="struktur-image" 
                                 src="{{ asset('img/struktur.png') }}" 
                                 alt="Struktur Organisasi TMS"
                                 class="max-w-full h-auto bg-white p-4 rounded shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Handle hover and click events for profile info
        document.addEventListener('DOMContentLoaded', function() {
            const avatarWrappers = document.querySelectorAll('.avatar-wrapper');
            
            avatarWrappers.forEach(wrapper => {
                const profileInfo = wrapper.nextElementSibling;
                
                // Hover events
                wrapper.addEventListener('mouseenter', function() {
                    if (profileInfo && profileInfo.classList.contains('profile-info')) {
                        profileInfo.classList.add('show');
                    }
                });
                
                // Focus event (keyboard)
                wrapper.addEventListener('focus', function() {
                    if (profileInfo && profileInfo.classList.contains('profile-info')) {
                        profileInfo.classList.add('show');
                    }
                });
                
                // Parent container hover out
                wrapper.parentElement.addEventListener('mouseleave', function() {
                    if (profileInfo && profileInfo.classList.contains('profile-info')) {
                        profileInfo.classList.remove('show');
                    }
                });
                
                // Blur event (keyboard)
                wrapper.addEventListener('blur', function() {
                    if (profileInfo && profileInfo.classList.contains('profile-info')) {
                        profileInfo.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html> 