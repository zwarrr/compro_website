<!-- Modal Edit Profile -->
<div class="modal fade" id="modalEditProfile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-edit mr-2"></i>Edit Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="closeEditModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditProfile" onsubmit="submitEdit(event)" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Foto Profile -->
                        <div class="form-group text-center">
                            <label>Foto Profile</label>
                            <div class="mb-3">
                                <img id="preview_foto_profile" 
                                     src="#" 
                                     alt="Preview" 
                                     class="img-fluid rounded-circle d-none" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #007bff;">
                                <div id="initial_foto_profile" class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                     style="width: 150px; height: 150px; font-size: 60px; font-weight: bold;">
                                </div>
                            </div>
                            <div class="custom-file" style="max-width: 400px; margin: 0 auto;">
                                <input type="file" class="custom-file-input" id="edit_foto_profile" name="foto_profile" accept="image/*" onchange="previewFotoProfile(event)">
                                <label class="custom-file-label" for="edit_foto_profile">Pilih foto...</label>
                            </div>
                            <small class="form-text text-muted">Format: JPG, PNG, GIF, SVG (Max: 2MB)</small>
                            <div class="invalid-feedback hidden" id="error_edit_foto_profile"></div>
                        </div>

                        <hr>

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="edit_nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="edit_nama" name="nama" required>
                            </div>
                            <div class="invalid-feedback hidden" id="error_edit_nama"></div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="edit_email">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="invalid-feedback hidden" id="error_edit_email"></div>
                        </div>

                        <hr>
                        <h6 class="text-muted mb-3">
                            <i class="fas fa-lock mr-1"></i> Ubah Password (Opsional)
                        </h6>

                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="edit_current_password">Password Lama</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" id="edit_current_password" name="current_password" autocomplete="current-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('edit_current_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            <div class="invalid-feedback hidden" id="error_edit_current_password"></div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="edit_new_password">Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="edit_new_password" name="new_password" autocomplete="new-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('edit_new_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Minimal 8 karakter</small>
                            <div class="invalid-feedback hidden" id="error_edit_new_password"></div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group">
                            <label for="edit_new_password_confirmation">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" id="edit_new_password_confirmation" name="new_password_confirmation" autocomplete="new-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('edit_new_password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="invalid-feedback hidden" id="error_edit_new_password_confirmation"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnUpdateProfile">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
