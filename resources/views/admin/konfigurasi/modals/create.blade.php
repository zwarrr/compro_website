<div id="createProfileModal"
     class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <div class="bg-primary/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Buat Profile Perusahaan</h3>
            </div>
            <button onclick="closeCreateProfileModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="createProfileForm" onsubmit="submitCreateProfile(event)" class="p-6 space-y-4">
            @csrf

            <!-- Informasi Umum -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="nama_perusahaan" class="block text-sm font-semibold text-gray-700 mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                    <input id="nama_perusahaan" name="nama_perusahaan" type="text" placeholder="cth. PT Maju Jaya Abadi"
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none">
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_nama_perusahaan"></span>
                </div>
                <div class="md:col-span-2">
                    <label for="slogan" class="block text-sm font-semibold text-gray-700 mb-2">Slogan</label>
                    <input id="slogan" name="slogan" type="text" placeholder="cth. Solusi Tepat untuk Bisnis Anda"
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none">
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_slogan"></span>
                </div>
            </div>

            <!-- Konten Perusahaan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Gambarkan perusahaan Anda secara singkat..."
                              class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"></textarea>
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_deskripsi"></span>
                </div>
                <div>
                    <label for="visi" class="block text-sm font-semibold text-gray-700 mb-2">Visi</label>
                    <textarea id="visi" name="visi" rows="3" placeholder="Visi perusahaan..."
                              class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"></textarea>
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_visi"></span>
                </div>
                <div>
                    <label for="misi" class="block text-sm font-semibold text-gray-700 mb-2">Misi</label>
                    <textarea id="misi" name="misi" rows="3" placeholder="Misi perusahaan..."
                              class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"></textarea>
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_misi"></span>
                </div>
            </div>

            <!-- Kontak & Alamat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap perusahaan..."
                              class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"></textarea>
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_alamat"></span>
                </div>
                <div>
                    <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">Telepon</label>
                    <input id="telepon" name="telepon" type="tel" placeholder="cth. 0812-3456-7890"
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none">
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_telepon"></span>
                </div>
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input id="email" name="email" type="email" placeholder="cth. info@perusahaan.com"
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none">
                    <span class="text-xs text-red-500 mt-1 hidden" id="error_email"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <button type="button" onclick="closeCreateProfileModal()"
                        class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">Batal</button>
                <button type="submit" id="createSubmitBtn"
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 hidden" id="createLoadingSpinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="createSubmitBtnText">Buat Profile</span>
                </button>
            </div>
        </form>
    </div>
</div>
