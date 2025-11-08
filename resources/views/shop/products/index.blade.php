@extends('layouts.shop')

@section('title', 'Tienda')

@section('content')
    <div class="shop-header-bar d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="mb-3 mb-md-0">Tienda</h1>

        <form action="{{ route('home') }}" method="GET" class="shop-search-form d-flex">
            <input type="text" name="q" value="{{ old('q', $search ?? '') }}" class="shop-search-input" autocomplete="off"
                   placeholder="Buscar productos...">
            <button type="submit" class="shop-search-btn">🔍</button>
        </form>
    </div>

    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="product-info">
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted small">{{ Str::limit($product->description, 80) }}</p>
                    <div class="product-price">S/ {{ number_format($product->price, 2) }}</div>
                </div>
                <form action="{{ route('shop.cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add-cart">Añadir al carrito</button>
                </form>
            </div>
        @empty
            <p class="text-center text-muted mt-5">No se encontraron productos.</p>
        @endforelse
    </div>
@endsection