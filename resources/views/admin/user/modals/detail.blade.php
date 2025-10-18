<!-- Detail User Modal -->
<div id="detailModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div
        class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 scale-95 opacity-0">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/10 p-2 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Detail Pengguna</h3>
            </div>
            <button onclick="closeDetailModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-8" id="detailContent">
            <!-- Loading State -->
            <div id="detailLoading" class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>

            <!-- Content -->
            <div id="detailData" class="hidden space-y-6">
                <!-- Avatar -->
                <div class="flex justify-center mb-6">
                    <div
                        class="w-24 h-24 bg-primary text-white rounded-full flex items-center justify-center text-4xl font-bold shadow-lg">
                        <span id="detail_avatar"></span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Nama -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_nama"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_email"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <span id="detail_status"></span>
                            </div>
                        </div>
                    </div>

                    <!-- ID User -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ID User</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_id"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Terakhir Aktif -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Terakhir Aktif</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_terakhir_aktif"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Dibuat Pada</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_created_at"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Updated At -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Terakhir Diupdate</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                            </div>
                            <div
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg bg-gray-50 text-gray-900">
                                <p class="text-sm font-medium" id="detail_updated_at"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="flex justify-end gap-3 px-6 py-4 border-t">
                    <button type="button" onclick="closeDetailModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
