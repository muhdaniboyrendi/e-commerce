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
            <h1 class="mb-4">Kelola Pesanan</h1>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari pesanan...">
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>Filter Status</option>
                        <option value="1">Menunggu Pembayaran</option>
                        <option value="2">Diproses</option>
                        <option value="3">Dikirim</option>
                        <option value="4">Selesai</option>
                        <option value="5">Dibatalkan</option>
                    </select>
                </div>
            </div>
    
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#12345</td>
                        <td>20 Agu 2024</td>
                        <td>John Doe</td>
                        <td>Rp 1.500.000</td>
                        <td><span class="badge bg-warning">Diproses</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailPesananModal"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#12346</td>
                        <td>19 Agu 2024</td>
                        <td>Jane Smith</td>
                        <td>Rp 750.000</td>
                        <td><span class="badge bg-info">Dikirim</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailPesananModal"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-circle"></i></button>
                        </td>
                    </tr>
                    <!-- Tambahkan baris pesanan lainnya di sini -->
                </tbody>
            </table>
    
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        
            <!-- Modal Detail Pesanan -->
            <div class="modal fade" id="detailPesananModal" tabindex="-1" aria-labelledby="detailPesananModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailPesananModalLabel">Detail Pesanan #12345</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Informasi Pelanggan</h6>
                            <p>Nama: John Doe<br>
                            Email: john@example.com<br>
                            Telepon: 0812-3456-7890</p>
        
                            <h6>Alamat Pengiriman</h6>
                            <p>Jl. Contoh No. 123, Kota Contoh, 12345</p>
        
                            <h6>Detail Produk</h6>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sepatu Lari</td>
                                        <td>1</td>
                                        <td>Rp 1.200.000</td>
                                        <td>Rp 1.200.000</td>
                                    </tr>
                                    <tr>
                                        <td>Kaos Olahraga</td>
                                        <td>2</td>
                                        <td>Rp 150.000</td>
                                        <td>Rp 300.000</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Total</th>
                                        <th>Rp 1.500.000</th>
                                    </tr>
                                </tfoot>
                            </table>
        
                            <h6>Status Pesanan</h6>
                            <select class="form-select mb-3">
                                <option>Menunggu Pembayaran</option>
                                <option selected>Diproses</option>
                                <option>Dikirim</option>
                                <option>Selesai</option>
                                <option>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>