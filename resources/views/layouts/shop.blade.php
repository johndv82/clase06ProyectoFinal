<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Shop'))</title>

    @vite(['resources/sass/shop.scss', 'resources/js/app.js'])
</head>
<body class="shop-body">
    <header class="shop-header">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <a href="{{ route('shop.products.index') }}" class="shop-logo">{{ config('app.name', 'Shop') }}</a>
            <nav class="shop-nav">
                @auth
                    <a href="{{ route('shop.cart.index') }}" class="shop-link">🛒 Carrito</a>
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('shop.orders.index') }}">Mis Órdenes</a></li>
                        @if(Auth::user()->is_admin)
                            <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Panel Admin</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="shop-link">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="shop-link">Registrarse</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="shop-content py-4">
        <div class="container">

            {{-- Mensajes Flash --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="shop-footer text-center py-3">
        <small>&copy; {{ date('Y') }} {{ config('app.name', 'Shop') }} — Todos los derechos reservados.</small>
    </footer>
</body>
</html>