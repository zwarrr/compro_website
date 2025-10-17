<nav class="fixed top-0 left-0 lg:left-64 right-0 h-16 flex items-center justify-between px-6 bg-white backdrop-blur-md border-b border-gray-200 shadow-sm z-30 transition-all">
    <div class="flex items-center gap-4">
        <!-- Sidebar Toggle (mobile) -->
        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <span class="font-bold text-lg text-gray-800 hidden lg:block">Dashboard</span>
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
</script>