<div id="createModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="createModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        
        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-primary/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Tambah Pesan</h3>
            </div>
            <button onclick="closeCreateModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form Content -->
        <form id="createPesanForm" class="p-6"  enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
                <!-- Nama -->
                <div class="space-y-2 md:col-span-2">
                    <label for="create_nama" class="block text-sm font-semibold text-gray-700">
                        Nama Pengirim <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="create_nama" name="nama"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                            placeholder="Masukkan nama pengirim" required>
                    </div>
                    <p id="error-nama" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Email -->
                <div class="space-y-2 md:col-span-2">
                    <label for="create_email" class="block text-sm font-semibold text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="create_email" name="email"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                            placeholder="contoh@email.com" required>
                    </div>
                    <p id="error-email" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Subjek -->
                <div class="space-y-2 md:col-span-2">
                    <label for="create_subjek" class="block text-sm font-semibold text-gray-700">
                        Subjek
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <input type="text" id="create_subjek" name="subjek"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                            placeholder="Masukkan subjek pesan">
                    </div>
                    <p id="error-subjek" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Pesan -->
                <div class="space-y-2 md:col-span-2">
                    <label for="create_pesan" class="block text-sm font-semibold text-gray-700">
                        Pesan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <textarea id="create_pesan" name="pesan" rows="4"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all resize-none"
                            placeholder="Tulis pesan di sini..." required></textarea>
                    </div>
                    <p id="error-pesan" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Status Baca -->
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Status Baca <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-6">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status_baca" value="belum" checked
                                class="w-4 h-4 text-primary focus:ring-2 focus:ring-primary">
                            <span class="ml-2 text-sm text-gray-700 group-hover:text-gray-900">Belum Dibaca</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status_baca" value="sudah"
                                class="w-4 h-4 text-primary focus:ring-2 focus:ring-primary">
                            <span class="ml-2 text-sm text-gray-700 group-hover:text-gray-900">Sudah Dibaca</span>
                        </label>
                    </div>
                    <p id="error-status_baca" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeCreateModal()"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
                    Batal
                </button>
                <button type="submit" id="createPesanSubmitBtn"
                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
                    <svg id="createPesanLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="createPesanSubmitBtnText">Simpan Pesan</span>
                </button>
            </div>
        </form>
    </div>
</div>
