@extends('layouts.shop')

@section('title', 'Mi carrito')

@section('content')
<div class="shop-cart-container">
    <h2 class="mb-4">🛒 Mi carrito</h2>

    @if(empty($cart))
        <div class="text-center py-5">
            <p class="lead">Tu carrito está vacío 😔</p>
            <a href="{{ route('shop.products.index') }}" class="btn btn-primary">Explorar productos</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Precio</th>
                        <th class="text-end">Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                     class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                                <div>
                                    <strong>{{ $item['name'] }}</strong><br>
                                </div>
                            </td>
                            <td class="text-center">{{ $item['quantity'] }}</td>
                            <td class="text-end">S/ {{ number_format($item['price'], 2) }}</td>
                            <td class="text-end">S/ {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="text-end">
                                <form action="{{ route('shop.cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Quitar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td class="text-end">
                            <strong>S/ {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}</strong>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('shop.cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Vaciar carrito
                </button>
            </form>

            <form action="{{ route('shop.order.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check2-circle"></i> Procesar orden
                </button>
            </form>
        </div>
    @endif
</div>
@endsection