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
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-id-card mr-2"></i>ID Kategori:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_id"></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-code mr-2"></i>Kode Kategori:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-code"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_kode"></p>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-tag mr-2"></i>Nama Kategori:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_nama_kategori"></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-list-alt mr-2"></i>Tipe:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-list-alt"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_tipe"></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-calendar-plus mr-2"></i>Dibuat:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_created_at"></p>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-calendar-check mr-2"></i>Terakhir Diupdate:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                </div>
                                <p class="form-control bg-light mb-0" id="detail_updated_at"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeDetailModal()">
                    <i class="fas fa-times mr-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>