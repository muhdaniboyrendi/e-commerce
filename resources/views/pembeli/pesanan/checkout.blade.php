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
                                    <label for="no_hp">Nomor HP:</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">Provinsi:</label>
                                    <select id="province" name="province" class="form-control" required>
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city">Kabupaten/Kota:</label>
                                    <select id="city" name="city" class="form-control" required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subdistrict">Kecamatan:</label>
                                    <input type="text" id="subdistrict" name="subdistrict" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="village">Kelurahan/Desa:</label>
                                    <input type="text" id="village" name="village" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Kode POS:</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" required>
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
                                    <label for="courier">Kurir:</label>
                                    <select id="courier" name="courier" class="form-control" required>
                                        <option value="jne">JNE</option>
                                        <option value="jnt">J&T</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS Indonesia</option>
                                    </select>
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
                                    <input type="hidden" name="total_payment" value="{{ number_format($product->price * $quantity, 0, ',', '.') }}">
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
                $('#province').empty().append('<option value="">Pilih Provinsi</option>');
                $.each(data, function (index, province) {
                    $('#province').append('<option value="' + province.province_id + '">' + province.province + '</option>');
                });
            });

            // Load cities when a province is selected
            $('#province').on('change', function () {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.get('/cities/' + provinceId, function (data) {
                        $('#city').empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                        $.each(data, function (index, city) {
                            $('#city').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                        });
                    });
                }
            });

            // Calculate shipping cost and update total payment
            $('#courier, #city').on('change', function () {
                var cityId = $('#city').val();
                var courier = $('#courier').val();
                var weight = 1000; // default weight in grams
                var productPrice = {{ $product->price * $quantity }};

                if (cityId && courier) {
                    $.get('/calculate-shipping/' + cityId + '/' + courier + '/' + weight, function (data) {
                        var shippingCost = parseInt(data.cost);
                        $('#shipping_cost').text(shippingCost.toLocaleString('id-ID'));
                        
                        var totalPayment = productPrice + shippingCost;
                        $('#total_payment').text(totalPayment.toLocaleString('id-ID'));
                    });
                }
            });

            // Handle form submission
            $('form').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.post('/checkout', formData, function (response) {
                    // Redirect to success page or display a confirmation message
                    window.location.href = '/success';
                }).fail(function (response) {
                    // Handle error, show a message or highlight invalid fields
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            });
        });
    </script>

</x-layout_dua>