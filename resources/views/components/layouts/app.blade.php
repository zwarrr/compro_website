<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Prevent browser prefetching and loading indicators -->
    <meta http-equiv="x-dns-prefetch-control" content="off">
    <meta name="referrer" content="no-referrer-when-downgrade">
    
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.7/dist/htmx.min.js"></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Loading Bar Animation */
        .loading-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #FD0103 0%, #ff4d4f 50%, #FD0103 100%);
            background-size: 200% 100%;
            z-index: 9999;
            transform-origin: left;
            animation: loading-slide 1s ease-in-out infinite;
            /* PENTING: display none by default */
        }

        .loading-bar.hidden {
            display: none !important;
        }

        @keyframes loading-slide {
            0% {
                transform: scaleX(0);
                background-position: 0% 0%;
            }

            50% {
                transform: scaleX(0.6);
                background-position: 100% 0%;
            }

            100% {
                transform: scaleX(1);
                background-position: 200% 0%;
            }
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(2px);
            z-index: 9998;
            /* JANGAN set display: flex disini! */
            align-items: center;
            justify-content: center;
        }

        .loading-overlay.hidden {
            display: none !important;
        }

        .loading-overlay:not(.hidden) {
            display: flex;
        }

        /* Spinner Animation */
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f4f6;
            border-top: 4px solid #FD0103;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Pulse animation for spinner center */
        .spinner-pulse {
            width: 30px;
            height: 30px;
            background: #FD0103;
            border-radius: 50%;
            animation: pulse 1s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Fade in animation for content */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        .style-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .style-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .style-scroll::-webkit-scrollbar-thumb {
            background: #FD0103;
            border-radius: 4px;
        }

        .style-scroll::-webkit-scrollbar-thumb:hover {
            background: #d10103;
        }

        /* Page transition */
        #main-content {
            transition: opacity 0.15s ease-in-out;
        }
    </style>
    
    <!-- Prevent browser loading indicator on AJAX navigation -->
    {{-- <script>
        // Override beforeunload to prevent loading indicator
        (function() {
            let isAjaxNavigation = false;
            
            // Listen for AJAX navigation events
            window.addEventListener('ajaxNavigationStart', function() {
                isAjaxNavigation = true;
            });
            
            window.addEventListener('ajaxPageLoaded', function() {
                isAjaxNavigation = false;
            });
            
            // Prevent beforeunload indicator during AJAX navigation
            window.addEventListener('beforeunload', function(e) {
                if (isAjaxNavigation) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    return undefined;
                }
            }, true);
            
            // Mark document as complete to prevent loading indicators
            if (document.readyState !== 'complete') {
                window.addEventListener('load', function() {
                    // Ensure readyState is complete
                    setTimeout(function() {
                        document.dispatchEvent(new Event('readystatechange'));
                    }, 0);
                });
            }
        })();
    </script> --}}
</head>

<body class="h-full bg-gray-50 antialiased">
    <!-- Loading Bar (Hidden by default - AJAX disabled) -->
    <div id="loading-bar" class="loading-bar hidden"></div>

    <!-- Loading Overlay (Hidden by default - AJAX disabled) -->
    <div id="loading-overlay" class="loading-overlay hidden">
        <div class="text-center">
            <div class="relative inline-flex items-center justify-center">
                <div class="spinner"></div>
                <div class="spinner-pulse absolute"></div>
            </div>
            <p class="mt-6 text-gray-600 font-medium text-sm">Memuat halaman...</p>
            <p class="mt-1 text-gray-400 text-xs">Mohon tunggu sebentar</p>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <x-admin.navbar />

            <!-- Page Content -->
            <main id="main-content" class="flex-1 overflow-y-auto mt-10 lg:mt-10 style-scroll">
                <!-- Page Header Card (Optional Slot) -->
                <!-- Main Content -->
                <div id="main-content" class="container mx-auto px-6 py-8">
                    <div class="container mx-auto px-6 py-8 bg-white rounded-xl shadow-sm m-6 border border-gray-100">
                        {{ $header }}
                    </div>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
