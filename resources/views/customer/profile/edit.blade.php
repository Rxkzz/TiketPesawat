<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - {{ auth('penumpang')->user()->nama_penumpang }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profile/edit.css') }}">
</head>
<body>
    @include('customer.partials.navbar')

    <div class="profile-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                Terdapat kesalahan dalam pengisian form
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="profile-header">
            <div class="profile-avatar">
                <img src="{{ auth('penumpang')->user()->profile_photo ? asset('storage/' . auth('penumpang')->user()->profile_photo) : asset('images/default-avatar.png') }}" 
                     alt="Profile Photo" 
                     class="avatar-img">
                <button type="button" class="btn-change-photo" onclick="document.getElementById('profile_photo').click()">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            <h1 class="profile-title">Edit Profile</h1>
            <p class="profile-subtitle">Perbarui informasi profil dan email Anda</p>
        </div>

        <div class="profile-card">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*">

                <div class="form-section">
                    <h3 class="section-title">Informasi Pribadi</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" 
                               class="form-control-modern @error('nama_penumpang') is-invalid @enderror" 
                               name="nama_penumpang" 
                               value="{{ old('nama_penumpang', auth('penumpang')->user()->nama_penumpang) }}" 
                               required>
                        @error('nama_penumpang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" 
                               class="form-control-modern @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email', auth('penumpang')->user()->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" 
                               class="form-control-modern @error('telp') is-invalid @enderror" 
                               name="telp" 
                               value="{{ old('telp', auth('penumpang')->user()->telp) }}" 
                               required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control-modern @error('alamat_penumpang') is-invalid @enderror" 
                                  name="alamat_penumpang" 
                                  rows="3">{{ old('alamat_penumpang', auth('penumpang')->user()->alamat_penumpang) }}</textarea>
                        @error('alamat_penumpang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Ubah Password</h3>
                    <p class="section-subtitle">Kosongkan jika tidak ingin mengubah password</p>

                    <div class="form-group">
                        <label class="form-label">Password Saat Ini</label>
                        <div class="password-input">
                            <input type="password" 
                                   class="form-control-modern @error('current_password') is-invalid @enderror" 
                                   name="current_password">
                            <button type="button" class="btn-toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <div class="password-input">
                            <input type="password" 
                                   class="form-control-modern @error('password') is-invalid @enderror" 
                                   name="password">
                            <button type="button" class="btn-toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="password-input">
                            <input type="password" 
                                   class="form-control-modern" 
                                   name="password_confirmation">
                            <button type="button" class="btn-toggle-password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('home') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview foto profile
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar-img').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Toggle password visibility
        document.querySelectorAll('.btn-toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html> 