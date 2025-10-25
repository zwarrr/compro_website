<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDeleteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteKaryawanForm" onsubmit="submitDelete(event)">
                @csrf
                <input type="hidden" id="delete_karyawan_id" name="id">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                        <h6 class="font-weight-bold">Konfirmasi Penghapusan</h6>
                    </div>
                    <p class="text-center">Yakin ingin menghapus karyawan <strong id="delete_karyawan_name"></strong>?</p>
                    <div class="alert alert-warning mt-3" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Peringatan:</strong> Data yang dihapus tidak dapat dikembalikan!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn btn-danger" id="deleteSubmitBtn">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>