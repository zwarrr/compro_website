
<div class="modal fade" id="modalCreateFeatures" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="max-width: 700px; margin: auto;">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-plus mr-2"></i>Tambah Features
        </h5>
        <button type="button" class="close" data-dismiss="modal" onclick="closeCreateModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-create-features" onsubmit="submitCreate(event)" style="width:100%;">
        @csrf
        <div class="modal-body">
          <div class="container-fluid px-2">
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
                  <label for="sub_judul">Sub Judul</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                    </div>
                    <input type="text" class="form-control" id="sub_judul" name="sub_judul">
                  </div>
                  <div class="invalid-feedback hidden" id="error_create_sub_judul"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="replace_position">Posisi yang Akan Diganti <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    </div>
                    <select class="form-control" id="replace_position" name="replace_position" required>
                      <option value="">-- Pilih Posisi Default yang Akan Diganti --</option>
                      <option value="1">Posisi 1: Aksesnya mudah</option>
                      <option value="2">Posisi 2: Fitur Lengkap</option>
                      <option value="3">Posisi 3: Komunitas Besar</option>
                      <option value="4">Posisi 4: Aman & Terpercaya</option>
                      <option value="5">Posisi 5: Cocok untuk semua kalangan</option>
                      <option value="6">Posisi 6: Terjangkau</option>
                    </select>
                  </div>
                  <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> Pilih posisi fitur default mana yang akan diganti dengan data ini. Fitur lainnya tetap menampilkan data default.
                  </small>
                  <div class="invalid-feedback hidden" id="error_create_replace_position"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeCreateModal()">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
