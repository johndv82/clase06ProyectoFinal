@extends('layouts.shop')

@section('title', 'Mis Órdenes')

@section('content')
<h1 class="mb-4">Mis Órdenes</h1>

@if ($orders->isEmpty())
    <div class="alert alert-info">
        Aún no has realizado ninguna orden.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>S/. {{ number_format($order->total, 2) }}</td>
                        <td>
                            <a href="{{ route('shop.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                Ver Detalle
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection