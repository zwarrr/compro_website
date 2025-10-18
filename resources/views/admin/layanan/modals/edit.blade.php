<div id="editLayananModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
    <div id="editModalContent"
        class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">

        <!-- Header -->
        <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="bg-amber-600/10 p-2 rounded-lg">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Edit Layanan</h3>
            </div>
            <button onclick="closeEditLayananModal()"
                class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-2 hover:bg-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Loading State -->
        <div id="editLoading" class="p-12">
            <div class="flex flex-col items-center justify-center">
                <svg class="animate-spin h-12 w-12 text-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <p class="text-gray-600 text-sm">Memuat data layanan...</p>
            </div>
        </div>

        <!-- Form Content -->
        <form id="editLayananForm" onsubmit="submitEditLayanan(event)" class="p-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_layanan" id="edit_id_layanan">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kode Layanan -->
                <div class="space-y-2">
                    <label for="edit_kode_layanan" class="block text-sm font-semibold text-gray-700">
                        Kode Layanan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <input type="text" id="edit_kode_layanan" name="kode_layanan"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none bg-gray-50 cursor-not-allowed"
                            readonly>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_kode_layanan"></span>
                </div>

                <!-- Kategori -->
                <div class="space-y-2">
                    <label for="edit_kategori_id" class="block text-sm font-semibold text-gray-700">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <select id="edit_kategori_id" name="kategori_id"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none appearance-none bg-white">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $item)
                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_kategori_id"></span>
                </div>

                <!-- Judul Layanan -->
                <div class="space-y-2">
                    <label for="edit_judul" class="block text-sm font-semibold text-gray-700">
                        Judul Layanan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_judul" name="judul"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                            placeholder="Masukkan judul layanan">
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_judul"></span>
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
                            <option value="">Pilih Status</option>
                            <option value="publik">Publik</option>
                            <option value="draft">Draft</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_status"></span>
                </div>

                <!-- Slogan -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_slog" class="block text-sm font-semibold text-gray-700">
                        Slogan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <input type="text" id="edit_slog" name="slog"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                            placeholder="Masukkan slogan layanan">
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_slog"></span>
                </div>

                <!-- Deskripsi -->
                <div class="space-y-2 md:col-span-2">
                    <label for="edit_deskripsi" class="block text-sm font-semibold text-gray-700">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </div>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="4"
                            class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none resize-none"
                            placeholder="Masukkan deskripsi layanan"></textarea>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_deskripsi"></span>
                </div>

                <!-- Gambar -->
                <div class="md:col-span-2 space-y-2">
                    <label for="edit_gambar" class="block text-sm font-semibold text-gray-700">
                        Gambar (opsional)
                    </label>
                    
                    <!-- Preview Gambar Existing -->
                    <div id="edit_existing_image" class="mb-4 hidden">
                        <p class="text-sm text-gray-600 mb-3 font-medium">Gambar saat ini:</p>
                        <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <img id="edit_gambar_preview" src="" alt="Preview"
                                class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">Gambar saat ini</p>
                                <p class="text-xs text-gray-500">Klik ganti untuk mengubah gambar</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div id="edit_uploadArea" class="flex items-center justify-center w-full">
                            <label for="edit_gambar" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                    <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                    <p class="text-xs text-gray-500">(PNG, JPG, GIF | MAX. 10MB)</p>
                                </div>
                                <input id="edit_gambar" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewEditImage(this)" />
                            </label>
                        </div>

                        <div id="edit_previewArea" class="hidden w-full">
                            <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <img id="edit_imagePreview" class="w-16 h-16 object-cover rounded-lg border border-gray-200" src="" alt="Preview gambar">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p id="edit_fileName" class="text-sm font-medium text-gray-900 truncate"></p>
                                        <p id="edit_fileSize" class="text-xs text-gray-500"></p>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <button type="button" onclick="changeEditImage()" class="px-3 py-1 text-xs font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                                            Ganti
                                        </button>
                                        <button type="button" onclick="removeEditImage()" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="text-red-500 text-xs mt-1 hidden" id="error_gambar"></span>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" onclick="closeEditLayananModal()"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
                    Batal
                </button>
                <button type="submit" id="editSubmitBtn"
                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
                    <svg id="editLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span id="editSubmitBtnText">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function closeEditLayananModal() {
    const modal = document.getElementById('editLayananModal');
    const modalContent = document.getElementById('editModalContent');

    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        // Reset form when closing
        document.getElementById('editLayananForm').reset();
        removeEditImage();
        document.getElementById('edit_existing_image').classList.add('hidden');
    }, 300);
}

function submitEditLayanan(event) {
    event.preventDefault();
    // Logic untuk submit data layanan
    console.log('Form edit submitted');
}

function previewEditImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('edit_uploadArea').classList.add('hidden');
            document.getElementById('edit_previewArea').classList.remove('hidden');
            
            document.getElementById('edit_imagePreview').src = e.target.result;
            document.getElementById('edit_fileName').textContent = file.name;
            document.getElementById('edit_fileSize').textContent = formatFileSize(file.size);
        }
        
        reader.readAsDataURL(file);
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function changeEditImage() {
    document.getElementById('edit_gambar').click();
}

function removeEditImage() {
    document.getElementById('edit_gambar').value = '';
    
    document.getElementById('edit_previewArea').classList.add('hidden');
    document.getElementById('edit_uploadArea').classList.remove('hidden');
    
    document.getElementById('edit_imagePreview').src = '';
    document.getElementById('edit_fileName').textContent = '';
    document.getElementById('edit_fileSize').textContent = '';
}

// Fungsi untuk menampilkan gambar existing saat modal edit dibuka
function showExistingImage(imageUrl) {
    if (imageUrl) {
        document.getElementById('edit_existing_image').classList.remove('hidden');
        document.getElementById('edit_gambar_preview').src = imageUrl;
    } else {
        document.getElementById('edit_existing_image').classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Target label for drag/drop, memastikan elemennya ada sebelum listener ditambahkan
    const uploadLabel = document.querySelector('#edit_uploadArea label'); 
    const fileInput = document.getElementById('edit_gambar');
    
    if (uploadLabel) {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadLabel.addEventListener(eventName, preventDefaults, false);
        });
        document.body.addEventListener('dragover', preventDefaults, false);
        document.body.addEventListener('drop', preventDefaults, false);
        
        // Highlight drop area when item is dragged over it
        uploadLabel.addEventListener('dragenter', highlight, false);
        uploadLabel.addEventListener('dragover', highlight, false);
        
        uploadLabel.addEventListener('dragleave', unhighlight, false);
        uploadLabel.addEventListener('drop', unhighlight, false);
        
        // Handle dropped files
        uploadLabel.addEventListener('drop', handleDrop, false);
    }
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight() {
        uploadLabel.classList.add('border-primary', 'bg-primary/5');
    }
    
    function unhighlight() {
        uploadLabel.classList.remove('border-primary', 'bg-primary/5');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        previewEditImage(fileInput);
    }
});
</script>