<!-- Modal Detail Pengetahuan -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel"><i class="fas fa-eye mr-2"></i>Detail Pengetahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label><i class="fas fa-code mr-2"></i>Kode Pengetahuan:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-code"></i></span>
            </div>
            <p class="form-control bg-light mb-0" id="detail-kode_pengetahuan"></p>
          </div>
        </div>
        <div class="form-group">
          <label><i class="fas fa-folder mr-2"></i>Kategori Pertanyaan:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-folder"></i></span>
            </div>
            <p class="form-control bg-light mb-0" id="detail-kategori_pertanyaan"></p>
          </div>
        </div>
        <div class="form-group">
          <label><i class="fas fa-folder-open mr-2"></i>Sub Kategori:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
            </div>
            <p class="form-control bg-light mb-0" id="detail-sub_kategori"></p>
          </div>
        </div>
        <div class="form-group">
          <label><i class="fas fa-comment-dots mr-2"></i>Jawaban:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-comment-dots"></i></span>
            </div>
            <p class="form-control bg-light mb-0" id="detail-jawaban"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fas fa-times mr-1"></i> Tutup
        </button>
      </div>
    </div>
  </div>
</div>