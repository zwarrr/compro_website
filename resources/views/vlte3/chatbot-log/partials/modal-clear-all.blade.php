<!-- Modal Clear All -->
<div class="modal fade" id="clearAllModal" tabindex="-1" role="dialog" aria-labelledby="clearAllModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="clearAllModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Semua
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>PERINGATAN!</strong> Anda akan menghapus SEMUA log chatbot.
                </div>
                <p>Apakah Anda yakin ingin menghapus <strong>SEMUA</strong> log pertanyaan chatbot?</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan dan akan menghapus seluruh data log!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" onclick="clearAllLogs()">
                    <i class="fas fa-trash-alt"></i> Ya, Hapus Semua
                </button>
            </div>
        </div>
    </div>
</div>
