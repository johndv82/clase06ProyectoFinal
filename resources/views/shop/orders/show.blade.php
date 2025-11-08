@extends('layouts.shop')

@section('title', 'Detalle de Orden #' . $order->id)

@section('content')
<h1 class="mb-4">Orden #{{ $order->id }}</h1>

<div class="mb-3">
    <strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }} <br>
    <strong>Total:</strong> S/. {{ number_format($order->total, 2) }}
</div>

<h4>Productos</h4>
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td width="80">
                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                             alt="{{ $item->product->name }}" 
                             class="img-fluid rounded" 
                             style="max-height: 60px; object-fit: cover;">
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>S/. {{ number_format($item->price, 2) }}</td>
                    <td>S/. {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('shop.orders.index') }}" class="btn btn-secondary mt-3">
    ← Volver a Mis Órdenes
</a>
@endsection