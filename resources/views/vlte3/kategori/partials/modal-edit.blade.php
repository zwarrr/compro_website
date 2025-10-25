<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit mr-2"></i>Edit Kategori
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeEditModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editKategoriForm" onsubmit="submitEdit(event)">
                @csrf
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div id="editFormContent">
                        <div class="form-group">
                            <label for="edit_nama_kategori">Nama Kategori <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="edit_nama_kategori"
                                    name="nama_kategori" required placeholder="Masukkan nama kategori">
                            </div>
                            <div class="invalid-feedback hidden" id="error_edit_nama_kategori"></div>
                        </div>
                        <div class="form-group">
                            <label for="edit_tipe">Tipe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                </div>
                                <select class="form-control" id="edit_tipe" name="tipe" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="layanan">Layanan</option>
                                    <option value="galeri">Galeri</option>
                                    <option value="karyawan">Karyawan</option>
                                    <option value="divisi">Divisi</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <div class="invalid-feedback hidden" id="error_edit_tipe"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="closeEditModal()">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="editSubmitBtn">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>