
<div class="modal fade" id="modalEditFeatures" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="max-width: 700px; margin: auto;">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fas fa-edit mr-2"></i>Edit Features
        </h5>
        <button type="button" class="close" data-dismiss="modal" onclick="closeEditModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit-features" onsubmit="submitEdit(event)" style="width:100%;">
        @csrf
        <input type="hidden" id="edit_id_features" name="id_features">
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
                  <label for="edit_sub_judul">Sub Judul</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                    </div>
                    <input type="text" class="form-control" id="edit_sub_judul" name="sub_judul">
                  </div>
                  <div class="invalid-feedback hidden" id="error_edit_sub_judul"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditModal()">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
