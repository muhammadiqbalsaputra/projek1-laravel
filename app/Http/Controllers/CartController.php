<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use \Binafy\LaravelCart\Models\Cart;
use \Binafy\LaravelCart\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    private $cart;
    public function __construct()
    {
        $this->cart = Cart::query()->firstOrCreate(['user_id' => auth()->guard('customer')->user()->id]);
    }

    public function add(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Invalid input data.')
                ->withErrors($validator)
                ->withInput();
        }
        // Find the product
        $product = Products::findOrFail($request->product_id);
        // Check if the product is available
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk produk ini.');
        }
        $cartItem = new CartItem([
            'itemable_id' => $product->id,
            'itemable_type' => $product::class,
            'quantity' => $request->quantity,
        ]);
        $this->cart->items()->save($cartItem);
        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }
    public function remove($id)
    {
        $product = Products::findOrFail($id);
        $this->cart->removeItem($product);
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function update($id, Request $request)
    {
        $product = Products::findOrFail($id);
        if ($request->action == 'decrease') {
            $this->cart->decreaseQuantity(item: $product);
        } else if ($request->action == 'increase') {
            $this->cart->increaseQuantity(item: $product);
        }
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    
}
