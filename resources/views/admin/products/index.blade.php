@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Productos</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Nuevo Producto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>S/ {{ number_format($product->price, 2) }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="60" height="60" class="rounded">
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No hay productos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection