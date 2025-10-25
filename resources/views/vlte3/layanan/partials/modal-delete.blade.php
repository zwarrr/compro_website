<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <h6 class="font-weight-bold">Konfirmasi Penghapusan</h6>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus layanan <strong id="delete_layanan_name"></strong>?</p>
                <div id="delete_background" class="text-center mb-3"></div>
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!
                </div>
                <input type="hidden" id="delete_layanan_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteSubmitBtn" onclick="submitDelete(event)">Hapus</button>
            </div>
        </div>
    </div>
</div>