<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 800px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus mr-2"></i>Tambah Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createTestimoniForm" onsubmit="submitCreate(event)" style="width:100%;">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="create_nama_testimoni">Nama <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="create_nama_testimoni" name="nama_testimoni" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="create_jabatan">Jabatan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="create_jabatan" name="jabatan" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="create_pesan">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="create_pesan" name="pesan" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="create_foto">Foto</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control-file" id="create_foto" name="foto" accept="image/*" onchange="previewCreateImage(event)">
                                    </div>
                                    <div class="text-center mb-2">
                                        <img id="preview-create-img" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 180px; max-width: 100%; object-fit: contain;" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="create_rating">Rating <span class="text-danger">*</span></label>
                                    <select class="form-control" id="create_rating" name="rating" required>
                                        <option value="">Pilih Rating</option>
                                        @for($i=1;$i<=5;$i++)
                                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="create_status">Status <span class="text-danger">*</span></label>
                                    <select class="form-control" id="create_status" name="status" required>
                                        <option value="publik">Publik</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
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
