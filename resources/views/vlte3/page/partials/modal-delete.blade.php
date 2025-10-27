<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 600px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-trash mr-2"></i>Konfirmasi Hapus Page
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletePageForm" onsubmit="submitDelete(event)">
                @csrf
                <input type="hidden" id="delete_page_id" name="id_page">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Page</label>
                        <input type="text" id="delete_page_name" class="form-control" readonly>
                    </div>
                    <div class="form-group text-center">
                        <label>Preview Image Ilustrasi</label>
                        <div id="delete_image">-</div>
                    </div>
                    <div class="alert alert-danger mt-3">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Apakah Anda yakin ingin menghapus page ini? Tindakan ini tidak dapat dibatalkan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="deleteSubmitBtn">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
