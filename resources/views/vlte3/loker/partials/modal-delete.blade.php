<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-trash mr-2"></i>Hapus Loker</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_loker" id="delete_loker_id">
                <p>Yakin ingin menghapus loker <strong id="delete_loker_posisi"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteSubmitBtn"><i class="fas fa-trash"></i> Hapus</button>
            </div>
        </div>
    </div>
</div>
