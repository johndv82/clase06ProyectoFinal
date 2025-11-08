<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'required',
            'image' => 'required|image',
            'price' => 'required|integer|min:0',
        ]);

        $path = $request->file('image')->store('products', 'public');
        $validated['image'] = $path;

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Producto creado');
    }

    public function edit(Product $product) {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Product $product, Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image',
        ]);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado');
    }
}
