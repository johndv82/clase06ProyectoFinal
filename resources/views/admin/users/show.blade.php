@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Usuario</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ $user->is_admin ? 'Administrador' : 'Cliente' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection