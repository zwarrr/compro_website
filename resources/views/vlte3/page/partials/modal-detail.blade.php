<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 900px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>Detail Page
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-2" id="detailData">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Kode Page</label>
                                <input type="text" id="detail_kode" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Digunakan Untuk</label>
                                <input type="text" id="detail_digunakan_untuk" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" id="detail_judul" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Ilustrasi</label>
                                <input type="text" id="detail_ilustrasi" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" id="detail_status" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Sub Judul</label>
                                <input type="text" id="detail_sub_judul" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea id="detail_deskripsi" class="form-control" rows="2" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Button Primary Text</label>
                                <input type="text" id="detail_button_primary_text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Button Primary Link</label>
                                <input type="text" id="detail_button_primary_link" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Button Secondary Text</label>
                                <input type="text" id="detail_button_secondary_text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Button Secondary Link</label>
                                <input type="text" id="detail_button_secondary_link" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group text-center">
                                <label>Preview Image Ilustrasi</label>
                                <div id="detail_image">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Dibuat</label>
                                <input type="text" id="detail_created_at" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Diupdate</label>
                                <input type="text" id="detail_updated_at" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
