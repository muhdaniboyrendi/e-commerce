<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Produk</a></li>
                      <li class="breadcrumb-item"><a href="#">Checkout</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Payment</li>
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
                    <div class="alert alert-info text-center">
                        <h2>Pembayaran via Transfer Bank</h2>
                        <p>Silakan transfer ke rekening berikut untuk menyelesaikan pembayaran Anda:</p>
                        <ul class="list-unstyled">
                            <li><strong>Bank:</strong> Bank BRI</li>
                            <li><strong>Nomor Rekening:</strong> 1234567890</li>
                            <li><strong>Atas Nama:</strong> Muhdani Boyrendi Erlan Azhari</li>
                            <li><strong>Total Bayar:</strong> Rp {{ number_format($totalPrice, 0, ',', '.') }}</li>
                        </ul>
                        <p>Setelah melakukan pembayaran, harap konfirmasi melalui halaman konfirmasi pembayaran.</p>
                        <a href="{{ route('order.confirmation', ['order_id' => $orderId]) }}" class="btn btn-primary mt-3">Konfirmasi Pembayaran</a>
                    </div>
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
                        $('#shipping_cost').text(shippingCost.toLocaleString('id-ID'));
                        
                        var totalPayment = productPrice + shippingCost;
                        $('#total_payment').text(totalPayment.toLocaleString('id-ID'));
                        $('#total_payment').val(totalPayment.toLocaleString('id-ID'));
                    });
                }
            });
        });
    </script>

</x-layout>