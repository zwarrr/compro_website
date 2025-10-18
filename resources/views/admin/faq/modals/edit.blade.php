<div id="editModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-yellow-500/10 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Edit FAQ</h3>
            </div>
            <button onclick="closeEditModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Loading -->
            <div id="editLoading">
                <x-loading/>
            </div>

            <!-- Form -->
            <form id="editFaqForm" class="hidden space-y-6">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id_faq" name="id_faq">

                <!-- Kode FAQ (Read Only) -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Kode FAQ</label>
                    <p class="text-base font-mono font-bold text-gray-900" id="edit_kode_faq_display"></p>
                </div>

                <!-- Pertanyaan -->
                <div>
                    <label for="edit_pertanyaan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_pertanyaan" name="pertanyaan"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                            placeholder="Masukkan pertanyaan" required>
                    </div>
                    <span class="text-red-500 text-sm hidden error-message" id="error_edit_pertanyaan"></span>
                </div>

                <!-- Jawaban -->
                <div>
                    <label for="edit_jawaban" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jawaban <span class="text-red-500">*</span>
                    </label>
                    <textarea id="edit_jawaban" name="jawaban" rows="8"
                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                        placeholder="Tulis jawaban lengkap di sini..." required></textarea>
                    <span class="text-red-500 text-sm hidden error-message" id="error_edit_jawaban"></span>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-4">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status" value="publik" id="edit_status_publik"
                                class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-gray-900">Publik</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status" value="draft" id="edit_status_draft"
                                class="w-4 h-4 text-primary">
                            <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-gray-900">Draft</span>
                        </label>
                    </div>
                    <span class="text-red-500 text-sm hidden error-message" id="error_edit_status"></span>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-primary to-red-700 text-white rounded-lg hover:from-red-700 hover:to-primary transition-all font-semibold shadow-lg hover:shadow-xl flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
