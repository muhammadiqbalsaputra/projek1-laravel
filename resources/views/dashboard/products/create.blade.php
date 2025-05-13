<x-layouts.app>
    <div class="mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold text-white">Add New Product</h1>
            <a href="{{ route('products.index') }}"
                class="bg-black text-white font-bold py-2 px-4 rounded hover:bg-gray-800">
                Back to List
            </a>
        </div>

        <!-- Form -->
        <div class="bg-gray-800 rounded-lg shadow p-6">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-300">Category</label>
                        <select name="category_id" id="category_id"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                            min="0"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-300">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}"
                            min="0"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image URL -->
                    <!-- Image URL -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-300">Image URL</label>
                        <input type="text" name="image" id="image" value="{{ old('image') }}"
                            placeholder="https://example.com/image.jpg"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-700 bg-gray-900 text-white rounded-md focus:ring-blue-500 focus:border-blue-500">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-black hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
