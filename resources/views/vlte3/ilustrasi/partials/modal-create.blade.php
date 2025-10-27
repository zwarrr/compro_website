
<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 800px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus mr-2"></i>Tambah Ilustrasi
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createIlustrasiForm" onsubmit="submitCreate(event)" style="width:100%;" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <input type="hidden" name="kode_ilustrasi" value="" id="kode_ilustrasi_create">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="judul">Judul <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="judul" name="judul" required>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_judul"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="public">Public</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_status"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2"></textarea>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_deskripsi"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control-file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.svg,.webp" onchange="previewCreateImage(event)">
                                    </div>
                                    <div class="text-center mb-2">
                                        <img id="preview-create-img" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 180px; max-width: 100%; object-fit: contain;" />
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
            <script>
                function previewCreateImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('preview-create-img');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.src = '#';
                        preview.classList.add('d-none');
                    }
                }
            </script>
        </div>
    </div>
</div>
