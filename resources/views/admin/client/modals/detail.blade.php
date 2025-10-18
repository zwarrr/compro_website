<div id="detailModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="detailModalContent"
        class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        
        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-blue-500/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Detail Client</h3>
            </div>
            <button onclick="closeDetailModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-6">
            <x-loading/>
            <div id="detailData" class="hidden space-y-6">
                <!-- Logo -->
                <div class="flex justify-center mb-6" id="detail_logo_container">
                    <img src="" alt="Logo Client" id="detail_logo" class="h-32 w-32 rounded-lg object-cover border border-gray-200">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">ID Client</label>
                        <p class="text-base font-medium text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_id"></p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Kode Client</label>
                        <p class="text-base font-medium text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_kode"></p>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Nama Client</label>
                    <p class="text-base font-medium text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_nama_client"></p>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Kategori</label>
                    <p class="text-base font-medium text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_kategori"></p>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Website</label>
                    <p class="text-base text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_website"></p>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <p class="text-base text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200 min-h-[100px]" id="detail_deskripsi"></p>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Status</label>
                    <p class="text-base font-medium text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_status"></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-200">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Dibuat Pada</label>
                        <p class="text-sm text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_created_at"></p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Terakhir Diubah</label>
                        <p class="text-sm text-gray-900 px-4 py-3 bg-gray-50 rounded-lg border border-gray-200" id="detail_updated_at"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-6 pb-6 pt-0">
            <button onclick="closeDetailModal()"
                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
                Tutup
            </button>
        </div>
    </div>
</div>
