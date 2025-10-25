<div class="modal fade" id="createModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createKategoriForm" onsubmit="submitCreate(event)">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                required placeholder="Masukkan nama kategori">
                        </div>
                        <div class="invalid-feedback hidden" id="error_create_nama_kategori"></div>
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                            </div>
                            <select class="form-control" id="tipe" name="tipe" required>
                                <option value="">Pilih Tipe</option>
                                <option value="layanan">Layanan</option>
                                <option value="galeri">Galeri</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="divisi">Divisi</option>
                                <option value="client">Client</option>
                            </select>
                        </div>
                        <div class="invalid-feedback hidden" id="error_create_tipe"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="closeCreateModal()">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="createSubmitBtn">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>