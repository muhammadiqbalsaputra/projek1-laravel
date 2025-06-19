<x-layouts.app :title="'Edit Category'">
    <div class="max-w-2xl mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</x-layouts.app>
