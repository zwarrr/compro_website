<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash mr-2"></i>Hapus Galeri
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus galeri <strong id="delete_galeri_name"></strong>?</p>
                <p class="text-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    Data yang dihapus tidak dapat dikembalikan!
                </p>
                <input type="hidden" id="delete_galeri_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteSubmitBtn" onclick="submitDelete(event)">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>
