<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 600px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-trash mr-2"></i>Hapus Client</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteClientForm" onsubmit="submitDelete(event)">
                @csrf
                <input type="hidden" id="delete_client_id" name="id">
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <div>
                            Apakah Anda yakin ingin menghapus client <strong id="delete_client_name"></strong>?<br>
                            <span class="font-weight-bold">Data yang dihapus tidak dapat dikembalikan!</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger" id="deleteSubmitBtn">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
