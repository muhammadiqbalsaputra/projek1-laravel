<x-layouts.app :title="__('Create Category')">
    <div class="container mx-auto mt-8 px-4 max-w-2xl">
        <h1 class="text-2xl font-semibold mb-6">Create New Category</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4 text-black">
                <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name" id="name"
                       class="text-black w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-gray-700 font-medium mb-1">Slug</label>
                <input type="text" name="slug" id="slug"
                       class="text-black w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                       value="{{ old('slug') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="text-black w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
