<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <style>
        @media print {
            /* Hanya tampilkan bagian yang ingin dicetak */
            body * {
                visibility: hidden;
            }
    
            #printableArea, #printableArea * {
                visibility: visible;
            }
    
            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
            }
    
            /* Contoh, sembunyikan tombol cetak */
            .no-print {
                display: none;
            }
        }
    </style>
    
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/dashsboard">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="/kelola_produk">Pesanan</a></li>
                      <li class="breadcrumb-item"><a href="/kelola_produk">Cetak Lembar Pengiriman</a></li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $order->product->name }}</li>
                    </ol>
                </nav>
            </div>
            <div id="printableArea">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <h5>Penerima</h5>
                                <span>Nama : {{ $order->name }}</span><br>
                                <span>Telepon : {{ $order->telp }}</span><br>
                                <span>Alamat : {{ $order->address->desa }}, {{ $order->address->kecamatan }}, {{ $cityName }}, {{ $provinceName }}, {{ $order->address->kode_pos }}, {{ $order->address->alamat }}</span>
                            </div>
                            <div class="col-md-5">
                                <h5>Pengirim</h5>
                                <span>Nama : Toko Erlan</span><br>
                                <span>Telepon : 082220633024</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Detail Pesanan</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>{{ $order->product->name }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>Rp {{ number_format($order->product->price, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row-mt-4">
                            <span>Metode Pembayaran : <strong>{{ $order->payment_method == "bank_transfer" ? 'Transfer Bank' : 'COD' }}</strong></span><br>
                            <span>Jasa Pengiriman : <strong>{{ strtoupper($order->courier) }}</strong></span><br>
                            <span>Tanggal Pemesanan : {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-right">
                                <h4>Total yang harus dibayar : Rp {{ $order->payment_method == "cash_on_delivery" ? number_format($order->total_price, 0, ',', '.') : 0 }}</h4>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <a href="/kelola_pesanan" class="btn btn-primary no-print">Kembali</a>
                                <button onclick="window.print();" class="btn btn-success no-print">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout_dua>