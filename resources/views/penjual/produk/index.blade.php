<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">

            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-0">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Kelola Produk</li>
                    </ol>
                </nav>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Penambahan Produk Gagal! </strong><br>
                    <span> Pastikan semua data produk yang anda masukan valid!</span>
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
                    <form action="/search" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" placeholder="Search ..." class="form-control" value="{{ isset($filter) ? $filter : '' }}"/>
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
            <table class="table table-striped table-hover" id="dataTable">
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
                    @foreach($products as $item)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>
                            @foreach($item->product_variants as $variant)
                                {{ $variant->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->product_variants as $variant)
                                {{ $variant->stock }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="/detail_produk/{{ $item['id'] }}" class="btn btn-xs btn-info">Detail</a>
                            <a href="/edit_produk/{{ $item['id'] }}" class="btn btn-xs btn-warning"><i class="far fa-edit"></i></a>
                            <form action="/hapus_produk/{{ $item['id'] }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                {{ isset($message) && $message != '' ? $message : '' }}
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $products->links() }}
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
                        <form action="/tambah_produk" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="text" inputmode="numeric" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" value="{{ old('image', $product->image) }}" multiple required>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" value="{{ old('category_id', $product->category_id) }}" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div id="variants">
                                    <h3>Varian</h3>
                                    <div class="variant mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control @error('product_variants[0][name]') is-invalid @enderror" name="product_variants[0][name]" placeholder="Nama Varian">
                                                @error("product_variants[0][name]")
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <input type="number" class="form-control @error('product_variants[0][stock]') is-invalid @enderror" name="product_variants[0][stock]" placeholder="Stok" required>
                                                @error("product_variants[0][stock]")
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info mb-3" onclick="addVariant()">Tambah Varian</button>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan Produk</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Include jQuery, DataTables JS, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let variantCount = 1;
        
        function addVariant() {
            const variantHtml = `
                <div class="variant mb-3">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="variants[${variantCount}][name]" placeholder="Nama Varian" required>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="variants[${variantCount}][stock]" placeholder="Stok" required>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('variants').insertAdjacentHTML('beforeend', variantHtml);
            variantCount++;
        }
    </script>


</x-layout>