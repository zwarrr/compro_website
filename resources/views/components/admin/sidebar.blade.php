<!-- Sidebar Overlay (Mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed lg:relative inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-lg style-scroll">
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-gray-200 flex items-center gap-3">
        <img src="{{asset('images/logo.png')}}" alt="" width="40">
        <div>
            <h1 class="text-xl font-bold text-gray-800 tracking-wide">Admin Panel</h1>
            <p class="text-xs text-gray-500 mt-1">Web Compro</p>
        </div>
    </div>
    
    <!-- Menu List -->
    <nav class="flex-1 overflow-y-auto p-3 space-y-1 sidebar-scroll">
        @php
            $currentRoute = request()->route()->getName();
            $currentPath = request()->path(); // Get current path without domain
        @endphp

        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" data-route="admin.dashboard" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ $currentRoute === 'admin.dashboard' ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ $currentRoute === 'admin.dashboard' ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ $currentRoute === 'admin.dashboard' ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Dashboard</span>
        </a>

        <!-- User -->
        <a href="{{ route('admin.user.index') }}" data-route="admin.user" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.user') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.user') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.user') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">User</span>
        </a>

        <!-- Konfigurasi -->
        <a href="{{ route('admin.konfigurasi.index') }}" data-route="admin.konfigurasi" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.konfigurasi') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.konfigurasi') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.konfigurasi') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Profil Perusahaan</span>
        </a>

        <!-- Kategori -->
        <a href="{{ route('admin.kategori.index') }}" data-route="admin.kategori" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.kategori') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.kategori') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.kategori') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Kategori</span>
        </a>

        <!-- Layanan -->
        <a href="{{ route('admin.layanan.index') }}" data-route="admin.layanan" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.layanan') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.layanan') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.layanan') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Layanan</span>
        </a>

        <!-- Galeri -->
        <a href="{{ route('admin.galeri.index') }}" data-route="admin.galeri" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.galeri') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.galeri') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.galeri') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Galeri</span>
        </a>

        <!-- Karyawan -->
        <a href="{{ route('admin.karyawan.index') }}" data-route="admin.karyawan" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.karyawan') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.karyawan') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.karyawan') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Karyawan</span>
        </a>

        <!-- Testimoni -->
        <a href="{{ route('admin.testimoni.index') }}" data-route="admin.testimoni" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.testimoni') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.testimoni') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.testimoni') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Testimoni</span>
        </a>

        <!-- Client -->
        <a href="{{ route('admin.client.index') }}" data-route="admin.client" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.client') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.client') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.client') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Client</span>
        </a>

        <!-- Pesan -->
        <a href="{{ route('admin.pesan.index') }}" data-route="admin.pesan" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.pesan') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.pesan') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.pesan') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Pesan</span>
        </a>

        <!-- FAQ -->
        <a href="{{ route('admin.faq.index') }}" data-route="admin.faq" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.faq') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.faq') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.faq') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="font-medium text-sm">FAQ</span>
        </a>

        <!-- Sosial Media -->
        <a href="{{ route('admin.sosial.index') }}" data-route="admin.sosial" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group {{ Str::startsWith($currentRoute, 'admin.sosial') ? 'bg-primary text-white shadow-md' : 'text-gray-700 hover:bg-gray-100' }}">
            <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ Str::startsWith($currentRoute, 'admin.sosial') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-primary/10' }} transition-all duration-200">
                <svg class="w-5 h-5 {{ Str::startsWith($currentRoute, 'admin.sosial') ? 'text-white' : 'text-gray-600 group-hover:text-primary' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </div>
            <span class="font-medium text-sm">Sosial Media</span>
        </a>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-gray-200 mt-auto">
        <div class="text-xs text-gray-500 text-center">
            &copy; 2025 Admin Panel
        </div>
    </div>
</aside>

<style>
    
</style>

<script>
    function toggleSidebar() {  
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    }
</script>