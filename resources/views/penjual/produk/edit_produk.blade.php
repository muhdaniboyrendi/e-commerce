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
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="/edit_produk/{{ $product['id'] }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description" class="form-label">Deskripsi Produk</label>
                                    <textarea name="description" class="form-control" id="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price" class="form-label">Harga Produk</label>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="Nama Produk" value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form_label">Ubah Gambar</label>
                                    <input class="form-control" type="file" id="image" name="image" value="{{ old('image', $product->image) }}">
                                    @error('image')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div id="variants">
                                        <h3>Varian Produk</h3>
                                        @foreach($product->product_variants as $variant)
                                            <div class="variant mb-3">
                                                <input type="hidden" name="product_variants[0][id]" value="{{ $variant->id }}">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="product_variants[0][name]" placeholder="Nama Varian" value="{{ $variant['name'] }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" class="form-control" name="product_variants[0][stock]" placeholder="Stok" value="{{ $variant['stock'] }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-secondary mb-3" id="add-variant">Tambah Varian</button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success mt-1">Simpan Perubahan</button>
                                    <a href="/kelola_produk" type="submit" class="btn btn-primary mt-1">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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