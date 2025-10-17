<div id="editModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div
        class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <div class="bg-yellow-500/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Edit Client</h3>
            </div>
            <button onclick="closeEditModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="editClientForm" onsubmit="submitEdit(event)" class="p-8">
            <input type="hidden" id="edit_id" name="id">
            <input type="hidden" id="edit_logo_path" name="old_logo">

            <!-- Loading State -->
            <div id="editLoading" class="p-12 hidden">
                <div class="flex flex-col items-center justify-center">
                    <svg class="animate-spin h-12 w-12 text-primary mb-4" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <p class="text-gray-600 text-sm">Memuat data client...</p>
                </div>
            </div>

            <div id="editFormContent" class="hidden">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label for="edit_kategori_id" class="block text-sm font-semibold text-gray-700 mb-1">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <select id="edit_kategori_id" name="kategori_id" required
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition bg-white appearance-none">
                                <option value="">Pilih kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_kategori_id"></span>
                    </div>

                    <!-- Nama Client -->
                    <div>
                        <label for="edit_nama_client" class="block text-sm font-semibold text-gray-700 mb-1">
                            Nama Client <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <input type="text" id="edit_nama_client" name="nama_client" required
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition"
                                placeholder="Masukkan nama client">
                        </div>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_nama_client"></span>
                    </div>

                    <!-- Logo Current & Upload -->
                    <div>
                        <label for="edit_logo" class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
                        <div id="edit_current_logo" class="mb-3 hidden">
                            <p class="text-xs text-gray-500 mb-2">Logo saat ini:</p>
                            <img src="" alt="Current Logo" class="h-32 w-32 object-cover rounded-lg border">
                        </div>
                        <input type="file" id="edit_logo" name="logo" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition"
                            onchange="previewImage(event, 'edit')">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB) - Kosongkan jika tidak ingin mengubah</p>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_logo"></span>
                        <div id="edit_logo_preview" class="mt-3 hidden">
                            <p class="text-xs text-gray-500 mb-2">Preview logo baru:</p>
                            <img src="" alt="Preview" class="h-32 w-32 object-cover rounded-lg border">
                        </div>
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="edit_website" class="block text-sm font-semibold text-gray-700 mb-1">Website</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                            </div>
                            <input type="url" id="edit_website" name="website"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition"
                                placeholder="https://example.com">
                        </div>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_website"></span>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="edit_deskripsi" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition"
                            placeholder="Masukkan deskripsi client"></textarea>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_deskripsi"></span>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="edit_status" class="block text-sm font-semibold text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <select id="edit_status" name="status" required
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition bg-white appearance-none">
                                <option value="publik">Publik</option>
                                <option value="draft">Draft</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_status"></span>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()"
                        class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold">
                        Batal
                    </button>
                    <button type="submit" id="editSubmitBtn"
                        class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-semibold">
                        Update Client
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
