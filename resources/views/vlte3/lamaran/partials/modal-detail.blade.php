<div class="modal fade" id="modalLamaranDetail" tabindex="-1" role="dialog" aria-labelledby="modalLamaranDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLamaranDetailLabel">Detail Lamaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="currentLamaranId" value="">
                <div id="lamaranDetailContent">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kode Lamaran & Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0" id="detail-kode-nama"></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0" id="detail-email"></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Lowongan Kerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0" id="detail-loker"></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0"><span class="badge badge-info" id="detail-status"></span></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Dibuat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0" id="detail-created-at"></p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Resume</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                    </div>
                                    <p class="form-control bg-light mb-0" id="detail-resume"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pesan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                    </div>
                                    <textarea class="form-control bg-light mb-0" rows="3" id="detail-pesan" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Catatan HRD</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
                                    </div>
                                    <textarea class="form-control bg-light mb-0" rows="3" id="detail-catatan-hrd" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="openReplyModal()">Balas</button>
                <button type="button" class="btn btn-danger" onclick="rejectLamaranFromModal()">Tolak</button>
            </div>
        </div>
    </div>
</div>