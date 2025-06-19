<x-layout>
    <x-slot name="title"> Categories</x-slot>
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 style="font-size: 1.5rem;">Kategori Product</h3>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ URL::to('/category/' . $category->slug) }}" class="card text-decoration-none">
                        <div class="card category-card text-center h-100 py-3 border-0 shadow-sm">
                            <div class="mx-auto mb-2"
                                style="width:64px;height:64px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border-radius:50%;">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}"
                                    style="width:36px;height:36px;object-fit:contain;">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="card-title mb-1 text-light">{{ $category->name }}</h6>
                                <p class="card-text text-muted small text-truncate">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center w-100 mt-4">
            {{ $categories->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>
</x-layout>
