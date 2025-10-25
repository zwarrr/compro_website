<!-- Modal Create Pengetahuan -->
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="form-create-pengetahuan" onsubmit="submitCreate(event)">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCreateLabel"><i class="fas fa-plus-circle mr-2"></i>Tambah Pengetahuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="kode_pengetahuan">Kode Pengetahuan</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-code"></i></span>
              </div>
              <input type="text" class="form-control" name="kode_pengetahuan" id="create-kode-pengetahuan" readonly placeholder="(otomatis)">
            </div>
            <span class="invalid-feedback d-none" id="error_create_kode_pengetahuan"></span>
          </div>
          <div class="form-group">
            <label for="kategori_pertanyaan">Kategori Pertanyaan <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-folder"></i></span>
              </div>
              <input type="text" class="form-control" name="kategori_pertanyaan" required placeholder="Masukkan kategori pertanyaan">
            </div>
            <span class="invalid-feedback d-none" id="error_create_kategori_pertanyaan"></span>
          </div>
          <div class="form-group">
            <label for="sub_kategori">Sub Kategori</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
              </div>
              <input type="text" class="form-control" name="sub_kategori" placeholder="Masukkan sub kategori">
            </div>
            <span class="invalid-feedback d-none" id="error_create_sub_kategori"></span>
          </div>
          <div class="form-group">
            <label for="jawaban">Jawaban <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
              </div>
              <textarea class="form-control" name="jawaban" rows="3" required placeholder="Masukkan jawaban"></textarea>
            </div>
            <span class="invalid-feedback d-none" id="error_create_jawaban"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>