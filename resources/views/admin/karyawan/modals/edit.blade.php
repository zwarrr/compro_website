<div id="editKaryawanModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-amber-600/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Edit Karyawan</h3>
      </div>
      <button onclick="closeEditKaryawanModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form id="editKaryawanForm" onsubmit="submitEditKaryawan(event)" class="p-6" enctype="multipart/form-data">
      <input type="hidden" id="edit_karyawan_id" name="id">

      <div id="karyawanEditLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-amber-600"></div>
      </div>

      <div id="editKaryawanFormContent" class="hidden">
        <!-- Foto Preview (dipindahkan ke atas) -->
        <div class="space-y-2 mb-6">
          <label class="block text-sm font-semibold text-gray-700">Foto Saat Ini</label>
          <div class="flex justify-center">
            <img id="current_foto_preview" class="max-h-[200px] rounded-lg border border-gray-200 shadow-sm object-contain" />
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

          <!-- Kategori -->
          <div class="space-y-2">
            <label for="edit_kategori_id" class="block text-sm font-semibold text-gray-700">
              Kategori <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </div>
              <select id="edit_kategori_id" name="kategori_id" required
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none appearance-none bg-white">
                <option value="" disabled>Pilih kategori</option>
                @foreach($kategoris as $k)
                  <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_kategori_id"></span>
          </div>

          <!-- NIK -->
          <div class="space-y-2">
            <label for="edit_nik" class="block text-sm font-semibold text-gray-700">
              NIK <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                </svg>
              </div>
              <input type="text" id="edit_nik" name="nik"
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                placeholder="Masukkan NIK">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_nik"></span>
          </div>

          <!-- Nama -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_nama" class="block text-sm font-semibold text-gray-700">
              Nama <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <input type="text" id="edit_nama" name="nama"
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none"
                placeholder="Masukkan nama">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_nama"></span>
          </div>

          <!-- Deskripsi -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_deskripsi" class="block text-sm font-semibold text-gray-700">
              Deskripsi
            </label>
            <div class="relative">
              <div class="absolute top-3 left-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
              </div>
              <textarea id="edit_deskripsi" name="deskripsi" rows="3"
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none resize-none"
                placeholder="Masukkan deskripsi karyawan (opsional)"></textarea>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_deskripsi"></span>
          </div>

          <!-- Status -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_status" class="block text-sm font-semibold text-gray-700">
              Status <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <select id="edit_status" name="status" required
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:border-red-500 transition-all outline-none appearance-none bg-white">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_status"></span>
          </div>

          <!-- Foto -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_foto" class="block text-sm font-semibold text-gray-700">
              Foto <span class="text-xs text-gray-500">(Kosongkan jika tidak ingin diganti)</span>
            </label>
            <div class="relative">
              <div id="edit_foto_dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 transition-all hover:border-primary cursor-pointer">
                <input type="file" id="edit_foto" name="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="text-center" id="edit_foto_placeholder">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  <p class="mt-1 text-sm text-gray-600">Klik atau seret foto ke area ini</p>
                  <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (Maks. 10MB)</p>
                </div>
                <div id="edit_foto_preview_container" class="hidden">
                  <div class="relative">
                    <img id="edit_foto_preview" class="mx-auto max-h-48 rounded-lg" src="" alt="Preview">
                    <div class="absolute top-0 right-0 flex space-x-1 p-1">
                      <button type="button" id="edit_foto_change" class="bg-gray-800 bg-opacity-50 hover:bg-opacity-70 rounded-full p-1.5 text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                      </button>
                      <button type="button" id="edit_foto_remove" class="bg-red-500 bg-opacity-50 hover:bg-opacity-70 rounded-full p-1.5 text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  <p id="edit_foto_name" class="text-center text-sm text-gray-500 mt-2 truncate"></p>
                  <p id="edit_foto_size" class="text-center text-xs text-gray-500"></p>
                </div>
              </div>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_karyawan_foto"></span>
          </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
          <button type="button" onclick="closeEditKaryawanModal()" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">Batal</button>
          <button type="submit" id="editKaryawanSubmitBtn" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-red-700 transition-colors font-medium flex items-center gap-2">
            <span>Update Karyawan</span>
            <svg id="editKaryawanLoadingIcon" class="hidden animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  // Foto preview handling
  const editFotoInput = document.getElementById('edit_foto');
  const editFotoPreview = document.getElementById('edit_foto_preview');
  const editFotoPreviewContainer = document.getElementById('edit_foto_preview_container');
  const editFotoPlaceholder = document.getElementById('edit_foto_placeholder');
  const editFotoName = document.getElementById('edit_foto_name');
  const editFotoSize = document.getElementById('edit_foto_size');
  const editFotoChange = document.getElementById('edit_foto_change');
  const editFotoRemove = document.getElementById('edit_foto_remove');
  const editFotoDropzone = document.getElementById('edit_foto_dropzone');
  const currentFotoPreview = document.getElementById('current_foto_preview');

  // Format file size
  function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }

  // Handle file selection
  function handleEditFileSelect(file) {
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        editFotoPreview.src = e.target.result;
        editFotoPreviewContainer.classList.remove('hidden');
        editFotoPlaceholder.classList.add('hidden');
        editFotoName.textContent = file.name;
        editFotoSize.textContent = formatFileSize(file.size);
      };
      reader.readAsDataURL(file);
    }
  }

  // Event listeners
  if (editFotoInput) {
    editFotoInput.addEventListener('change', function(e) {
      handleEditFileSelect(e.target.files[0]);
    });
  }

  if (editFotoChange) {
    editFotoChange.addEventListener('click', function() {
      editFotoInput.click();
    });
  }

  if (editFotoRemove) {
    editFotoRemove.addEventListener('click', function() {
      editFotoInput.value = '';
      editFotoPreview.src = '';
      editFotoPreviewContainer.classList.add('hidden');
      editFotoPlaceholder.classList.remove('hidden');
    });
  }

  // Drag and drop functionality
  if (editFotoDropzone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      editFotoDropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
      editFotoDropzone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
      editFotoDropzone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
      editFotoDropzone.classList.add('border-primary', 'bg-primary/5');
    }

    function unhighlight() {
      editFotoDropzone.classList.remove('border-primary', 'bg-primary/5');
    }

    editFotoDropzone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
      const dt = e.dataTransfer;
      const file = dt.files[0];
      handleEditFileSelect(file);
    }
  }

  // Tambahkan kode untuk menampilkan foto saat ini di modal edit
  function showKaryawanEditModal(id) {
    // Kode yang sudah ada untuk menampilkan modal
    
    // Tambahkan kode untuk menampilkan foto saat ini
    fetch(`/admin/karyawan/${id}`)
      .then(response => response.json())
      .then(data => {
        if (data.foto) {
          currentFotoPreview.src = `/images/karyawan/${data.foto}`;
          currentFotoPreview.classList.remove('hidden');
        } else {
          currentFotoPreview.classList.add('hidden');
        }
      });
  }
</script>
