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
    <section class="relative bg-gray-50 py-24">
        <div class="absolute inset-0 bg-pattern opacity-20"></div>

        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 bg-rose-300 rounded-full animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-300 rounded-full animate-bounce"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-green-300 rounded-full animate-ping"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-24">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Struktur <span class="colored-text">Organisasi</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Hierarki dan struktur organisasi Technology Multi System
                </p>
            </div>

            <!-- Chart Container -->
            <div class="flex flex-col items-center w-full">
                <!-- Level 1: General Manager -->
                <div class="mb-20 flex flex-col items-center w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-rose-700 mb-6 text-center">General Manager</h3>
                    @if($generalManager)
                        <button class="avatar-item avatar-wrapper" data-role="ceo" tabindex="0">
                            <img src="{{ $generalManager->foto ? asset('storage/karyawan/' . $generalManager->foto) : 'https://randomuser.me/api/portraits/men/45.jpg' }}" alt="General Manager"
                                class="avatar-img w-40 h-40 rounded-full object-cover border-4 border-white shadow-xl">
                        </button>
                        <div class="profile-info pointer-events-none h-20 mt-4 flex flex-col items-center justify-center text-center transition-all duration-400">
                            <p class="font-bold text-gray-900 text-lg">{{ $generalManager->nama }}</p>
                            <p class="text-gray-600 text-sm font-semibold">{{ $generalManager->staff ?? 'General Manager' }}</p>
                        </div>
                    @endif
                </div>

                <!-- Level 2: Marketing & SDM -->
                <div class="mb-20 w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-blue-700 mb-6 text-center">Marketing & SDM</h3>
                    <div class="flex flex-wrap justify-center gap-8 md:gap-16 w-full">
                        @foreach($marketings as $marketing)
                            <div class="flex flex-col items-center mb-8">
                                <button class="avatar-item avatar-wrapper" data-role="marketing" tabindex="0">
                                    <img src="{{ $marketing->foto ? asset('storage/karyawan/' . $marketing->foto) : 'https://randomuser.me/api/portraits/men/22.jpg' }}" alt="marketing"
                                        class="avatar-img w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                </button>
                                <div class="profile-info pointer-events-none h-16 mt-3 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="font-bold text-gray-900">{{ $marketing->nama }}</p>
                                    <p class="text-gray-600 text-xs font-semibold">{{ $marketing->staff ?? 'marketing' }}</p>
                                </div>
                            </div>
                        @endforeach
                        @foreach($sdms as $sdm)
                            <div class="flex flex-col items-center mb-8">
                                <button class="avatar-item avatar-wrapper" data-role="sdm" tabindex="0">
                                    <img src="{{ $sdm->foto ? asset('storage/karyawan/' . $sdm->foto) : 'https://randomuser.me/api/portraits/men/33.jpg' }}" alt="sdm"
                                        class="avatar-img w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                </button>
                                <div class="profile-info pointer-events-none h-16 mt-3 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="font-bold text-gray-900">{{ $sdm->nama }}</p>
                                    <p class="text-gray-600 text-xs font-semibold">{{ $sdm->staff ?? 'sdm' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Level 3: Accounting -->
                <div class="mb-20 w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-green-700 mb-6 text-center">Accounting</h3>
                    <div class="flex flex-wrap justify-center gap-8 md:gap-16 w-full">
                        @foreach($accountings as $accounting)
                            <div class="flex flex-col items-center mb-8">
                                <button class="avatar-item avatar-wrapper" data-role="accounting" tabindex="0">
                                    <img src="{{ $accounting->foto ? asset('storage/karyawan/' . $accounting->foto) : 'https://randomuser.me/api/portraits/men/80.jpg' }}" alt="accounting"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">{{ $accounting->nama }}</p>
                                    <p class="text-xs text-gray-600">{{ $accounting->staff ?? 'accounting' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Level 4: Support -->
                <div class="mb-20 w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-purple-700 mb-6 text-center">Support</h3>
                    <div class="flex flex-wrap justify-center gap-8 md:gap-16 w-full">
                        @foreach($supports as $support)
                            <div class="flex flex-col items-center mb-8">
                                <button class="avatar-item avatar-wrapper" data-role="support" tabindex="0">
                                    <img src="{{ $support->foto ? asset('storage/karyawan/' . $support->foto) : 'https://randomuser.me/api/portraits/men/80.jpg' }}" alt="support"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">{{ $support->nama }}</p>
                                    <p class="text-xs text-gray-600">{{ $support->staff ?? 'support' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Level 5: UMB -->
                <div class="mb-20 w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-yellow-700 mb-6 text-center">UMB</h3>
                    <div class="flex flex-wrap justify-center gap-8 md:gap-16 w-full">
                        @foreach($umbs as $umb)
                            <div class="flex flex-col items-center mb-8">
                                <button class="avatar-item avatar-wrapper" data-role="umb" tabindex="0">
                                    <img src="{{ $umb->foto ? asset('storage/karyawan/' . $umb->foto) : 'https://randomuser.me/api/portraits/men/80.jpg' }}" alt="umb"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">{{ $umb->nama }}</p>
                                    <p class="text-xs text-gray-600">{{ $umb->staff ?? 'umb' }}</p>
                                </div>
                            </div>
                        @endforeach
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