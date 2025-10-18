<x-layouts.app>
    <x-slot name="title">Manajemen User</x-slot>

    <!-- Custom Styles for Smooth Transitions -->
    {{-- <style>
        /* Smooth transitions for table */
        tbody {
            transition: opacity 0.3s ease-in-out;
        }

        /* Pagination smooth transitions */
        #pagination-container {
            transition: all 0.3s ease-in-out;
        }

        /* Hover effects for pagination buttons */
        #pagination-container a,
        #pagination-container span {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hover effect untuk tombol non-active */
        #pagination-container a:hover:not(.bg-primary) {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.15), 0 2px 4px -1px rgba(220, 38, 38, 0.1);
        }

        /* Active page style */
        #pagination-container .bg-primary {
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.4), 0 2px 4px -1px rgba(220, 38, 38, 0.25);
        }

        /* Active page pulse effect */
        #pagination-container .bg-primary {
            animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-subtle {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.95;
            }
        }

        /* Smooth fade-in for table rows */
        tbody tr {
            animation: fadeInRow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for rows */
        tbody tr:nth-child(1) { animation-delay: 0.05s; }
        tbody tr:nth-child(2) { animation-delay: 0.1s; }
        tbody tr:nth-child(3) { animation-delay: 0.15s; }
        tbody tr:nth-child(4) { animation-delay: 0.2s; }
        tbody tr:nth-child(5) { animation-delay: 0.25s; }
        tbody tr:nth-child(6) { animation-delay: 0.3s; }
        tbody tr:nth-child(7) { animation-delay: 0.35s; }
        tbody tr:nth-child(8) { animation-delay: 0.4s; }
        tbody tr:nth-child(9) { animation-delay: 0.45s; }
        tbody tr:nth-child(10) { animation-delay: 0.5s; }

        /* Pagination info box styling */
        #pagination-container .bg-gray-50 {
            transition: all 0.2s ease-in-out;
        }

        #pagination-container .bg-gray-50:hover {
            background-color: #f9fafb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        /* Smooth pagination container appearance */
        #pagination-container {
            animation: slideInUp 0.3s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style> --}}

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen User</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola akun pengguna sistem</p>
            </div>
            <button onclick="openCreateModal()"
                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah User
            </button>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.user.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Filter Status -->
            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <select name="status"
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 transition outline-none appearance-none">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ request('status') == 'tidak aktif' ? 'selected' : '' }}>Non-Aktif
                        </option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">Daftar User</h3>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto overflow-y-visible min-h-[500px]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Terakhir Aktif</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $users->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-primary text-white rounded-full flex items-center justify-center font-semibold">
                                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->status == 'aktif')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->terakhir_aktif ? $user->terakhir_aktif->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium relative">
                                <!-- Dropdown Aksi -->
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <div>
                                        <button @click="open = !open" type="button"
                                            class="inline-flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-offset-2"
                                            :class="{ 'bg-gray-100 text-gray-600': open }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Dropdown menu -->
                                    <div x-show="open" @click.away="open = false"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none border border-gray-200"
                                        style="display: none; z-index: 1;">
                                        <div class="py-1">
                                            <!-- Detail Action -->
                                            <button onclick="showDetail({{ $user->id_user }})"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors first:rounded-t-xl">
                                                <svg class="w-4 h-4 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span>Detail User</span>
                                            </button>

                                            <!-- Edit Action -->
                                            <button onclick="openEditModal({{ $user->id_user }})"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span>Edit User</span>
                                            </button>

                                            <!-- Delete Action -->
                                            <button
                                                onclick="confirmDelete({{ $user->id_user }}, '{{ $user->nama }}')"
                                                class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors last:rounded-b-xl">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span>Hapus User</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="mt-2">Tidak ada data user</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="px-6 py-5 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-white transition-all duration-300 ease-in-out" id="pagination-container">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>

    <!-- Include Modals -->
    @include('admin.user.modals.create')
    @include('admin.user.modals.detail')
    @include('admin.user.modals.edit')
    @include('admin.user.modals.delete')

    <!-- Include Scripts -->
    @include('admin.user.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('admin.user.index') }}"]');
            const searchInput = form.querySelector('input[name="search"]');
            const statusSelect = form.querySelector('select[name="status"]');
            const tbody = document.querySelector('tbody');
            const tableContainer = document.querySelector('.overflow-x-auto');
            let typingTimer;

            function showLoading() {
                // Add fade out effect
                tbody.style.opacity = '0.5';
                tbody.style.transition = 'opacity 0.3s ease-in-out';
                
                setTimeout(() => {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center space-y-3 animate-pulse">
                            <svg class="animate-spin h-10 w-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V8l-3 3 3 3V8a8 8 0 11-16 0h4a4 4 0 108 0z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm font-medium">Memuat data pengguna...</p>
                        </div>
                    </td>
                </tr>
            `;
                }, 150);
            }

            function fetchData(url = null) {
                showLoading();

                // Build URL with parameters
                const baseUrl = url || "{{ route('admin.user.index') }}";
                const searchValue = searchInput.value;
                const statusValue = statusSelect.value;

                const params = new URLSearchParams();
                if (searchValue) params.append('search', searchValue);
                if (statusValue) params.append('status', statusValue);

                const finalUrl = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;

                fetch(finalUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.text();
                    })
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newTbody = doc.querySelector('tbody');
                        const newPaginationContainer = doc.querySelector('#pagination-container');

                        if (newTbody) {
                            // Fade in effect
                            tbody.style.opacity = '0';
                            setTimeout(() => {
                                tbody.innerHTML = newTbody.innerHTML;
                                tbody.style.opacity = '1';
                            }, 200);
                        }

                        // Update pagination with smooth transition
                        const currentPaginationContainer = document.querySelector('#pagination-container');
                        if (newPaginationContainer && currentPaginationContainer) {
                            currentPaginationContainer.style.opacity = '0';
                            setTimeout(() => {
                                currentPaginationContainer.outerHTML = newPaginationContainer.outerHTML;
                                const updatedPagination = document.querySelector('#pagination-container');
                                if (updatedPagination) {
                                    updatedPagination.style.opacity = '1';
                                }
                            }, 200);
                        } else if (!newPaginationContainer && currentPaginationContainer) {
                            // Remove pagination if no pages
                            currentPaginationContainer.style.opacity = '0';
                            setTimeout(() => {
                                currentPaginationContainer.remove();
                            }, 300);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tbody.style.opacity = '1';
                        tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-red-500">
                        <div class="flex flex-col items-center space-y-3">
                            <svg class="h-12 w-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-base">Gagal memuat data user</p>
                                <p class="text-sm text-gray-500 mt-1">Silakan refresh halaman atau coba lagi</p>
                            </div>
                            <button onclick="location.reload()" class="mt-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                                Refresh Halaman
                            </button>
                        </div>
                    </td>
                </tr>
            `;
                    });
            }

            // Live search delay
            searchInput.addEventListener('input', () => {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => fetchData(), 400);
            });

            // Live filter
            statusSelect.addEventListener('change', () => fetchData());

            // AJAX pagination with smooth scroll
            document.addEventListener('click', e => {
                const link = e.target.closest('.relative.inline-flex');
                if (link && link.href && link.closest('#pagination-container')) {
                    e.preventDefault();
                    const url = new URL(link.href);
                    
                    // Smooth scroll to top of table
                    tableContainer.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start' 
                    });
                    
                    // Delay fetch to allow scroll animation
                    setTimeout(() => {
                        fetchData(url.pathname + url.search);
                    }, 300);
                }
            });
        });
    </script>

</x-layouts.app>
