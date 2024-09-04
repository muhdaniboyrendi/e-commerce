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
            <div class="alert alert-info text-center">
                <h2>Pembayaran via Transfer Bank</h2>
                <p>Silakan transfer ke rekening berikut untuk menyelesaikan pembayaran Anda:</p>
                <ul class="list-unstyled">
                    <li><strong>Bank:</strong> Bank BRI</li>
                    <li><strong>Nomor Rekening:</strong> 729801016522537</li>
                    <li><strong>Atas Nama:</strong> Muhdani Boyrendi Erlan Azhari</li>
                    <li><strong>Total Bayar:</strong> Rp {{ number_format(session('total_price'), 0, ',', '.') }} </li>
                </ul>
                <p>Setelah melakukan transfer, harap konfirmasi pembayaran Anda dengan mengirimkan bukti transfer.</p>
                <!-- Payment Confirmation Form -->
                <form action="/payment/confirm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ session('order_id') }}">
                    <div class="form-group">
                        <label for="payment_proof">Unggah Bukti Pembayaran:</label>
                        <input type="file" name="payment_proof" class="form-control" required>
                    </div>
                    <label class="text-danger" for="payment_proof"><strong>* Dimohon untuk tidak meninggalkan halaman ini sebelum mengunggah bukti pembayaran</strong></label>
                    <br>
                    <button type="submit" class="btn btn-success mt-2">Konfirmasi Pembayaran</button>
                </form>
            </div>
        </div>
    </div>


</x-layout>