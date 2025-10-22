<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 800px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>Detail Karyawan
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeDetailModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid px-2">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Kode:</strong> <span id="detail_kode_karyawan"></span><br>
                            <strong>NIK:</strong> <span id="detail_nik"></span><br>
                            <strong>Nama:</strong> <span id="detail_nama"></span><br>
                            <strong>Kategori:</strong> <span id="detail_kategori"></span><br>
                            <strong>Status:</strong> <span id="detail_status"></span><br>
                        </div>
                        <div class="col-md-6 mb-3 text-center">
                            <img id="detail_foto" src="#" alt="Foto" class="img-fluid rounded shadow-sm d-none" style="max-height: 180px; max-width: 100%; object-fit: contain;" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <strong>Deskripsi:</strong>
                            <div id="detail_deskripsi" class="border rounded p-2 bg-light"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDetailModal()">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
