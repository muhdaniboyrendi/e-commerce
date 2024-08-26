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
                    <h1>Pemesanan Berhasil!</h1>
                    <p>Total Pembayaran Anda adalah Rp {{ session('total_payment') }}</p>
                    <a href="/">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

</x-layout_dua>