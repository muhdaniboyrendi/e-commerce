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
                      <li class="breadcrumb-item"><a href="#">Aksesoris</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Asus Vivobook OLED 15</li>
                    </ol>
                </nav>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h1 class="mb-4">Kelola Pesanan</h1>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari pesanan...">
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>Filter Status</option>
                        <option value="1">Menunggu Pembayaran</option>
                        <option value="2">Diproses</option>
                        <option value="3">Dikirim</option>
                        <option value="4">Selesai</option>
                        <option value="5">Dibatalkan</option>
                    </select>
                </div>
            </div>
    
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama Pembeli</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }} ({{ $order->variant->name ?? 'N/A' }})</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-xs btn-info" data-order-id="{{ $order->id }}" data-bs-toggle="modal" data-bs-target="#detailPesananModal">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
        
            <!-- Modal Detail Pesanan -->
            <div class="modal fade" id="detailPesananModal" tabindex="-1" aria-labelledby="detailPesananModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="detailPesananModalLabel"><strong>Detail Pesanan</strong></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/update_pesanan" method="POST">
                            @csrf
                            <div class="modal-body">

                                <div id="orderDetails">
                                    <!-- Detail Pesanan akan dimuat di sini melalui AJAX -->
                                </div>

                                <div id="buktiPembayaran">

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-info').on('click', function() {
                var orderId = $(this).data('order-id'); // Mendapatkan ID pesanan dari tombol
                $('#order_id').val(orderId); // Mengisi input hidden di form dengan ID pesanan

                // Melakukan AJAX request untuk mendapatkan detail pesanan
                $.ajax({
                    url: '/orders/' + orderId,
                    method: 'GET',
                    success: function(response) {
                        const paymentProof =
                            `<div class="row">
                                <div class="col">
                                    <h5 class="mt-3"><strong>Bukti Pembayaran</strong></h5>
                                    <img src="{{ asset('storage/${response.payment_proof}') }}" class="card-img-top">
                                </div>    
                            </div> `;

                        // Mengisi modal dengan data pesanan yang diterima dari server
                        $('#orderDetails').html(`
                        <div class="row">
                            <div class="col">
                                <h5><strong>Informasi Pelanggan</strong></h5>
                                <div class="row">
                                    <div class="col-md-2">
                                        Nama
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.name}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Telepon
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.telp}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Email
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.email}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Alamat
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.desa}, ${response.kecamatan}, ${response.kota}, ${response.provinsi}, ${response.kode_pos}, ${response.alamat}
                                    </div>
                                </div>
                                <h5 class="mt-3"><strong>Informasi Produk</strong></h5>
                                <div class="row">
                                    <div class="col-md-2">
                                        Nama
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.product_name}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Varian
                                    </div>
                                    <div class="col-md-10">
                                        : ${response.variant}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        Harga
                                    </div>
                                    <div class="col-md-10">
                                        : Rp ${response.price}
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <h5 class="pt-0"><strong>Informasi Pesanan</strong></h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        Jumlah
                                    </div>
                                    <div class="col-md-9">
                                        : ${response.quantity}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Kurir
                                    </div>
                                    <div class="col-md-9">
                                        : ${response.courier}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Pembayaran
                                    </div>
                                    <div class="col-md-9">
                                        : ${response.payment_method}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Subtotal
                                    </div>
                                    <div class="col-md-9">
                                        : Rp ${response.total_price}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        Status
                                    </div>
                                    <div class="col-md-9">
                                        : ${response.status}
                                    </div>
                                </div>
                                <h6 class="mt-3"><strong>Perbarui Status</strong></h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="status" id="orderStatus">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}" {{  }}>{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary" id="button-addon2">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        ${response.payment_method == 'bank_transfer' ? paymentProof : ''}
                        `);
                    },
                    error: function() {
                        alert('Gagal memuat detail pesanan.');
                    }
                });
                
            });
        });
    </script>


</x-layout>