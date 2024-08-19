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
            <h1 class="mb-4">Kelola Produk</h1>
            
            <div class="row mb-3">
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </button>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari produk...">
                </div>
            </div>
    
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Sepatu Lari</td>
                        <td>Sepatu</td>
                        <td>Rp 1.200.000</td>
                        <td>50</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kaos Olahraga</td>
                        <td>Pakaian</td>
                        <td>Rp 150.000</td>
                        <td>100</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Tambahkan baris produk lainnya di sini -->
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
        
            <!-- Modal Tambah Produk -->
            <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="namaProduk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="namaProduk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategoriProduk" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategoriProduk" required>
                                        <option value="">Pilih kategori...</option>
                                        <option value="sepatu">Sepatu</option>
                                        <option value="pakaian">Pakaian</option>
                                        <option value="aksesoris">Aksesoris</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hargaProduk" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="hargaProduk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stokProduk" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stokProduk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsiProduk" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsiProduk" rows="3"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>