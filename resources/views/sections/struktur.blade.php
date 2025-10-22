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
                <div class="mb-20 flex flex-col items-center">
                    <button class="avatar-item avatar-wrapper" data-role="ceo" tabindex="0">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="General Manager"
                            class="avatar-img w-40 h-40 rounded-full object-cover border-4 border-white shadow-xl">
                    </button>
                    <div class="profile-info pointer-events-none h-20 mt-4 flex flex-col items-center justify-center text-center transition-all duration-400">
                        <p class="font-bold text-gray-900 text-lg">John Smith</p>
                        <p class="text-gray-600 text-sm font-semibold">General Manager</p>
                    </div>
                </div>

                <!-- Level 2: Directors & Managers -->
                <div class="flex justify-center gap-16 mb-20 w-full">
                    <!-- Director -->
                    <div class="flex flex-col items-center">
                        <button class="avatar-item avatar-wrapper" data-role="director" tabindex="0">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Director"
                                class="avatar-img w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        </button>
                        <div class="profile-info pointer-events-none h-16 mt-3 flex flex-col items-center justify-center text-center transition-all duration-400">
                            <p class="font-bold text-gray-900">Sarah Johnson</p>
                            <p class="text-gray-600 text-xs font-semibold">Director Operations</p>
                        </div>

                        <!-- Level 3: Director's Team -->
                        <div class="flex gap-12 mt-12">
                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team1" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Emma Wilson</p>
                                    <p class="text-xs text-gray-600">Team Lead</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team2" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Michael Brown</p>
                                    <p class="text-xs text-gray-600">Specialist</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team3" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/women/66.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Lisa Anderson</p>
                                    <p class="text-xs text-gray-600">Coordinator</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manager -->
                    <div class="flex flex-col items-center">
                        <button class="avatar-item avatar-wrapper" data-role="manager" tabindex="0">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Manager"
                                class="avatar-img w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        </button>
                        <div class="profile-info pointer-events-none h-16 mt-3 flex flex-col items-center justify-center text-center transition-all duration-400">
                            <p class="font-bold text-gray-900">David Lee</p>
                            <p class="text-gray-600 text-xs font-semibold">Manager IT</p>
                        </div>

                        <!-- Level 3: Manager's Team -->
                        <div class="flex gap-12 mt-12">
                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team4" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/men/60.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Chris Martin</p>
                                    <p class="text-xs text-gray-600">Senior Dev</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team5" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/men/61.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Robert Garcia</p>
                                    <p class="text-xs text-gray-600">QA Engineer</p>
                                </div>
                            </div>

                            <div class="flex flex-col items-center">
                                <button class="avatar-item avatar-wrapper" data-role="team6" tabindex="0">
                                    <img src="https://randomuser.me/api/portraits/women/70.jpg" alt="Team"
                                        class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                                </button>
                                <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                    <p class="text-sm font-semibold text-gray-900">Jennifer Davis</p>
                                    <p class="text-xs text-gray-600">DevOps</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 3: Additional Team Members in Row Below -->
                <div class="flex justify-center items-start gap-16 w-full">
                    <!-- Left Side - 3 Additional Members -->
                    <div class="flex gap-12">
                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team11" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/men/80.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Kevin Harris</p>
                                <p class="text-xs text-gray-600">Support Lead</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team12" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/women/80.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Amanda Clark</p>
                                <p class="text-xs text-gray-600">HR Manager</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team7" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">James Taylor</p>
                                <p class="text-xs text-gray-600">Analyst</p>
                            </div>
                        </div>
                    </div>


                    <!-- Right Side - 3 Additional Members -->
                    <div class="flex gap-12">
                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team8" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Patricia Moore</p>
                                <p class="text-xs text-gray-600">Supervisor</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team9" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/men/72.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Daniel White</p>
                                <p class="text-xs text-gray-600">Backend Dev</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team10" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/women/72.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Nancy Miller</p>
                                <p class="text-xs text-gray-600">UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 4: Another Row of Team Members -->
                <div class="flex justify-center items-start gap-16 w-full mt-20">
                    <!-- Left Side - 3 Additional Members -->
                    <div class="flex gap-12">
                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team13" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Brian Cooper</p>
                                <p class="text-xs text-gray-600">Project Manager</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team14" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/women/85.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Rachel Green</p>
                                <p class="text-xs text-gray-600">Business Analyst</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <button class="avatar-item avatar-wrapper" data-role="team15" tabindex="0">
                                <img src="https://randomuser.me/api/portraits/men/90.jpg" alt="Team"
                                    class="avatar-img w-28 h-28 rounded-full object-cover border-3 border-white shadow-md">
                            </button>
                            <div class="profile-info pointer-events-none h-14 mt-2 flex flex-col items-center justify-center text-center transition-all duration-400">
                                <p class="text-sm font-semibold text-gray-900">Steven Miller</p>
                                <p class="text-xs text-gray-600">Network Admin</p>
                            </div>
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