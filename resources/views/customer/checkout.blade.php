<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Produk</a></li>
                      <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                      <li class="breadcrumb-item"><a href="#">{{ $product->name }}</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2>Pemesanan</h2>
                    <form action="/checkout" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Pembeli:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Provinsi:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Kabupaten/Kota:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Kecamatan:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Kelurahan/Desa:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Kode POS:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Detail Alamat:</label>
                                    <textarea name="address" class="form-control" rows="4" placeholder="(No. Rumah, Dusun rt/rw, Nama Jalan, Nama Gedung, dll.)" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran:</label>
                                    <select name="payment_method" class="form-control" required>
                                        <option value="bank_transfer">Transfer Bank</option>
                                        <option value="credit_card">Kartu Debit</option>
                                        <option value="cash_on_delivery">Bayar di Tempat (COD)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shipping_service">Jasa Kirim:</label>
                                    <select name="shipping_service" class="form-control" required>
                                        <option value="jne">JNE</option>
                                        <option value="j&t">J&T</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS Indonesia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h3>{{ $product->name }}</h3>
                                    <h6><strong>Varian: </strong>{{ $variant->name }}</h6>
                                    <h6><strong>Jumlah: </strong>{{ $quantity }}</h6>
                                    <h6><strong>Total Harga: </strong>Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</h6>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Proses Pemesanan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout_dua>