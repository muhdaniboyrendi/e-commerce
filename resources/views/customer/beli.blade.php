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
                    <h1 class="mb-4">Pemesanan</h1>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h2>Informasi Pembeli</h2>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Provinsi</label>
                                    <input type="tel" class="form-control" id="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Kabupaten / Kota</label>
                                    <input type="tel" class="form-control" id="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Kecamatan</label>
                                    <input type="tel" class="form-control" id="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Kode POS</label>
                                    <input type="tel" class="form-control" id="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Detail Alamat (Nama Gedung, Nama Jalan, dll)</label>
                                    <textarea class="form-control" id="alamat" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h2>Detail Pesanan</h2>
                                <div class="form-group">
                                    <label class="form-label">Size</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="50" class="selectgroup-input"/>
                                            <span class="selectgroup-button">S</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="100" class="selectgroup-input"/>
                                            <span class="selectgroup-button">M</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="150" class="selectgroup-input"/>
                                            <span class="selectgroup-button">L</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="200" class="selectgroup-input"/>
                                            <span class="selectgroup-button">XL</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Warna</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="50" class="selectgroup-input"/>
                                            <span class="selectgroup-button">Merah</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="100" class="selectgroup-input"/>
                                            <span class="selectgroup-button">Hitam</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="150" class="selectgroup-input"/>
                                            <span class="selectgroup-button">Navy</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="value" value="200" class="selectgroup-input"/>
                                            <span class="selectgroup-button">Maroon</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pengiriman" class="form-label">Metode Pengiriman</label>
                                    <select class="form-select" id="pengiriman" required>
                                        <option value="">Pilih metode pengiriman</option>
                                        <option value="reguler">J&T Express</option>
                                        <option value="ekspres">JNE</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="pembayaran" required>
                                        <option value="">Pilih metode pembayaran</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="kartukredit">Kartu Kredit</option>
                                        <option value="ewallet">E-Wallet</option>
                                    </select>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nama Produk 1</td>
                                            <td>1</td>
                                            <td>Rp 200.000</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Total</strong></td>
                                            <td><strong>Rp 350.000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="setuju" required>
                                    <label class="form-check-label" for="setuju">
                                        Saya setuju dengan syarat dan ketentuan pembelian
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Proses Pemesanan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>