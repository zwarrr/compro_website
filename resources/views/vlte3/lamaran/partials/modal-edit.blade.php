<!-- Modal Edit Lamaran Status -->
<div class="modal fade" id="modalLamaranEdit" tabindex="-1" role="dialog" aria-labelledby="modalLamaranEditLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditLamaran" autocomplete="off" onsubmit="submitEditLamaran(event)">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLamaranEditLabel">Edit Status Lamaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_lamaran_id" name="id">
                    <div class="form-group">
                        <label>Kode Lamaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-code"></i></span>
                            </div>
                            <input type="text" id="edit_kode_lamaran" class="form-control bg-light" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="edit_nama_lengkap" class="form-control bg-light" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" id="edit_email" class="form-control bg-light" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <select id="edit_status" name="status" class="form-control">
                                <option value="Diajukan">Diajukan</option>
                                <option value="Dikirim">Dikirim</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="saveEditLamaranBtn" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>