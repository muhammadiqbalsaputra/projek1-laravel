<x-layouts.app :title="__('Dashboard')">
    <div class="container mx-auto mt-8 px-4">
        <h1 class="text-2xl font-semibold mb-6">Product Categories</h1>
        
        <div class="mb-4 flex justify-end">
            <a href="{{ route('categories.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add Category
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-4 text-left border-b">No.</th>
                        <th class="py-3 px-4 text-left border-b">Name</th>
                        <th class="py-3 px-4 text-left border-b">Slug</th>
                        <th class="py-3 px-4 text-left border-b">Description</th>
                        <th class="py-3 px-4 text-left border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr class="border-b hover:bg-gray-100 text-black">
                            <td class="py-2 px-4">{{ $key + 1 }}</td>
                            <td class="py-2 px-4">{{ $category->name }}</td>
                            <td class="py-2 px-4">{{ $category->slug }}</td>
                            <td class="py-2 px-4">{{ $category->description }}</td>
                            <td class="py-2 px-4 space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="inline-block bg-yellow-400 text-white px-3 py-1 text-sm rounded hover:bg-yellow-500 transition">
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
