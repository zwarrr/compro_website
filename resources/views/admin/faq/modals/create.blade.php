<!-- Modal Create FAQ -->
<div id="createModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div
        class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div
            class="ticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-primary/10 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Tambah FAQ Baru</h3>
            </div>
            <button type="button" onclick="closeCreateModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <form id="createFaqForm" class="p-8 space-y-6">
            @csrf

            <!-- Pertanyaan -->
            <div>
                <label for="create_pertanyaan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="text" id="create_pertanyaan" name="pertanyaan"
                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                        placeholder="Contoh: Bagaimana cara menghubungi customer service?" required>
                </div>
                <span class="text-red-500 text-sm hidden error-message" id="error_create_pertanyaan"></span>
            </div>

            <!-- Jawaban -->
            <div>
                <label for="create_jawaban" class="block text-sm font-semibold text-gray-700 mb-2">
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea id="create_jawaban" name="jawaban" rows="8"
                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                    placeholder="Tulis jawaban lengkap dan detail di sini..." required></textarea>
                <span class="text-red-500 text-sm hidden error-message" id="error_create_jawaban"></span>
                <p class="text-xs text-gray-500 mt-1">Berikan jawaban yang jelas dan mudah dipahami</p>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Status <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-6">
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="status" value="publik" checked
                            class="w-4 h-4 text-primary">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Publik</span>
                            <p class="text-xs text-gray-500">Ditampilkan di website</p>
                        </div>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="status" value="draft"
                            class="w-4 h-4 text-primary">
                        <div class="ml-3">
                            <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Draft</span>
                            <p class="text-xs text-gray-500">Disembunyikan sementara</p>
                        </div>
                    </label>
                </div>
                <span class="text-red-500 text-sm hidden error-message" id="error_create_status"></span>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeCreateModal()"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-primary to-red-700 text-white rounded-lg hover:from-red-700 hover:to-primary transition-all font-semibold shadow-lg hover:shadow-xl flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah FAQ
                </button>
            </div>
        </form>
    </div>
</div>
