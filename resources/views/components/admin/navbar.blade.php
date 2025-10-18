<nav class="fixed top-0 left-0 lg:left-64 right-0 h-16 flex items-center justify-between px-6 bg-white backdrop-blur-md border-b border-gray-200 shadow-sm z-30 transition-all">
    <div class="flex items-center gap-4 flex-1 min-w-0">
        <!-- Sidebar Toggle (mobile) -->
        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors flex-shrink-0">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <!-- Spotlight Search Button -->
        <button onclick="openSpotlight()" class="flex items-center gap-2 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors group flex-shrink-0">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span class="hidden md:inline text-sm text-gray-600">Search...</span>
            <kbd class="hidden lg:inline-flex items-center px-1.5 py-0.5 bg-white border border-gray-300 rounded text-xs font-mono text-gray-500">
                Ctrl+K
            </kbd>
        </button>
        
        <!-- Breadcrumbs -->
        <nav class="hidden md:flex items-center gap-2 text-sm overflow-x-auto scrollbar-hide flex-1 min-w-0" aria-label="Breadcrumb">
            @php
                $segments = request()->segments();
                $breadcrumbs = [];
                $url = '';
                
                // Skip 'admin' segment dan mulai dari segment berikutnya
                // Jika hanya /admin atau /admin/dashboard, tampilkan Dashboard sebagai home
                $filteredSegments = array_slice($segments, 1); // Skip 'admin'
                
                // Mapping untuk icon berdasarkan segment
                $iconMap = [
                    'dashboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                    'user' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                    'kategori' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
                    'layanan' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                    'galeri' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                    'karyawan' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                    'client' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
                    'testimoni' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
                    'faq' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    'pesan' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                    'sosial' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>',
                    'konfigurasi' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
                ];
                
                // Mapping untuk label Indonesia
                $labelMap = [
                    'dashboard' => 'Dashboard',
                    'user' => 'User',
                    'kategori' => 'Kategori',
                    'layanan' => 'Layanan',
                    'galeri' => 'Galeri',
                    'karyawan' => 'Karyawan',
                    'client' => 'Client',
                    'testimoni' => 'Testimoni',
                    'faq' => 'FAQ',
                    'pesan' => 'Pesan',
                    'sosial' => 'Sosial Media',
                    'konfigurasi' => 'Konfigurasi',
                ];
                
                // Build breadcrumbs dari filtered segments
                $url = '/admin'; // Start from /admin base
                
                // Jika tidak ada segment setelah admin atau hanya dashboard, tampilkan home
                if (empty($filteredSegments) || (count($filteredSegments) == 1 && $filteredSegments[0] == 'dashboard')) {
                    $breadcrumbs[] = [
                        'url' => '/admin/dashboard',
                        'label' => 'Dashboard',
                        'icon' => $iconMap['dashboard'],
                        'active' => true
                    ];
                } else {
                    // Tambahkan Dashboard sebagai home (tidak aktif)
                    $breadcrumbs[] = [
                        'url' => '/admin/dashboard',
                        'label' => 'Dashboard',
                        'icon' => $iconMap['dashboard'],
                        'active' => false
                    ];
                    
                    // Tambahkan segment lainnya
                    foreach ($filteredSegments as $index => $segment) {
                        if ($segment !== 'dashboard') { // Skip dashboard karena sudah ditambahkan sebagai home
                            $url .= '/' . $segment;
                            $label = $labelMap[$segment] ?? ucfirst($segment);
                            $icon = $iconMap[$segment] ?? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>';
                            
                            $breadcrumbs[] = [
                                'url' => $url,
                                'label' => $label,
                                'icon' => $icon,
                                'active' => $index === count($filteredSegments) - 1
                            ];
                        }
                    }
                }
            @endphp
            
            @if(count($breadcrumbs) > 0)
                @foreach($breadcrumbs as $index => $crumb)
                    @if($index > 0)
                        <!-- Separator -->
                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    @endif
                    
                    @if($crumb['active'])
                        <!-- Active Breadcrumb -->
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-primary/10 rounded-lg border border-primary/20 flex-shrink-0">
                            <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $crumb['icon'] !!}
                            </svg>
                            <span class="font-semibold text-primary text-sm whitespace-nowrap">{{ $crumb['label'] }}</span>
                        </div>
                    @else
                        <!-- Clickable Breadcrumb -->
                        <a href="{{ $crumb['url'] }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors group flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $crumb['icon'] !!}
                            </svg>
                            <span class="text-gray-600 group-hover:text-gray-800 text-sm whitespace-nowrap">{{ $crumb['label'] }}</span>
                        </a>
                    @endif
                @endforeach
            @else
                <!-- Default Home Breadcrumb -->
                <div class="flex items-center gap-2 px-3 py-1.5 bg-primary/10 rounded-lg border border-primary/20">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="font-semibold text-primary text-sm">Dashboard</span>
                </div>
            @endif
        </nav>
    </div>

    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <div x-data="{ open: false, notifications: [], unreadCount: 0 }" 
             x-init="
                 // Simulasi data notifikasi
                 notifications = [
                     { id: 1, title: 'Pesan Baru', message: 'Anda memiliki pesan dari client', time: '5 menit lalu', read: false, type: 'message' },
                     { id: 2, title: 'Testimoni Baru', message: 'Client memberikan testimoni positif', time: '1 jam lalu', read: false, type: 'testimonial' },
                     { id: 3, title: 'Order Baru', message: 'Ada project baru yang masuk', time: '2 jam lalu', read: true, type: 'order' },
                     { id: 4, title: 'Update System', message: 'System akan maintenance besok', time: '1 hari lalu', read: true, type: 'system' }
                 ];
                 unreadCount = notifications.filter(n => !n.read).length;
             " 
             class="relative">
            <button @click="open = !open; if(!open) markAllAsRead()" 
                    class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <template x-if="unreadCount > 0">
                    <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center" 
                          x-text="unreadCount"></span>
                </template>
            </button>

            <!-- Notifications Dropdown -->
            <div x-show="open" @click.away="open = false" x-transition
                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-200 max-h-96 overflow-y-auto">
                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center">
                    <p class="text-sm font-semibold text-gray-800">Notifikasi</p>
                    <template x-if="unreadCount > 0">
                        <button @click="markAllAsRead()" class="text-xs text-blue-600 hover:text-blue-800">
                            Tandai semua dibaca
                        </button>
                    </template>
                </div>
                
                <template x-if="notifications.length === 0">
                    <div class="px-4 py-8 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="mt-2 text-sm">Tidak ada notifikasi</p>
                    </div>
                </template>

                <template x-for="notification in notifications" :key="notification.id">
                    <div class="px-4 py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors"
                         :class="{ 'bg-blue-50': !notification.read }">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center"
                                 :class="{
                                     'bg-blue-100 text-blue-600': notification.type === 'message',
                                     'bg-green-100 text-green-600': notification.type === 'testimonial', 
                                     'bg-purple-100 text-purple-600': notification.type === 'order',
                                     'bg-gray-100 text-gray-600': notification.type === 'system'
                                 }">
                                <template x-if="notification.type === 'message'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'testimonial'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'order'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'system'">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    </svg>
                                </template>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                                <p class="text-xs text-gray-600 mt-1" x-text="notification.message"></p>
                                <p class="text-xs text-gray-400 mt-1" x-text="notification.time"></p>
                            </div>
                            <template x-if="!notification.read">
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                            </template>
                        </div>
                    </div>
                </template>

                <div class="px-4 py-2 border-t border-gray-100" x-show="notifications.length > 0">
                    <a href="#" class="block text-center text-sm text-blue-600 hover:text-blue-800 py-2">
                        Lihat semua notifikasi
                    </a>
                </div>
            </div>
        </div>

        <!-- User Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                <!-- Profile dengan inisial dari Auth -->
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold text-sm border-2 border-primary shadow-sm">
                    @php
                        $name = Auth::user()->nama ?? 'User';
                        $names = explode(' ', $name);
                        $initials = '';
                        
                        if(count($names) == 1) {
                            $initials = strtoupper(substr($names[0], 0, 1));
                        } else {
                            $initials = strtoupper(substr($names[0], 0, 1) . substr(end($names), 0, 1));
                        }
                    @endphp
                    {{ $initials }}
                </div>
                <div class="hidden md:block text-left">
                    <div class="font-semibold text-sm text-gray-800">{{ Auth::user()->nama ?? 'User' }}</div>
                    <div class="text-xs text-gray-500">Administrator</div>
                </div>
                <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-600 transition-transform" fill="none" stroke="currentColor" 
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div x-show="open" @click.away="open = false" x-transition
                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-200">
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->nama ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'email@example.com' }}</p>
                </div>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm">Profile</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm">Settings</span>
                </a>
                <hr class="my-2 border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-red-600 hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
// Fungsi untuk notifikasi
function markAllAsRead() {
    const notificationComponent = Alpine.$data(document.querySelector('[x-data]'));
    notificationComponent.notifications.forEach(notification => {
        notification.read = true;
    });
    notificationComponent.unreadCount = 0;
}

// Simulasi notifikasi baru (bisa diintegrasikan dengan WebSocket/Laravel Echo)
function addNewNotification(title, message, type = 'message') {
    const notificationComponent = Alpine.$data(document.querySelector('[x-data]'));
    const newNotification = {
        id: Date.now(),
        title: title,
        message: message,
        time: 'Baru saja',
        read: false,
        type: type
    };
    
    notificationComponent.notifications.unshift(newNotification);
    notificationComponent.unreadCount++;
    
    // Play notification sound (optional)
    playNotificationSound();
}

function playNotificationSound() {
    const audio = new Audio('data:audio/wav;base64,UklGRigAAABXQVZFZm10IBAAAAABAAEARKwAAIhYAQACABAAZGF0YQQAAAAAAA==');
    audio.play().catch(() => {});
}

// Contoh: Tambah notifikasi baru setiap 30 detik (untuk testing)
setTimeout(() => {
    addNewNotification('Client Baru', 'Perusahaan ABC baru saja mendaftar', 'order');
}, 30000);

// ============================================
// SPOTLIGHT SEARCH FUNCTIONALITY
// ============================================

let spotlightOpen = false;
let spotlightResults = [];
let spotlightSelectedIndex = 0;
let spotlightSearchTimeout = null;

// Icon mapping untuk berbagai tipe
const iconMap = {
    'page': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
    'user': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'kategori': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
    'layanan': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    'galeri': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
    'karyawan': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
    'client': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
    'testimoni': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
    'faq': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'pesan': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    'sosial': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>',
    'konfigurasi': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
    'dashboard': '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
};

function openSpotlight() {
    spotlightOpen = true;
    spotlightResults = [];
    spotlightSelectedIndex = 0;
    
    // Create modal overlay
    const modal = document.createElement('div');
    modal.id = 'spotlight-modal';
    modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-start justify-center pt-32 px-4';
    modal.innerHTML = `
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden animate-slide-down">
            <!-- Search Input -->
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-200">
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input 
                    type="text" 
                    id="spotlight-input" 
                    placeholder="Cari halaman, data, menu..." 
                    class="flex-1 bg-transparent border-none outline-none text-gray-800 placeholder-gray-400 text-base"
                    autocomplete="off"
                    autofocus
                />
                <kbd class="px-2 py-1 bg-gray-100 border border-gray-300 rounded text-xs font-mono text-gray-500">ESC</kbd>
            </div>
            
            <!-- Loading State -->
            <div id="spotlight-loading" class="hidden px-5 py-8 text-center">
                <svg class="w-8 h-8 mx-auto text-gray-400 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="mt-2 text-sm text-gray-500">Mencari...</p>
            </div>
            
            <!-- Results Container -->
            <div id="spotlight-results" class="max-h-96 overflow-y-auto">
                <div class="px-5 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="mt-2 text-sm">Ketik untuk mencari...</p>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="flex items-center justify-between px-5 py-3 bg-gray-50 border-t border-gray-200 text-xs text-gray-500">
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 bg-white border border-gray-300 rounded">↑↓</kbd>
                        Navigasi
                    </span>
                    <span class="flex items-center gap-1">
                        <kbd class="px-1.5 py-0.5 bg-white border border-gray-300 rounded">Enter</kbd>
                        Buka
                    </span>
                </div>
                <span>Spotlight Search</span>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Add event listeners
    const input = document.getElementById('spotlight-input');
    input.focus();
    
    input.addEventListener('input', handleSpotlightInput);
    input.addEventListener('keydown', handleSpotlightKeydown);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeSpotlight();
    });
    
    // Add animation CSS
    if (!document.getElementById('spotlight-animation-style')) {
        const style = document.createElement('style');
        style.id = 'spotlight-animation-style';
        style.textContent = `
            @keyframes slide-down {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-slide-down {
                animation: slide-down 0.2s ease-out;
            }
            #spotlight-results::-webkit-scrollbar {
                width: 8px;
            }
            #spotlight-results::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            #spotlight-results::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }
            #spotlight-results::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        `;
        document.head.appendChild(style);
    }
}

function closeSpotlight() {
    const modal = document.getElementById('spotlight-modal');
    if (modal) {
        modal.remove();
    }
    spotlightOpen = false;
    spotlightResults = [];
    spotlightSelectedIndex = 0;
}

function handleSpotlightInput(e) {
    const query = e.target.value.trim();
    
    // Clear previous timeout
    if (spotlightSearchTimeout) {
        clearTimeout(spotlightSearchTimeout);
    }
    
    if (query.length < 2) {
        displaySpotlightResults([]);
        return;
    }
    
    // Show loading
    document.getElementById('spotlight-loading').classList.remove('hidden');
    document.getElementById('spotlight-results').innerHTML = '';
    
    // Debounce search
    spotlightSearchTimeout = setTimeout(() => {
        performSpotlightSearch(query);
    }, 300);
}

function performSpotlightSearch(query) {
    fetch(`/admin/search?query=${encodeURIComponent(query)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(results => {
        console.log('Search results:', results);
        spotlightResults = results;
        spotlightSelectedIndex = 0;
        document.getElementById('spotlight-loading').classList.add('hidden');
        displaySpotlightResults(results);
    })
    .catch(error => {
        console.error('Search error:', error);
        document.getElementById('spotlight-loading').classList.add('hidden');
        const container = document.getElementById('spotlight-results');
        container.innerHTML = `
            <div class="px-5 py-8 text-center text-red-500">
                <svg class="w-12 h-12 mx-auto text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2 text-sm font-semibold">Terjadi kesalahan</p>
                <p class="mt-1 text-xs text-gray-500">${error.message}</p>
            </div>
        `;
    });
}

function displaySpotlightResults(results) {
    const container = document.getElementById('spotlight-results');
    
    if (results.length === 0) {
        container.innerHTML = `
            <div class="px-5 py-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2 text-sm">Tidak ada hasil ditemukan</p>
            </div>
        `;
        return;
    }
    
    // Group results by type
    const grouped = {};
    results.forEach(result => {
        const type = result.type || 'other';
        if (!grouped[type]) grouped[type] = [];
        grouped[type].push(result);
    });
    
    const typeLabels = {
        'page': 'Halaman',
        'user': 'User',
        'kategori': 'Kategori',
        'layanan': 'Layanan',
        'karyawan': 'Karyawan',
        'client': 'Client',
        'testimoni': 'Testimoni',
        'faq': 'FAQ',
        'pesan': 'Pesan',
        'galeri': 'Galeri',
        'sosial': 'Sosial Media',
        'konfigurasi': 'Konfigurasi',
        'dashboard': 'Dashboard'
    };
    
    let html = '';
    let globalIndex = 0;
    
    Object.keys(grouped).forEach(type => {
        html += `<div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50">${typeLabels[type] || type}</div>`;
        
        grouped[type].forEach(result => {
            const isSelected = globalIndex === spotlightSelectedIndex;
            const icon = iconMap[result.icon] || iconMap['page'];
            
            html += `
                <a href="${result.url}" 
                   class="flex items-start gap-3 px-5 py-3 border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors ${isSelected ? 'bg-blue-50 border-l-4 border-l-blue-500' : ''}"
                   data-index="${globalIndex}">
                    <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center ${isSelected ? 'bg-blue-100' : 'bg-gray-100'}">
                        <svg class="w-5 h-5 ${isSelected ? 'text-blue-600' : 'text-gray-600'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            ${icon}
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">${result.title}</p>
                        <p class="text-xs text-gray-500 mt-0.5">${result.description}</p>
                    </div>
                    ${isSelected ? '<svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>' : ''}
                </a>
            `;
            globalIndex++;
        });
    });
    
    container.innerHTML = html;
}

function handleSpotlightKeydown(e) {
    if (e.key === 'Escape') {
        e.preventDefault();
        closeSpotlight();
    } else if (e.key === 'ArrowDown') {
        e.preventDefault();
        spotlightSelectedIndex = Math.min(spotlightSelectedIndex + 1, spotlightResults.length - 1);
        displaySpotlightResults(spotlightResults);
        scrollToSelected();
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        spotlightSelectedIndex = Math.max(spotlightSelectedIndex - 1, 0);
        displaySpotlightResults(spotlightResults);
        scrollToSelected();
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (spotlightResults.length > 0 && spotlightResults[spotlightSelectedIndex]) {
            window.location.href = spotlightResults[spotlightSelectedIndex].url;
        }
    }
}

function scrollToSelected() {
    const container = document.getElementById('spotlight-results');
    const selected = container.querySelector(`[data-index="${spotlightSelectedIndex}"]`);
    if (selected) {
        selected.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }
}

// Global keyboard shortcut (Ctrl+K or Cmd+K)
document.addEventListener('keydown', (e) => {
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        if (spotlightOpen) {
            closeSpotlight();
        } else {
            openSpotlight();
        }
    }
});
</script>