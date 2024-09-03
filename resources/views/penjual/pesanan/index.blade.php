<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item active" aria-current="page">kelola Pesanan</li>
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
                <div class="input-group">
                    <div class="col-md-4">
                        <input type="text" id="searchBar" class="form-control" name="search" placeholder="Cari pesanan...">
                    </div>
                    <div class="col-md-3">
                        <select id="searchSelect" class="form-control" name="search">
                            <option value="" selected>Filter Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status['id'] }}">{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
    
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama Pembeli</th>
                        <th>Produk</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataOrder">
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }} ({{ $order->variant->name ?? 'N/A' }})</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y || H:i') }}</td>
                            <td><span class="badge text-bg-{{ $order->status->color }}">{{ $order->status->name }}</span></td>
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

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        $(document).ready(function() {
            // fungsi search
            function fetchOrders(query = '', status = '') {
                $.ajax({
                    url: "/search_order",
                    method: 'GET',
                    data: {
                        query: query,
                        status: status
                    },
                    success: function(response) {
                        // Clear the existing content
                        $('#dataOrder').empty();
                        
                        // Loop through each order in the response data
                        response.orders.forEach(function(order) {
                            let product = order.product ? order.product.name : 'N/A';
                            let variant = order.variant ? order.variant.name : 'N/A';
                            let totalPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(order.total_price);
                            let orderDate = order.created_at;
                            let formattedDate = moment(orderDate).format('D MMMM YYYY || HH:mm');
                            let statusBadge = `<span class="badge text-bg-${order.status.color}">${order.status.name}</span>`;
    
                            // Append the new row to the table body
                            $('#dataOrder').append(`
                                <tr>
                                    <td>${order.name}</td>
                                    <td>${product} (${variant})</td>
                                    <td>${totalPrice}</td>
                                    <td>${formattedDate}</td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="#" class="btn btn-xs btn-info" data-order-id="${order.id}" data-bs-toggle="modal" data-bs-target="#detailPesananModal">
                                                Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }
    
            $('#searchBar').on('keyup', function() {
                var query = $(this).val();
                var status = $('#searchSelect').val();
                fetchOrders(query, status);
            });
    
            $('#searchSelect').on('change', function() {
                var query = $('#searchBar').val();
                var status = $(this).val();
                fetchOrders(query, status);
            });


            // fungsi view detail pesanan
            $('.btn-info').on('click', function() {
                var orderId = $(this).data('order-id'); // Mendapatkan ID pesanan dari tombol
                console.log('hallo');

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
                                        : <strong>${response.status}</strong>
                                    </div>
                                </div>
                                <h6 class="mt-3"><strong>Perbarui Status</strong></h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="order_id" id="order_id" value="${response.id}">
                                            <select class="form-select" name="status" id="orderStatus">
                                                <option>Status</option>
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
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