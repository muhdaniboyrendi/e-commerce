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
                      <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="../img/thumbnail/laptop.jpg" alt="Gambar Produk" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <h3>{{ $product->name }}</h3>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <span class="badge text-bg-primary"><strong>{{ $product->category->name }}</strong></span>
                            </h6>
                            <h1>Rp {{ number_format($product->price, 0, ',', '.') }}</h1>
                            <p>{{ $product->description }}</p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Varian</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->product_variants as $variant)
                                    <tr>
                                        <td>{{ $variant->name }}</td>
                                        <td>{{ $variant->stock }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <hr class="my-4 py-2">

                            <div class="col-md-5">
                                <form action="/order/{{ $product->id }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="variant_id">Pilih Varian:</label>
                                            <select name="variant_id" class="form-control" required>
                                                @foreach($product->product_variants as $variant)
                                                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="quantity">Jumlah:</label>
                                            <input type="number" name="quantity" class="form-control" min="1" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4"><i class="icon-basket"></i> Beli Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout_dua>