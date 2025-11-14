<script>
// ==================== PROFILE JAVASCRIPT ====================

// MODAL MANAGEMENT FUNCTIONS
function openEditModal() {
    $('#modalEditProfile').modal('show');
    clearErrors();
    loadProfileData();
}

function closeEditModal() {
    $('#modalEditProfile').modal('hide');
    $('#formEditProfile')[0].reset();
    clearErrors();
}

// Load current profile data
async function loadProfileData() {
    try {
        const response = await fetch('{{ route("admin.profile.show") }}', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) throw new Error('Gagal mengambil data profile');
        
        const result = await response.json();
        const user = result.user;
        
        $('#edit_nama').val(user.nama || '');
        $('#edit_email').val(user.email || '');
        
        // Handle foto profile preview
        if (user.foto_profile) {
            const fotoUrl = '{{ asset("storage") }}/' + user.foto_profile;
            $('#preview_foto_profile').attr('src', fotoUrl).removeClass('d-none');
            $('#initial_foto_profile').addClass('d-none');
        } else {
            $('#preview_foto_profile').addClass('d-none');
            $('#initial_foto_profile').removeClass('d-none');
            
            // Generate initials
            const userName = user.nama || 'User';
            const words = userName.split(' ');
            let initials = '';
            words.forEach(word => {
                initials += word.charAt(0).toUpperCase();
            });
            if (initials.length > 2) {
                initials = initials.substring(0, 2);
            }
            $('#initial_foto_profile').text(initials);
        }
        
        // Clear password fields
        $('#edit_current_password').val('');
        $('#edit_new_password').val('');
        $('#edit_new_password_confirmation').val('');
        
        // Reset file input
        $('#edit_foto_profile').val('');
        $('.custom-file-label').text('Pilih foto...');
        
    } catch (error) {
        showNotification('Gagal mengambil data profile', 'error');
        closeEditModal();
    }
}

// FORM SUBMISSION
async function submitEdit(event) {
    event.preventDefault();
    const form = document.getElementById('formEditProfile');
    const submitBtn = document.getElementById('btnUpdateProfile');
    const formData = new FormData(form);
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    clearErrors();
    
    try {
        const response = await fetch('{{ route("admin.profile.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok) {
            showNotification(result.message || 'Profile berhasil diupdate', 'success');
            closeEditModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            if (result.errors) {
                displayErrors(result.errors);
            }
            showNotification(result.message || 'Gagal mengupdate profile', 'error');
        }
    } catch (error) {
        showNotification('Terjadi kesalahan pada server', 'error');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save"></i> Update Profile';
    }
}

// HELPER FUNCTIONS
function clearErrors() {
    $('[id^="error_edit_"]').addClass('hidden').text('');
    $('#formEditProfile .form-control').removeClass('is-invalid');
}

function displayErrors(errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorEl = document.getElementById(`error_edit_${field}`);
        if (errorEl) {
            errorEl.textContent = messages[0];
            errorEl.classList.remove('hidden');
            $(`#formEditProfile [name="${field}"]`).addClass('is-invalid');
        }
    }
}

function showNotification(message, type = 'success') {
    $('#notification').remove();
    const icon = type === 'success' ? 
        '<i class="fas fa-check-circle mr-2"></i>' : 
        '<i class="fas fa-exclamation-circle mr-2"></i>';
    const notification = $(`
        <div id="notification" class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${icon}${message}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `);
    $('body').append(notification);
    setTimeout(() => {
        notification.alert('close');
    }, 5000);
}

function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const button = input.parentElement.querySelector('.input-group-append button');
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Preview foto profile
function previewFotoProfile(event) {
    const input = event.target;
    const preview = document.getElementById('preview_foto_profile');
    const initial = document.getElementById('initial_foto_profile');
    const label = input.parentElement.querySelector('.custom-file-label');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            initial.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
        initial.classList.remove('d-none');
        label.textContent = 'Pilih foto...';
    }
}

// Initialize tooltips
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    // Update file input label on change
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });
});
</script>
