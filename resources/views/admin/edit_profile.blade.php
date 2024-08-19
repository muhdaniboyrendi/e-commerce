<x-layout>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Produk</a></li>
                      <li class="breadcrumb-item"><a href="#">Aksesoris</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Asus Vivobook OLED 15</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Edit Profil</h1>
        
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto Profil" id="profileImage">
                                    <h4>John Doe</h4>
                                    <p class="text-muted">Pengguna sejak: Agustus 2024</p>
                                    <button class="btn btn-primary btn-sm" onclick="document.getElementById('imageUpload').click();">
                                        <i class="bi bi-camera"></i> Ganti Foto
                                    </button>
                                    <input id="imageUpload" type="file" style="display: none;" accept="image/*">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="fullName" value="John Doe">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" id="email" value="john@example.com">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Nomor Telepon</label>
                                            <input type="tel" class="form-control" id="phone" value="0812-3456-7890">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="birthdate" value="1990-01-01">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="address" rows="3">Jl. Contoh No. 123, Jakarta Selatan</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio" rows="3">Saya adalah seorang penggemar teknologi dan suka berbelanja online.</textarea>
                                        </div>
                                        
                                        <h5 class="mt-4 mb-3">Ubah Kata Sandi</h5>
                                        
                                        <div class="mb-3">
                                            <label for="currentPassword" class="form-label">Kata Sandi Saat Ini</label>
                                            <input type="password" class="form-control" id="currentPassword">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Kata Sandi Baru</label>
                                            <input type="password" class="form-control" id="newPassword">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                            <input type="password" class="form-control" id="confirmPassword">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-outline-secondary">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>