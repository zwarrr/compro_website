<div id="detailProfileModal"
     class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Detail Profil Perusahaan</h3>
            </div>
            <button onclick="closeDetailProfileModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Kode Profile</label>
                    <p class="text-sm font-medium text-gray-800" id="detail_kode_profile">-</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Nama Perusahaan</label>
                    <p class="text-sm font-medium text-gray-800" id="detail_nama_perusahaan">-</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Slogan</label>
                    <p class="text-sm text-gray-800" id="detail_slogan">-</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Deskripsi</label>
                <p class="text-sm text-gray-800 whitespace-pre-line" id="detail_deskripsi">-</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Visi</label>
                    <p class="text-sm text-gray-800 whitespace-pre-line" id="detail_visi">-</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Misi</label>
                    <p class="text-sm text-gray-800 whitespace-pre-line" id="detail_misi">-</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Alamat</label>
                    <p class="text-sm text-gray-800 whitespace-pre-line" id="detail_alamat">-</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Telepon</label>
                    <p class="text-sm text-gray-800" id="detail_telepon">-</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="text-xs font-semibold text-gray-500 uppercase mb-1 block">Email</label>
                    <p class="text-sm text-gray-800" id="detail_email">-</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl flex justify-end">
            <button onclick="closeDetailProfileModal()" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">Tutup</button>
        </div>
    </div>
</div>
