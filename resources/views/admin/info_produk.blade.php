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
                      <li class="breadcrumb-item"><a href="#">Aksesoris</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Asus Vivobook OLED 15</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <h3>{{ $product->name }}</h3>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                <i class="fas fa-shopping-bag"></i>
                                10 Terjual
                                <span class="badge text-bg-primary"><strong>{{ $product->category->name }}</strong></span>
                            </h6>
                            <h1>Rp {{ number_format($product->price, 0, ',', '.') }}</h1>
                            <p>{{ $product->description }}</p>
                            <h5 class="mt-4">Varian Produk</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Varian</th>
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
                            <div class="mt-4">
                                <a href="/edit_produk/{{ $product['id'] }}" class="btn btn-warning"><i class="far fa-edit"></i> Edit Produk</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="far fa-trash-alt"></i> Hapus Produk</button>
                                <a href="/kelola_produk" class="btn btn-primary"><i class="fas fa-angle-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/hapus_produk/{{ $product['id'] }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin menghapus produk ini?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let variantCount = {{ count($product->product_variants) }};
        
        document.getElementById('add-variant').addEventListener('click', function() {
            const variantHtml = `
                <div class="variant mb-3">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="product_variants[${variantCount}][name]" placeholder="Nama Varian" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="product_variants[${variantCount}][stock]" placeholder="Stok" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger remove-variant">Hapus</button>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('variants').insertAdjacentHTML('beforeend', variantHtml);
            variantCount++;
        });
        
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-variant')) {
                e.target.closest('.variant').remove();
            }
        });
    </script>

</x-layout_dua>