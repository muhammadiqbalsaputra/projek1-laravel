<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('dashboard.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all(); // pastikan data ini dikirim
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|url',  // Validasi URL
        ]);

        // Buat slug dari nama produk
        $validated['slug'] = Str::slug($validated['name']);

        // Simpan URL gambar jika ada dan pastikan gambar dapat diakses
        if ($request->filled('image')) {
            $imageUrl = $request->input('image');
            $headers = @get_headers($imageUrl);

            if (strpos($headers[0], '200') === false) {
                return back()->withErrors(['image' => 'The image URL is not accessible.'])->withInput();
            }

            $validated['image'] = $imageUrl;
        } else {
            $validated['image'] = null;  // Jika tidak ada URL gambar
        }

        // Simpan produk
        Products::create($validated);

        // Cek kategori apakah ada
        if (!Categories::where('id', $validated['category_id'])->exists()) {
            return back()->withErrors(['category_id' => 'Category does not exist.'])->withInput();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari produk berdasarkan ID, jika tidak ditemukan akan lempar 404
        $product = Products::findOrFail($id);

        // Ambil semua kategori untuk dropdown select
        $categories = Categories::all();

        // Kembalikan view dengan data product dan categories
        return view('dashboard.products.update', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Cek kategori apakah ada
        if (!Categories::where('id', $validated['category_id'])->exists()) {
            return back()->withErrors(['category_id' => 'Category does not exist.'])->withInput();
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        // Hapus file gambar jika ada
        if ($product->image && file_exists(public_path('storage/' . $product->image))) {
            unlink(public_path('storage/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

}
