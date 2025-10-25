<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createKaryawanForm" onsubmit="submitCreate(event)">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Divisi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <select class="form-control" id="create_kategori_id" name="kategori_id" required>
                                            <option value="">Pilih Divisi</option>
                                            @foreach ($divisis as $divisi)
                                                <option value="{{ $divisi->id_kategori }}">{{ $divisi->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_kategori_id"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Staff <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                        <select class="form-control" id="create_staff_id" name="staff_id" required>
                                            <option value="">Pilih Staff</option>
                                            @foreach ($staffs as $staff)
                                                <option value="{{ $staff->id_kategori }}">{{ $staff->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_staff_id"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>NIK <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="create_nik" name="nik" required placeholder="Masukkan NIK">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_nik"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="create_nama" name="nama" required placeholder="Masukkan nama lengkap">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_nama"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select class="form-control" id="create_status" name="status" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_status"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control" id="create_foto" name="foto" accept="image/*" onchange="previewCreateImage(event)">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_foto"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="text-center">
                                    <img id="preview-create-img" src="#" alt="Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 200px; max-width: 100%; object-fit: contain;" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea class="form-control" id="create_deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi karyawan"></textarea>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_create_deskripsi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">Simpan</button>
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