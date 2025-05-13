<x-layouts.app :title="__('Products')">
    <div class="container mt-4">
        <h1 class="text-center text-5xl text-bold">PRODUCTS</h1>

        <flux:button as="a" href="{{ route('products.create') }}" variant="filled" color="green">
            Add New Product
        </flux:button>
        
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
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="{{ route('categories.edit', $product->id) }}"
                                    class="inline-block px-3 py-1 text-xs font-medium text-black bg-yellow-400 hover:bg-yellow-500 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $product->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




        {{-- <flux:table>
            <flux:table.columns>
                <flux:table.column>No. </flux:table.column>
                <flux:table.column>Image</flux:table.column>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Slug</flux:table.column>
                <flux:table.column>Description</flux:table.column>
                <flux:table.column>Price</flux:table.column>
                <flux:table.column>Stock</flux:table.column>
                <flux:table.column>Action</flux:table.column>
            </flux:table.columns> --}}

        {{-- <flux:table.rows>
                <flux:table.row>
                    <flux:table.cell>Lindsey Aminoff</flux:table.cell>
                    <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell variant="strong">$49.00</flux:table.cell>
                </flux:table.row>

                <flux:table.row>
                    <flux:table.cell>Hanna Lubin</flux:table.cell>
                    <flux:table.cell>Jul 28, 2:15 PM</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell variant="strong">$312.00</flux:table.cell>
                </flux:table.row>

                <flux:table.row>
                    <flux:table.cell>Kianna Bushevi</flux:table.cell>
                    <flux:table.cell>Jul 30, 4:05 PM</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="zinc" size="sm" inset="top bottom">Refunded</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell variant="strong">$132.00</flux:table.cell>
                </flux:table.row>

                <flux:table.row>
                    <flux:table.cell>Gustavo Geidt</flux:table.cell>
                    <flux:table.cell>Jul 27, 9:30 AM</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell variant="strong">$31.00</flux:table.cell>
                </flux:table.row>
            </flux:table.rows> --}}
        {{-- </flux:table> --}}

        {{-- <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th> 
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th> 
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image" width="60">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
</x-layouts.app>
