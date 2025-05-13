<x-layouts.app :title="__('Products')">
    <div class="container mt-4">
        <h1 class="text-center text-5xl text-bold">PRODUCTS</h1>

        <div class="flex items-center justify-between mt-4">
            {{-- Tombol Tambah --}}
            <flux:button as="a" href="{{ route('products.create') }}" variant="filled" color="green">
                Add New Product
            </flux:button>

            {{-- Refresh --}}
            <div class="ml-auto flex items-center space-x-2">
                <a href="{{ route('products.index') }}"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-md">
                    Refresh
                </a>
                </form>
            </div>
        </div>


        <div class="overflow-x-auto text-white shadow rounded-lg mt-4 p-4">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Stock</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach ($products as $key => $product)
                        <tr class="hover:bg-gray-800">
                            <td class="px-6 py-4 text-sm">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">
                                @if ($product->image)
                                    <img src="{{ $product->image }}" alt="Image"
                                        class="w-16 h-16 object-cover rounded-md border border-gray-700">
                                @else
                                    <span class="text-gray-400 text-sm italic">No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->slug }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->description }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->price }}</td>
                            <td class="px-6 py-4 text-sm">{{ $product->stock }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('products.show', $product->id) }}"
                                        class="px-3 py-1 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded">
                                        View
                                    </a>

                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="px-3 py-1 text-xs font-medium text-black bg-yellow-400 hover:bg-yellow-500 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
