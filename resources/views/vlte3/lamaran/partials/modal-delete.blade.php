<div class="modal fade" id="modalLamaranDelete" tabindex="-1" role="dialog" aria-labelledby="modalLamaranDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLamaranDeleteLabel">Hapus Lamaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h6 class="font-weight-bold">Konfirmasi Penghapusan</h6>
                </div>
                <p class="text-center" id="deleteLamaranText">Apakah Anda yakin ingin menghapus lamaran ini?</p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteLamaranBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>