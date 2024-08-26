<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>
      
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Produk Kami</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="card">
                            <a href="/detail_produk/{{ $item['id'] }}">
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