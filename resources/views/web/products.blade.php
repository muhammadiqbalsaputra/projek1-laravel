<x-layout>
    <x-slot name="title"> Products</x-slot>

    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem;">Product Kami</h3>
            <form action="{{ url()->current() }}" method="GET" class="d-flex" style="max-width: 300px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100 shadow-sm">
                        <img src="{{ $product->image_url ? $product->image_url : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                            class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-truncate">{{ $product->description }}</p>
                            <div class="mt-auto">
                                <span class="fw-bold text-primary">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}"
                                    class="btn btn-outline-primary btn-sm float-end">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info">Belum ada produk pada kategori
                        ini.</div>
                </div>
            @endforelse
            <div class="d-flex justify-content-center w-100 mt-4">
                {{ $products->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layout>
