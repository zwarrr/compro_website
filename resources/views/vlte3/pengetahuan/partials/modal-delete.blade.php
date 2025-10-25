<!-- Modal Delete Pengetahuan -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-delete-pengetahuan">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel"><i class="fas fa-trash-alt mr-2"></i>Hapus Pengetahuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_pengetahuan" id="delete-id-pengetahuan">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h6 class="font-weight-bold">Konfirmasi Penghapusan</h6>
                    </div>
                    <p id="delete-pengetahuan-name" class="text-center">Apakah Anda yakin ingin menghapus pengetahuan ini?</p>
                    <div class="alert alert-warning mt-3" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Peringatan:</strong> Data yang telah dihapus tidak dapat dikembalikan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger" onclick="submitDelete(event)">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>