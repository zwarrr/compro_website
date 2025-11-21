<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="detailModalLabel">
                    <i class="fas fa-info-circle"></i> Detail Log Pertanyaan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Pertanyaan:</label>
                        <div class="p-3 bg-light rounded" id="detail-question"></div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Jawaban AI:</label>
                        <div class="p-3 bg-light rounded" id="detail-answer" style="max-height: 300px; overflow-y: auto;"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold"><i class="fas fa-laptop"></i> Device:</label>
                        <p id="detail-device" class="text-muted"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold"><i class="fas fa-globe"></i> Browser:</label>
                        <p id="detail-browser" class="text-muted"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold"><i class="fas fa-desktop"></i> Platform OS:</label>
                        <p id="detail-os" class="text-muted"></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Tanggal:</label>
                        <p id="detail-date" class="text-muted"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">Status Knowledge Base:</label>
                        <p id="detail-knowledge-status"></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">User Agent:</label>
                        <p id="detail-user-agent" class="text-muted small" style="word-break: break-all;"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
