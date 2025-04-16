<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class HomepageController extends Controller
{
    public function index()
    {
        $title = 'Homepage';
        $categories = Categories::all();

        return view('web.homepage', [
            'categories' => $categories,
            'title' => $title
        ]);
    }

    public function products()
    {
        $title = 'Products';
        return view('web.products', ['title' => $title]);
    }

    public function producT($slug)
    {
        return view('web.product', ['slug' => $slug]);
    }

    public function categories()
    {
        return view('web.categories');
    }
    public function category($slug)
    {
        $category = Categories::find($slug);
        return view('web.category_by_slug', ['slug' => $slug, 'category' => $category]);
    }
    public function cart()
    {
        return view('web.cart');
    }
    public function checkout()
    {
        return view('web.checkout');
    }


}
