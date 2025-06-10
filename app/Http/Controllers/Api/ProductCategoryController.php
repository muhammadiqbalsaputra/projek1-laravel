<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Categories;
use App\Http\Resources\ProductCategoryResource;
class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::latest()->paginate(10);
        return new ProductCategoryResource($categories, 200, 'List Data Product Category');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required'
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }
        $category->save();
        return new ProductCategoryResource($category, 201, 'Product Category Created Successfully');
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id);
        return new ProductCategoryResource($category, 200, 'Product Category Details', );
    }
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required'
        ]);
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $category = Categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }
        $category->save();
        return new ProductCategoryResource($category, 201, 'Product Category Updated Successfully');
    }

}