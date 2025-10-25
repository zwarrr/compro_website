<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash mr-2"></i>Hapus Kategori
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h6 class="font-weight-bold">Konfirmasi Penghapusan</h6>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus kategori <strong id="delete_kategori_name"></strong>?</p>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!
                </div>
                <input type="hidden" id="delete_kategori_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    onclick="closeDeleteModal()">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="deleteSubmitBtn"
                    onclick="submitDelete(event)">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>