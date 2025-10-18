<!-- Modal Edit Testimoni -->
<div id="editTestimoniModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="editTestimoniModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
        
        <!-- Modal Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-amber-100 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Edit Testimoni</h3>
            </div>
            <button onclick="closeEditTestimoniModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="editTestimoniForm" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id_testimoni" name="id_testimoni">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nama Testimoni -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_nama_testimoni" class="block text-sm font-semibold text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_nama_testimoni" name="nama_testimoni" 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none" 
                            placeholder="Masukkan nama lengkap">
                    </div>
                    <p id="error-edit-nama_testimoni" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Jabatan -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_jabatan" class="block text-sm font-semibold text-gray-700">
                        Jabatan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_jabatan" name="jabatan" 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none" 
                            placeholder="Contoh: CEO, Manager, dll">
                    </div>
                    <p id="error-edit-jabatan" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Pesan Testimoni -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_pesan" class="block text-sm font-semibold text-gray-700">
                        Pesan Testimoni <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <textarea id="edit_pesan" name="pesan" rows="4"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none resize-none" 
                            placeholder="Masukkan pesan testimoni"></textarea>
                    </div>
                    <p id="error-edit-pesan" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Rating -->
                <div class="space-y-2">
                    <label for="edit_rating" class="block text-sm font-semibold text-gray-700">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <select id="edit_rating" name="rating" 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none appearance-none bg-white">
                            <option value="">Pilih Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                            <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                            <option value="3">⭐⭐⭐ (3 Bintang)</option>
                            <option value="2">⭐⭐ (2 Bintang)</option>
                            <option value="1">⭐ (1 Bintang)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p id="error-edit-rating" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="edit_status" class="block text-sm font-semibold text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <select id="edit_status" name="status" 
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none appearance-none bg-white">
                            <option value="publik">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <p id="error-edit-status" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Foto -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_foto" class="block text-sm font-semibold text-gray-700">
                        Foto
                    </label>
                    <div class="relative">
                        <div id="editTestimoniUploadArea" class="flex items-center justify-center w-full">
                            <label for="edit_foto"
                                class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                    <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload foto baru</span> atau drag & drop</p>
                                    <p class="text-xs text-gray-500">(PNG, JPG, GIF | MAX. 10MB)</p>
                                </div>
                                <input type="file" id="edit_foto" name="foto" accept="image/*" class="hidden" onchange="previewEditImage(event)">
                            </label>
                        </div>

                        <div id="editTestimoniPreviewArea" class="hidden w-full">
                            <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <img id="editPreviewImg" src="" alt="Preview gambar" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p id="editTestimoniFileName" class="text-sm font-medium text-gray-900 truncate"></p>
                                        <p id="editTestimoniFileSize" class="text-xs text-gray-500"></p>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <button type="button" onclick="changeEditTestimoniImage()" class="px-3 py-1 text-xs font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                                            Ganti
                                        </button>
                                        <button type="button" onclick="removeEditTestimoniImage()" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p id="error-edit-foto" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeEditTestimoniModal()" 
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
                    Batal
                </button>
                <button type="submit" id="editTestimoniSubmitBtn"
                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
                    <svg id="editTestimoniLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="editTestimoniSubmitBtnText">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function closeEditTestimoniModal() {
    const modal = document.getElementById('editTestimoniModal');
    const modalContent = document.getElementById('editTestimoniModalContent');

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

function previewEditImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('editTestimoniUploadArea').classList.add('hidden');
            document.getElementById('editTestimoniPreviewArea').classList.remove('hidden');

            document.getElementById('editPreviewImg').src = e.target.result;
            document.getElementById('editTestimoniFileName').textContent = file.name;
            document.getElementById('editTestimoniFileSize').textContent = formatEditTestimoniFileSize(file.size);
        }

        reader.readAsDataURL(file);
    }
}

function formatEditTestimoniFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function changeEditTestimoniImage() {
    document.getElementById('edit_foto').click();
}

function removeEditTestimoniImage() {
    document.getElementById('edit_foto').value = '';

    document.getElementById('editTestimoniPreviewArea').classList.add('hidden');
    document.getElementById('editTestimoniUploadArea').classList.remove('hidden');

    document.getElementById('editPreviewImg').src = '';
    document.getElementById('editTestimoniFileName').textContent = '';
    document.getElementById('editTestimoniFileSize').textContent = '';
}

// Drag and drop functionality for edit modal
document.addEventListener('DOMContentLoaded', function() {
    const editUploadLabel = document.querySelector('#editTestimoniUploadArea label');
    const editFileInput = document.getElementById('edit_foto');

    if (editUploadLabel) {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            editUploadLabel.addEventListener(eventName, preventEditDefaults, false);
        });

        // Highlight drop area when item is dragged over it
        editUploadLabel.addEventListener('dragenter', highlightEdit, false);
        editUploadLabel.addEventListener('dragover', highlightEdit, false);

        editUploadLabel.addEventListener('dragleave', unhighlightEdit, false);
        editUploadLabel.addEventListener('drop', unhighlightEdit, false);

        // Handle dropped files
        editUploadLabel.addEventListener('drop', handleEditDrop, false);
    }

    function preventEditDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlightEdit() {
        editUploadLabel.classList.add('border-primary', 'bg-primary/5');
    }

    function unhighlightEdit() {
        editUploadLabel.classList.remove('border-primary', 'bg-primary/5');
    }

    function handleEditDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        editFileInput.files = files;
        // Trigger the change event manually
        const event = new Event('change');
        editFileInput.dispatchEvent(event);
    }
});
</script>
