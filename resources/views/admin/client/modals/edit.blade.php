<!-- Modal Edit Client -->
<div id="editModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="editModalContent"
        class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div
            class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-yellow-500/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Edit Client</h3>
            </div>
            <button onclick="closeEditModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="editClientForm" onsubmit="submitEdit(event)" class="p-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="edit_id" name="id">
            <input type="hidden" id="edit_logo_path" name="old_logo">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kategori -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_kategori_id" class="block text-sm font-semibold text-gray-700">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <select id="edit_kategori_id" name="kategori_id"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg focus:ring-0 focus:ring-yellow-500 focus:border-yellow-500 transition-all appearance-none bg-white">
                            <option value="">Pilih kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p id="error_edit_kategori_id" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Nama Client -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_nama_client" class="block text-sm font-semibold text-gray-700">
                        Nama Client <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_nama_client" name="nama_client"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg focus:ring-0 focus:ring-yellow-500 focus:border-yellow-500 transition-all"
                            placeholder="Masukkan nama client">
                    </div>
                    <p id="error_edit_nama_client" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Logo -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_logo" class="block text-sm font-semibold text-gray-700">Logo</label>

                    <div id="editLogoUploadArea" class="flex items-center justify-center w-full">
                        <label for="edit_logo"
                            class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                <p class="text-xs text-gray-500">(PNG, JPG, GIF | MAX. 10MB)</p>
                            </div>
                            <input id="edit_logo" name="logo" type="file" class="hidden" accept="image/*"
                                onchange="previewEditLogo(event)" />
                        </label>
                    </div>

                    <div id="editLogoPreviewArea" class="hidden w-full">
                        <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0">
                                    <img id="editLogoPreviewImg"
                                        class="w-16 h-16 object-cover rounded-lg border border-gray-200" src=""
                                        alt="Preview logo">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p id="editLogoFileName" class="text-sm font-medium text-gray-900 truncate"></p>
                                    <p id="editLogoFileSize" class="text-xs text-gray-500"></p>
                                </div>
                                <div class="flex items-center gap-2 flex-shrink-0">
                                    <button type="button" onclick="changeEditLogo()"
                                        class="px-3 py-1 text-xs font-medium text-yellow-600 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                                        Ganti
                                    </button>
                                    <button type="button" onclick="removeEditLogo()"
                                        class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p id="error_edit_logo" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Website -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_website" class="block text-sm font-semibold text-gray-700">Website</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <input type="url" id="edit_website" name="website"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none border-gray-300 rounded-lg focus:ring-0 focus:ring-yellow-500 focus:border-yellow-500 transition-all"
                            placeholder="https://example.com">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_deskripsi" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-0 focus:ring-yellow-500 focus:border-yellow-500 transition-all resize-none"
                        placeholder="Masukkan deskripsi client"></textarea>
                </div>

                <!-- Status -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_status" class="block text-sm font-semibold text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="edit_status" name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-0 focus:ring-yellow-500 focus:border-yellow-500 transition-all bg-white">
                        <option value="publik">Publik</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeEditModal()"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
                    Batal
                </button>
                <button type="submit" id="editSubmitBtn"
                    class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
                    <svg id="editLoadingSpinner"
                        class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span id="editSubmitBtnText">Update Client</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewEditLogo(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('editLogoUploadArea').classList.add('hidden');
            document.getElementById('editLogoPreviewArea').classList.remove('hidden');

            document.getElementById('editLogoPreviewImg').src = e.target.result;
            document.getElementById('editLogoFileName').textContent = file.name;
            document.getElementById('editLogoFileSize').textContent = formatFileSize(file.size);
        }

        reader.readAsDataURL(file);
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function changeEditLogo() {
    document.getElementById('edit_logo').click();
}

function removeEditLogo() {
    const fileInput = document.getElementById('edit_logo');
    fileInput.value = '';
    document.getElementById('editLogoPreviewArea').classList.add('hidden');
    document.getElementById('editLogoUploadArea').classList.remove('hidden');
    document.getElementById('editLogoPreviewImg').src = '';
    document.getElementById('editLogoFileName').textContent = '';
    document.getElementById('editLogoFileSize').textContent = '';
}

// Drag & Drop upload
document.addEventListener('DOMContentLoaded', () => {
    const uploadLabel = document.querySelector('#editLogoUploadArea label');
    const fileInput = document.getElementById('edit_logo');
    if (!uploadLabel) return;

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
        uploadLabel.addEventListener(e, ev => { ev.preventDefault(); ev.stopPropagation(); }, false);
    });

    uploadLabel.addEventListener('dragenter', () => uploadLabel.classList.add('border-yellow-500', 'bg-yellow-50'));
    uploadLabel.addEventListener('dragleave', () => uploadLabel.classList.remove('border-yellow-500', 'bg-yellow-50'));
    uploadLabel.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        fileInput.dispatchEvent(new Event('change'));
        uploadLabel.classList.remove('border-yellow-500', 'bg-yellow-50');
    });
});
</script>
