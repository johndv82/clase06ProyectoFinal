@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Producto</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
            @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Precio (S/)</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required min="0">
            @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
            @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection