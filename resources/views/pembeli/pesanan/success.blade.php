<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Pesanan</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Success</li>
                    </ol>
                </nav>
            </div>
            <div class="alert alert-success text-center">
                <h1>Pemesanan Berhasil!</h1>

                @if (session()->has('success'))
                    {{ session('success') }}
                @endif

                <p><strong>Pesanan anda akan segera kami proses, silahkan tunggu!</strong></p>

                @if (session()->has('total_price'))
                    <p>Siapkan uang anda ketika menerima pesanan anda, yaitu sebesar <strong>Rp {{ number_format(session('total_price'), 0, ',', '.') }}</strong></p>
                @endif
                        
                <a href="/">Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</x-layout_dua>