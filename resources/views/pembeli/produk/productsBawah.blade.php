<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Toko Erlan</a></li>
                      <li class="breadcrumb-item"><a href="#">Produk</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Pakaian Bawah</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Pakaian Bawah</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card">
                            <a href="/info_produk/{{ $item['id'] }}">
                                <img src="/img/thumbnail/laptop.jpg" class="card-img-top">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $item->name }}</h6>
                                    <h6 class="card-subtitle mb-2 text-body-secondary"><strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong></h6>
                                    <span class="badge text-bg-primary">{{ $item->category->name }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layout>