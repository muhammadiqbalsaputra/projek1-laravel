<x-layouts.app :title="'Product Detail: ' . $product->name">
    <div class="container mt-8 text-white max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Product Detail</h1>

        <div class="bg-gray-800 p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <strong>Name:</strong>
                <p>{{ $product->name }}</p>
            </div>

            <div class="mb-4">
                <strong>Slug:</strong>
                <p>{{ $product->slug }}</p>
            </div>

            <div class="mb-4">
                <strong>Description:</strong>
                <p>{{ $product->description }}</p>
            </div>

            <div class="mb-4">
                <strong>Price:</strong>
                <p>Rp. {{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mb-4">
                <strong>Stock:</strong>
                <p>{{ $product->stock }}</p>
            </div>

            <div class="mb-4">
                <strong>Image:</strong><br>
                @if ($product->image)
                    <img src="{{ $product->image }}" alt="Product Image" class="w-48 h-48 object-cover mt-2 rounded">
                @else
                    <p class="italic text-gray-400">No image available</p>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('products.index') }}"
                    class="inline-block px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded">Back</a>
            </div>
        </div>
    </div>
</x-layouts.app>
