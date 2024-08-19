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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Foto Profil">
                                    <h4>John Doe</h4>
                                    <p class="text-muted">Pelanggan Setia</p>
                                    <button class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i> Edit Profil</button>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Kontak</h5>
                                    <ul class="list-unstyled">
                                        <li><i class="bi bi-envelope me-2"></i> john@example.com</li>
                                        <li><i class="bi bi-phone me-2"></i> 0812-3456-7890</li>
                                        <li><i class="bi bi-geo-alt me-2"></i> Jakarta, Indonesia</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Profil</h5>
                                    <form>
                                        <div class="mb-3">
                                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namaLengkap" value="John Doe">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" value="john@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Nomor Telepon</label>
                                            <input type="tel" class="form-control" id="telepon" value="0812-3456-7890">
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" rows="3">Jl. Contoh No. 123, Jakarta Selatan</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggalLahir" value="1990-01-01">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Riwayat Pembelian</h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#12345</td>
                                                <td>20 Agu 2024</td>
                                                <td>Rp 1.500.000</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                            </tr>
                                            <tr>
                                                <td>#12346</td>
                                                <td>15 Jul 2024</td>
                                                <td>Rp 750.000</td>
                                                <td><span class="badge bg-info">Dikirim</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>