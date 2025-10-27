<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 800px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit mr-2"></i>Edit Ilustrasi
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeEditModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editIlustrasiForm" onsubmit="submitEdit(event)" style="width:100%;" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id" name="id_ilustrasi">
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_judul">Judul <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="edit_judul" name="judul" required>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_judul"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_status">Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select class="form-control" id="edit_status" name="status" required>
                                            <option value="public">Public</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_status"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="edit_deskripsi">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="2"></textarea>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_deskripsi"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_image">Gambar</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control-file" id="edit_image" name="image" accept="image/*" onchange="previewEditImage(event)">
                                    </div>
                                    <div class="text-center mb-2">
                                        <img id="preview-edit-img" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 180px; max-width: 100%; object-fit: contain;" />
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="editSubmitBtn">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
            <script>
                function previewEditImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('preview-edit-img');
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
