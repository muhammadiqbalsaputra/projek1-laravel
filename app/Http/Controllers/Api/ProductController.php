<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::latest()->paginate(10);
        return new ProductResource($products, 200, 'List Data Product');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product = new Products;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_category_id = $request->product_category_id;
        $product->is_active = $request->has('is_active') ? $request->is_active : true;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }
        $product->save();
        return new ProductResource($product, 201, 'Product Category Created Successfully');
    }
    public function show($id)
    {
        $product = Products::findOrFail($id);
        return new ProductResource($product, 200, 'Product Details');
    }


    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->product_category_id = $request->product_category_id;
        $product->is_active = $request->has('is_active') ? $request->is_active : true;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }
        $product->save();
        return new ProductResource($product, 201, 'Product Updated Successfully');
    }
}
