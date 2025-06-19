<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use \Binafy\LaravelCart\Models\Cart;

class HomepageController extends Controller
{
    private $themeFolder;
    public function __construct()
    {
        $this->themeFolder = 'web';
    }

    public function index()
    {
        $categories = Categories::latest()->take(4)->get();
        $products = Products::paginate(20);
        return view($this->themeFolder . '.homepage', [
            'categories' => $categories,
            'products' => $products,
            'title' => 'Homepage'
        ]);
    }

    public function products(Request $request)
    {
        $title = "Products";
        $query = Products::query();
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(20);
        return view($this->themeFolder . '.products', [
            'title' => $title,
            'products' => $products,
        ]);
    }

    public function product($slug)
    {
        $product = Products::whereSlug($slug)->first();
        if (!$product) {
            return abort(404);
        }
        $relatedProducts = Products::where('category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        return view($this->themeFolder . '.product', [
            'slug' => $slug,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
    public function categories()
    {
        $categories = Categories::latest()->paginate(20);
        return view($this->themeFolder . '.categories', [
            'title' => 'Categories',
            'categories' => $categories,
        ]);
    }
    public function category($slug)
    {
        $category = Categories::whereSlug($slug)->first();
        if ($category) {
            $products = Products::where('category_id', $category->id)->paginate(20);
            return view($this->themeFolder . '.category_by_slug', [
                'slug' => $slug,
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            return abort(404);
        }
    }
    public function cart()
    {
        $cart = Cart::query()
            ->with(
                [
                    'items',
                    'items.itemable'
                ]
            )
            ->where('user_id', auth()->guard('customer')->user()->id)
            ->first();
        return view($this->themeFolder . '.cart', [
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }
    public function checkout()
    {
        return view(
            $this->themeFolder . '.checkout',
            ['title' => 'Checkout']
        );
    }

    // public function login()
    // {
    //     return view('web.login',[
    //         'title'=>'Login'
    //     ]);
    // }
    public function register()
    {
        return view('web.register', [
            'title' => 'Register'
        ]);
    }


}
