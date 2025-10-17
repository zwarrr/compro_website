<div id="createModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="createModalContent"
        class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 scale-95 opacity-0">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="bg-primary/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Tambah Kategori Baru</h3>
            </div>
            <button onclick="closeCreateModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="createKategoriForm" onsubmit="submitCreate(event)" class="p-8">
            <div class="grid grid-cols-1 gap-6">

                <div>
                    <label for="create_nama_kategori" class="block text-sm font-semibold text-gray-700 mb-1">Nama
                        Kategori</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                </path>
                            </svg>
                        </div>
                        <input type="text" id="create_nama_kategori" name="nama_kategori"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_nama_kategori"></span>
                </div>

                <div>
                    <label for="create_tipe" class="block text-sm font-semibold text-gray-700 mb-1">
                        Tipe <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <!-- Icon kiri -->
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </div>

                        <!-- Dropdown -->
                        <select id="create_tipe" name="tipe" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition bg-white appearance-none">
                            <option value="" disabled selected>Pilih tipe</option>
                            <option value="layanan">Layanan</option>
                            <option value="galeri">Galeri</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="client">Klien</option>
                        </select>

                        <!-- Icon panah kanan -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_create_tipe"></span>
                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeCreateModal()"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
                    Batal
                </button>
                <button type="submit" id="createSubmitBtn"
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors font-semibold flex items-center gap-2">
                    <svg id="loadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span id="createSubmitBtnText">Simpan Kategori</span>
                </button>
            </div>
        </form>
    </div>
</div>
