<x-layout_dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>Invoice</h1>
                            <h4>Order ID: {{ $order->id }}</h4>
                            <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Customer Information</h5>
                            <p>Name: {{ $order->customer_name }}</p>
                            <p>Email: {{ $order->customer_email }}</p>
                            <p>Address: {{ $order->customer_address }}</p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Order Details</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>{{ $order->product->name }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ number_format($order->price, 2) }}</td>
                                            <td>{{ number_format($order->quantity * $order->price, 2) }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-right">
                            <h4>Total: {{ number_format($order->total, 2) }}</h4>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="?kelola_pesanan" class="btn btn-primary">Back to Orders</a>
                            <button onclick="window.print();" class="btn btn-success">Print Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</x-layout_dua>