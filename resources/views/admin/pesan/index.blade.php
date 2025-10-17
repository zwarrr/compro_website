<x-layouts.app>
    <x-slot name="title">Pesan Masuk</x-slot>

    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pesan Masuk</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola pesan dari pengunjung website</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Badge Unread Count -->
                <div class="flex items-center gap-2 px-4 py-2 bg-red-50 rounded-lg border border-red-200">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-semibold text-red-700">{{ $unreadCount }} Belum Dibaca</span>
                </div>

                <button onclick="openCreateModal()"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2 text-sm shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Pesan Baru
                </button>
            </div>
        </div>
    </x-slot>

    <!-- Filter & Search Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-200">
        <form method="GET" action="{{ route('admin.pesan.index') }}" id="filterForm"
            class="flex flex-col md:flex-row gap-4">

            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, subjek, atau kode..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                        id="searchInput">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Filter Status Baca -->
            <div class="w-full md:w-48">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <select name="status_baca" id="statusBacaSelect"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent bg-white appearance-none transition">
                        <option value="">Semua Pesan</option>
                        <option value="belum" {{ request('status_baca') == 'belum' ? 'selected' : '' }}>Belum Dibaca
                        </option>
                        <option value="sudah" {{ request('status_baca') == 'sudah' ? 'selected' : '' }}>Sudah Dibaca
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

    <!-- Messages List Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Pesan</h3>
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold border border-primary/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                    Total: {{ $pesan->total() }} pertanyaan
                </span>
            </div>
        </div>

        @if ($pesan->count() > 0)
            <!-- Messages List -->
            <div class="divide-y divide-gray-100">
                @foreach ($pesan as $item)
                    <div class="group relative px-6 py-5 hover:bg-gradient-to-r hover:from-gray-50 hover:to-white transition-all duration-200 {{ $item->status_baca == 'belum' ? 'bg-red-50/40 border-l-4 border-red-500' : 'border-l-4 border-transparent' }}"
                        onclick="showDetail({{ $item->id_kontak }})">
                        <div class="flex items-start gap-5">
                            <!-- Avatar/Icon -->
                            <div class="flex-shrink-0 relative">
                                <div
                                    class="w-14 h-14 rounded-xl {{ $item->status_baca == 'belum' ? 'bg-gradient-to-br from-red-500 to-red-600 shadow-lg shadow-red-500/30' : 'bg-gradient-to-br from-gray-400 to-gray-500 shadow-md' }} flex items-center justify-center transform transition-transform group-hover:scale-105">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                @if ($item->status_baca == 'belum')
                                    <div
                                        class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse">
                                    </div>
                                @endif
                            </div>

                            <!-- Message Content -->
                            <div class="flex-1 min-w-0 cursor-pointer">
                                <!-- Header Row -->
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-1">
                                            <h4
                                                class="text-lg font-bold text-gray-900 {{ $item->status_baca == 'belum' ? 'text-red-900' : '' }}">
                                                {{ $item->nama }}
                                            </h4>
                                            @if ($item->status_baca == 'belum')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-sm">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                                    </svg>
                                                    BARU
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Terbaca
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Email dengan icon -->
                                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-medium">{{ $item->email }}</span>
                                        </div>
                                    </div>

                                    <!-- Time and Actions -->
                                    <div class="flex items-center gap-3 ml-4">
                                        <div class="text-right">
                                            <div class="text-sm font-semibold text-gray-700">
                                                {{ $item->created_at->format('H:i') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                        </div>

                                        <!-- Dropdown Actions -->
                                        <div class="relative" x-data="{ open: false }" @click.stop>
                                            <button @click="open = !open"
                                                class="p-2 hover:bg-gray-100 rounded-lg transition-colors opacity-0 group-hover:opacity-100"
                                                title="Aksi">
                                                <svg class="w-5 h-5 text-gray-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div x-show="open" @click.away="open = false"
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                class="absolute right-0 mt-2 w-56 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden"
                                                style="display: none;">

                                                <div class="py-2">
                                                    <!-- View Detail -->
                                                    <button onclick="showDetail({{ $item->id_kontak }})"
                                                        class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 flex items-center gap-3 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        <div>
                                                            <div class="font-medium">Lihat Detail</div>
                                                            <div class="text-xs text-gray-500">Baca pesan lengkap</div>
                                                        </div>
                                                    </button>

                                                    <!-- Edit -->
                                                    <button onclick="openEditModal({{ $item->id_kontak }})"
                                                        class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-700 flex items-center gap-3 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        <div>
                                                            <div class="font-medium">Edit Pesan</div>
                                                            <div class="text-xs text-gray-500">Ubah informasi pesan
                                                            </div>
                                                        </div>
                                                    </button>

                                                    <div class="border-t border-gray-100 my-1"></div>

                                                    <!-- Delete -->
                                                    <button
                                                        onclick="confirmDelete({{ $item->id_kontak }}, '{{ $item->nama }}', '{{ $item->email }}')"
                                                        class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center gap-3 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <div>
                                                            <div class="font-medium">Hapus Pesan</div>
                                                            <div class="text-xs text-red-400">Tidak dapat dikembalikan
                                                            </div>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Subject (if exists) -->
                                @if ($item->subjek)
                                    <div class="mb-2 flex items-start gap-2">
                                        <svg class="w-4 h-4 text-gray-400 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <span
                                            class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $item->subjek }}</span>
                                    </div>
                                @endif

                                <!-- Message Preview -->
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">
                                        {{ $item->pesan }}
                                    </p>
                                </div>

                                <!-- Footer Info -->
                                <div class="flex items-center gap-4 flex-wrap">
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-lg">
                                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span
                                            class="text-xs font-mono font-medium text-gray-700">{{ $item->kode_kontak }}</span>
                                    </div>

                                    <div class="inline-flex items-center gap-2 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                {{ $pesan->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-red-100 to-red-200 mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesan</h3>
                <p class="text-sm text-gray-500 mb-6">Pesan dari pengunjung website akan muncul di sini</p>
                <button onclick="openCreateModal()"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Pesan Baru
                </button>
            </div>
        @endif
    </div>

    <!-- Modals -->
    @include('admin.pesan.modals.create')
    @include('admin.pesan.modals.detail')
    @include('admin.pesan.modals.edit')
    @include('admin.pesan.modals.delete')

    <!-- Scripts -->
    @include('admin.pesan.scripts')
</x-layouts.app>
