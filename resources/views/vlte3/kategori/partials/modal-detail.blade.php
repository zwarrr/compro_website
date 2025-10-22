<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>Detail Kategori
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDetailModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detailData" class="hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>ID Kategori:</strong>
                            <p id="detail_id"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Kode Kategori:</strong>
                            <p id="detail_kode"></p>
                        </div>
                        <div class="col-md-12">
                            <strong>Nama Kategori:</strong>
                            <p id="detail_nama_kategori"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tipe:</strong>
                            <p id="detail_tipe"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Dibuat:</strong>
                            <p id="detail_created_at"></p>
                        </div>
                        <div class="col-md-12">
                            <strong>Terakhir Diupdate:</strong>
                            <p id="detail_updated_at"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>