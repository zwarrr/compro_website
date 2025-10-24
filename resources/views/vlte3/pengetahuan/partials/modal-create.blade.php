<!-- Modal Create Pengetahuan -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form id="form-create-pengetahuan" onsubmit="submitCreate(event)">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel">Tambah Pengetahuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="kode_pengetahuan">Kode Pengetahuan</label>
            <input type="text" class="form-control" name="kode_pengetahuan" id="create-kode-pengetahuan" readonly placeholder="(otomatis)">
            <span class="invalid-feedback d-none" id="error_create_kode_pengetahuan"></span>
          </div>
          <div class="form-group">
            <label for="kategori_pertanyaan">Kategori Pertanyaan</label>
            <input type="text" class="form-control" name="kategori_pertanyaan" required>
            <span class="invalid-feedback d-none" id="error_create_kategori_pertanyaan"></span>
          </div>
          <div class="form-group">
            <label for="sub_kategori">Sub Kategori</label>
            <input type="text" class="form-control" name="sub_kategori">
            <span class="invalid-feedback d-none" id="error_create_sub_kategori"></span>
          </div>
          <div class="form-group">
            <label for="jawaban">Jawaban</label>
            <textarea class="form-control" name="jawaban" rows="3" required></textarea>
            <span class="invalid-feedback d-none" id="error_create_jawaban"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
