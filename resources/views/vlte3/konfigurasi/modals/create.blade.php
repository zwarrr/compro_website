<div class="modal fade" id="createProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-plus mr-2"></i> Buat Profile Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="createProfileForm" onsubmit="submitCreateProfile(event)">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="nama_perusahaan">Nama Perusahaan <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-building"></i></span></div>
                <input id="nama_perusahaan" name="nama_perusahaan" class="form-control" placeholder="cth. PT Maju Jaya Abadi">
              </div>
              <div class="invalid-feedback d-none" id="error_nama_perusahaan"></div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="slogan">Slogan</label>
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-tag"></i></span></div>
                <input id="slogan" name="slogan" class="form-control" placeholder="cth. Solusi Tepat untuk Bisnis Anda">
              </div>
              <div class="invalid-feedback d-none" id="error_slogan"></div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
              <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control"></textarea>
              <div class="invalid-feedback d-none" id="error_deskripsi"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="visi">Visi</label>
              <textarea id="visi" name="visi" rows="3" class="form-control"></textarea>
              <div class="invalid-feedback d-none" id="error_visi"></div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="misi">Misi</label>
              <textarea id="misi" name="misi" rows="3" class="form-control"></textarea>
              <div class="invalid-feedback d-none" id="error_misi"></div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="alamat">Alamat</label>
              <textarea id="alamat" name="alamat" rows="3" class="form-control"></textarea>
              <div class="invalid-feedback d-none" id="error_alamat"></div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="telepon">Telepon</label>
              <input id="telepon" name="telepon" class="form-control" />
              <div class="invalid-feedback d-none" id="error_telepon"></div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="email">Email</label>
              <input id="email" name="email" class="form-control" />
              <div class="invalid-feedback d-none" id="error_email"></div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger" id="createSubmitBtn">Buat Profile</button>
        </div>
      </form>
    </div>
  </div>
</div>