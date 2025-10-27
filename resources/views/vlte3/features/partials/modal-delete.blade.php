

<div class="modal fade" id="modalDeleteFeatures" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-delete-features" onsubmit="submitDelete(event)">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-trash mr-2"></i>Hapus Features
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus features ini?</p>
                    <input type="hidden" id="delete_id_features" name="id_features">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn btn-danger" id="btn-confirm-delete-features">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
