<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        return view('shop.cart.index', compact('cart'));
    }

    public function add(Product $product, Request $request) {
        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Producto añadido al carrito');
    }

    public function remove(Product $product) {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function clear() {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado');
    }
}
