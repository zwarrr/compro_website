<!-- Modal Edit Pengetahuan -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-edit-pengetahuan"
                onsubmit="submitEdit(event)">
                @csrf
        <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Pengetahuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_pengetahuan" id="edit-id-pengetahuan">
            <div class="form-group">
                <label for="edit-kode_pengetahuan">Kode Pengetahuan</label>
                <input type="text" class="form-control" name="kode_pengetahuan" id="edit-kode_pengetahuan" required>
                <span class="invalid-feedback d-none" id="error_edit_kode_pengetahuan"></span>
            </div>
            <div class="form-group">
                <label for="edit-kategori_pertanyaan">Kategori Pertanyaan</label>
                <input type="text" class="form-control" name="kategori_pertanyaan" id="edit-kategori_pertanyaan"
                    required>
                <span class="invalid-feedback d-none" id="error_edit_kategori_pertanyaan"></span>
            </div>
            <div class="form-group">
                <label for="edit-sub_kategori">Sub Kategori</label>
                <input type="text" class="form-control" name="sub_kategori" id="edit-sub_kategori">
                <span class="invalid-feedback d-none" id="error_edit_sub_kategori"></span>
            </div>
            <div class="form-group">
                <label for="edit-jawaban">Jawaban</label>
                <textarea class="form-control" name="jawaban" id="edit-jawaban" rows="3" required></textarea>
                <span class="invalid-feedback d-none" id="error_edit_jawaban"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
    </div>
</div>
</div>
