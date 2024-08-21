<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h1 class="mb-4">Kelola Produk</h1>
            
            <div class="row mb-3">
                <div class="col">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
                    </button>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari produk...">
                </div>
            </div>
    
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Varian</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>Rp {{ $item['price'] }}</td>
                        @foreach ($item->product_variants as $variant)
                            <td>{{ $variant['size'] }} | {{ $variant['color'] }}</td>
                            <td>{{ $variant['stock'] }}</td>
                        @endforeach
                        <td>
                            <form action="/hapus_produk/{{ $item['id'] }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @method('delete')
                                @csrf
                                <a href="/edit_produk/{{ $item['id'] }}" class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></a>
                                <button type="submit" id="btn-delete" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
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
        
            <!-- Modal Tambah Produk -->
            <div class="modal fade" id="tambahProdukModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="/kelola_produk" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" placeholder="Deskripsi Produk" value="{{ old('description', $product->description) }}" required></textarea>
                                    @error('description')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" inputmode="numeric" name="price" class="form-control" id="price" placeholder="Harga Produk" value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select" id="category" name="category_id" required>
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form_label">Image</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                    @error('image')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <h5>Product Variants</h5>
                                <div id="product-variants">
                                    <div class="product-variant">
                                        <div class="mb-3">
                                            <label class="form_label" for="product_variants[0][size]">Size</label>
                                            <input class="form-control" type="text" id="product_variants[0][size]" name="product_variants[0][size]">
                                            @error("product_variants[0][size]")
                                                <div>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label" for="product_variants[0][color]">Color</label>
                                            <input class="form-control" type="text" id="product_variants[0][color]" name="product_variants[0][color]">
                                            @error("product_variants[0][color]")
                                                <div>{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form_label" for="product_variants[0][stock]">Stock</label>
                                            <input class="form-control" type="number" id="product_variants[0][stock]" name="product_variants[0][stock]" required>
                                            @error("product_variants[0][stock]")
                                                <div>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>