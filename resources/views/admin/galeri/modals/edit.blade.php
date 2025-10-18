<div id="editGaleriModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 hidden items-center justify-center z-50 transition-opacity duration-300 backdrop-blur-sm">
  <div class="modal-content bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 my-8 transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-white rounded-t-2xl">
      <div class="flex items-center gap-3">
        <div class="bg-amber-600/10 p-2 rounded-lg">
          <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Edit Galeri</h3>
      </div>
      <button onclick="closeEditGaleriModal()" class="text-gray-400 hover:text-gray-600 transition-colors rounded-full p-1 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form id="editGaleriForm" onsubmit="submitEditGaleri(event)" class="p-6" enctype="multipart/form-data">
      <input type="hidden" id="edit_galeri_id" name="id">

      <div id="galeriEditLoading" class="flex items-center justify-center py-12">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-amber-600"></div>
      </div>

      <div id="editGaleriFormContent" class="hidden">
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
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none bg-white">
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
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_galeri_kategori_id"></span>
          </div>

          <!-- Judul -->
          <div class="space-y-2">
            <label for="edit_judul" class="block text-sm font-semibold text-gray-700">
              Judul <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </div>
              <input type="text" id="edit_judul" name="judul"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                placeholder="Masukkan judul galeri">
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_galeri_judul"></span>
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
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all resize-none"
                placeholder="Masukkan deskripsi galeri (opsional)"></textarea>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_galeri_deskripsi"></span>
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
              <select id="edit_status" name="status"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none bg-white">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_galeri_status"></span>
          </div>

          <!-- Gambar -->
          <div class="space-y-2 md:col-span-2">
            <label for="edit_galeri_gambar" class="block text-sm font-semibold text-gray-700">
              Gambar
            </label>
            
            <!-- Preview Gambar Existing (jika ada) -->
            <div id="edit_existing_image" class="hidden mb-3">
              <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                <div class="flex items-center gap-4">
                  <div class="flex-shrink-0">
                    <img id="edit_gambar_preview" class="w-16 h-16 object-cover rounded-lg border border-gray-200" src="" alt="Preview gambar">
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Gambar Saat Ini</p>
                    <p class="text-xs text-gray-500">Klik upload baru untuk mengganti</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Upload Area -->
            <div id="editGaleriUploadArea" class="flex items-center justify-center w-full">
              <label for="edit_galeri_gambar" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="flex flex-col items-center justify-center pt-3 pb-3">
                  <svg class="w-6 h-6 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                  </svg>
                  <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                  <p class="text-xs text-gray-500">(PNG, JPG, GIF | MAX. 10MB)</p>
                </div>
                <input id="edit_galeri_gambar" name="gambar" type="file" class="hidden" accept="image/*" onchange="previewEditGaleriImage(this)" />
              </label>
            </div>

            <!-- Preview Area untuk gambar baru -->
            <div id="editGaleriPreviewArea" class="hidden w-full">
              <div class="relative bg-gray-50 rounded-lg p-3 border border-gray-200">
                <div class="flex items-center gap-4">
                  <div class="flex-shrink-0">
                    <img id="editGaleriImagePreview" class="w-16 h-16 object-cover rounded-lg border border-gray-200" src="" alt="Preview gambar">
                  </div>
                  <div class="flex-1 min-w-0">
                    <p id="editGaleriFileName" class="text-sm font-medium text-gray-900 truncate"></p>
                    <p id="editGaleriFileSize" class="text-xs text-gray-500"></p>
                  </div>
                  <div class="flex items-center gap-2 flex-shrink-0">
                    <button type="button" onclick="changeEditGaleriImage()" class="px-3 py-1 text-xs font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                      Ganti
                    </button>
                    <button type="button" onclick="removeEditGaleriImage()" class="px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                      Hapus
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <span class="text-red-500 text-xs mt-1 hidden" id="error_edit_galeri_gambar"></span>
          </div>

        </div>

        <!-- Footer Buttons -->
        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
          <button type="button" onclick="closeEditGaleriModal()"
            class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-semibold flex-1 sm:flex-none">
            Batal
          </button>
          <button type="submit" id="editGaleriSubmitBtn"
            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2 flex-1 sm:flex-none">
            <svg id="editGaleriLoadingSpinner" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white hidden"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            <span id="editGaleriSubmitBtnText">Update Galeri</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function previewEditGaleriImage(input) {
  if (input.files && input.files[0]) {
    const file = input.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
      document.getElementById('editGaleriUploadArea').classList.add('hidden');
      document.getElementById('editGaleriPreviewArea').classList.remove('hidden');
      document.getElementById('edit_existing_image')?.classList.add('hidden');
      
      document.getElementById('editGaleriImagePreview').src = e.target.result;
      document.getElementById('editGaleriFileName').textContent = file.name;
      document.getElementById('editGaleriFileSize').textContent = formatEditGaleriFileSize(file.size);
    }
    
    reader.readAsDataURL(file);
  }
}

function formatEditGaleriFileSize(bytes) {
  if (bytes === 0) return '0 Bytes';
  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB', 'GB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function changeEditGaleriImage() {
  document.getElementById('edit_galeri_gambar').click();
}

function removeEditGaleriImage() {
  document.getElementById('edit_galeri_gambar').value = '';
  
  document.getElementById('editGaleriPreviewArea').classList.add('hidden');
  document.getElementById('editGaleriUploadArea').classList.remove('hidden');
  
  // Tampilkan kembali gambar existing jika ada
  const existingImageDiv = document.getElementById('edit_existing_image');
  if (existingImageDiv && existingImageDiv.dataset.hasImage === 'true') {
    existingImageDiv.classList.remove('hidden');
  }
  
  document.getElementById('editGaleriImagePreview').src = '';
  document.getElementById('editGaleriFileName').textContent = '';
  document.getElementById('editGaleriFileSize').textContent = '';
}

document.addEventListener('DOMContentLoaded', function() {
  const uploadLabel = document.querySelector('#editGaleriUploadArea label');
  const fileInput = document.getElementById('edit_galeri_gambar');
  
  if (uploadLabel) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      uploadLabel.addEventListener(eventName, preventDefaults, false);
    });
    document.body.addEventListener('dragover', preventDefaults, false);
    document.body.addEventListener('drop', preventDefaults, false);
    
    uploadLabel.addEventListener('dragenter', highlight, false);
    uploadLabel.addEventListener('dragover', highlight, false);
    uploadLabel.addEventListener('dragleave', unhighlight, false);
    uploadLabel.addEventListener('drop', unhighlight, false);
    uploadLabel.addEventListener('drop', handleEditDrop, false);
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
  
  function handleEditDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
    previewEditGaleriImage(fileInput);
  }
});
</script>

<script>
  document.getElementById('edit_gambar')?.addEventListener('change', function(e){
    const file = e.target.files[0]; const prev = document.getElementById('edit_gambar_preview');
    if(file){ const reader = new FileReader(); reader.onload = ev => { prev.src = ev.target.result; prev.classList.remove('hidden'); }; reader.readAsDataURL(file); } else { prev.src = ''; prev.classList.add('hidden'); }
  });
</script>
