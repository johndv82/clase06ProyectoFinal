<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();

        if ($search = $request->input('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->latest()->get();
        return view('shop.products.index', compact('products'));
    }

    public function show(Product $product) {
        return view('shop.products.show', compact('product'));
    }
}
