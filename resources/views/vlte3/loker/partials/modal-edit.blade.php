<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="max-width: 800px; margin: auto;">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Loker</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeEditModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editLokerForm" method="POST" style="width:100%;">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid px-2">
                        <input type="hidden" name="id_loker" id="edit_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_posisi">Posisi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                        </div>
                                        <input type="text" id="edit_posisi" name="posisi" class="form-control" required>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_posisi"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_perusahaan">Perusahaan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" id="edit_perusahaan" name="perusahaan" class="form-control" required>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_perusahaan"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_lokasi">Lokasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" id="edit_lokasi" name="lokasi" class="form-control" required>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_lokasi"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_status">Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select id="edit_status" name="status" class="form-control" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="tidak aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_status"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="edit_deskripsi">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        </div>
                                        <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_deskripsi"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_gaji_awal">Gaji Awal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="number" id="edit_gaji_awal" name="gaji_awal" class="form-control">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_gaji_awal"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_gaji_akhir">Gaji Akhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                        </div>
                                        <input type="number" id="edit_gaji_akhir" name="gaji_akhir" class="form-control">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_gaji_akhir"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_pengalaman">Pengalaman</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                        </div>
                                        <input type="text" id="edit_pengalaman" name="pengalaman" class="form-control">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_pengalaman"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_pendidikan">Pendidikan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                        </div>
                                        <input type="text" id="edit_pendidikan" name="pendidikan" class="form-control">
                                    </div>
                                    <div class="invalid-feedback hidden" id="error_edit_pendidikan"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditModal()">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="editSubmitBtn"><i class="fas fa-save"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
