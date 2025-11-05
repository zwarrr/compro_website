
<div class="modal fade" id="modalDetailFeatures" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 700px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>Detail Features
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDetailModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Kode Features</dt>
                    <dd class="col-sm-8" id="detail_kode_features"></dd>
                    <dt class="col-sm-4">Judul</dt>
                    <dd class="col-sm-8" id="detail_judul"></dd>
                    <dt class="col-sm-4">Sub Judul</dt>
                    <dd class="col-sm-8" id="detail_sub_judul"></dd>
                    <dt class="col-sm-4">Posisi</dt>
                    <dd class="col-sm-8" id="detail_replace_position"></dd>
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8" id="detail_status"></dd>
                    <dt class="col-sm-4">Dibuat</dt>
                    <dd class="col-sm-8" id="detail_created_at"></dd>
                    <dt class="col-sm-4">Diupdate</dt>
                    <dd class="col-sm-8" id="detail_updated_at"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
