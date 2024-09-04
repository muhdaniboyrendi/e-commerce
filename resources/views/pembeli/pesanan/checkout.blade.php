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
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h2>Pemesanan</h2>
                    <form action="/order" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                        <input type="hidden" name="quantity" value="{{ $quantity }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Pembeli:</label>
                                    <input type="text" name="name" class="form-control @error('name') id-invalid @enderror" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telp">Nomor HP:</label>
                                    <input type="text" name="telp" class="form-control @error('telpl') id-invalid @enderror" required>
                                    @error('telp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control @error('email') id-invalid @enderror" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="provinsi">Provinsi:</label>
                                    <select id="provinsi" name="provinsi" class="form-control @error('provinsi') id-invalid @enderror" required>
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    @error('provinsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kabupaten/Kota:</label>
                                    <select id="kota" name="kota" class="form-control @error('kota') id-invalid @enderror" required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                    </select>
                                    @error('kota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan:</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control @error('kecamatan') id-invalid @enderror" required>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desa">Kelurahan/Desa:</label>
                                    <input type="text" id="desa" name="desa" class="form-control @error('desa') id-invalid @enderror" required>
                                    @error('desa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kode_pos">Kode POS:</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control @error('kode_pos') id-invalid @enderror" required>
                                    @error('kode_pos')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Detail Alamat:</label>
                                    <textarea name="alamat" class="form-control @error('alamat') id-invalid @enderror" rows="4" placeholder="(No. Rumah, Dusun rt/rw, Nama Jalan, Nama Gedung, dll.)" required></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="courier">Kurir:</label>
                                    <select id="courier" name="courier" class="form-control @error('courier') id-invalid @enderror" required>
                                        <option value="jne">JNE</option>
                                        <option value="jnt">J&T</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS Indonesia</option>
                                    </select>
                                    @error('courier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran:</label>
                                    <select name="payment_method" class="form-control @error('payment_method') id-invalid @enderror" required>
                                        <option value="bank_transfer">Transfer Bank</option>
                                        <option value="cash_on_delivery">Bayar di Tempat (COD)</option>
                                    </select>
                                    @error('payment_method')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h3>{{ $product->name }}</h3>
                                    <h6><strong>Varian: </strong>{{ $variant->name }}</h6>
                                    <h6><strong>Jumlah: </strong>{{ $quantity }}</h6>
                                    <h6><strong>Harga: </strong>Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</h6>
                                </div>
                                <div class="form-group">
                                    <h6><strong>Ongkos Kirim: </strong>Rp <span id="shipping_cost">0</span></h6>
                                </div>
                                <div class="form-group">
                                    <h4><strong>Total Pembayaran: </strong>Rp <span id="total_payment">{{ number_format($product->price * $quantity, 0, ',', '.') }}</span></h4>
                                    <input type="hidden" id="totalpayment" name="total_price">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Buat Pesanan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function () {
            // Load provinces
            $.get('/provinces', function (data) {
                $('#provinsi').empty().append('<option value="">Pilih Provinsi</option>');
                $.each(data, function (index, province) {
                    $('#provinsi').append('<option value="' + province.province_id + '">' + province.province + '</option>');
                });
            });

            // Load cities when a province is selected
            $('#provinsi').on('change', function () {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.get('/cities/' + provinceId, function (data) {
                        $('#kota').empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                        $.each(data, function (index, city) {
                            $('#kota').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                        });
                    });
                }
            });

            // Calculate shipping cost and update total payment
            $('#courier, #kota').on('change', function () {
                var cityId = $('#kota').val();
                var courier = $('#courier').val();
                var weight = 1000; // default weight in grams
                var productPrice = {{ $product->price * $quantity }};

                if (cityId && courier) {
                    $.get('/calculate-shipping/' + cityId + '/' + courier + '/' + weight, function (data) {
                        var shippingCost = parseInt(data.cost);
                        console.log(shippingCost);
                        $('#shipping_cost').text(shippingCost.toLocaleString('id-ID'));
                        
                        var totalPayment = productPrice + shippingCost;
                        $('#total_payment').text(totalPayment.toLocaleString('id-ID'));
                        $('#totalpayment').val(totalPayment);
                    });
                }
            });
        });
    </script>

</x-layout_dua>