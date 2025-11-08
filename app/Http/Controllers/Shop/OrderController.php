<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index() {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->get();
        return view('shop.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        // Verificar que la orden pertenezca al usuario autenticado o que sea admin
        if ($order->user_id !== $user->id && !Auth::user()->is_admin) {
            abort(403, 'No tienes permiso para ver esta orden.');
        }

        $order->load('items.product');

        return view('shop.orders.show', compact('order'));
    }

    
    public function checkout()
    {
        // Obtener el carrito desde la sesión
        $cart = session('cart', []);

        // Validar que no esté vacío
        if (empty($cart)) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total sumando precio × cantidad
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Usamos una transacción para asegurar integridad de datos
        DB::beginTransaction();

        try {
            // Crear la orden principal
            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
            ]);

            // Crear cada ítem relacionado a la orden
            foreach ($cart as $productId => $item) {
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            // Vaciar el carrito
            session()->forget('cart');

            // Confirmar la transacción
            DB::commit();

            // Redirigir con mensaje de éxito
            return redirect()
                ->route('shop.orders.index')
                ->with('success', 'Tu orden se ha procesado correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un problema al procesar tu orden.');
        }
    }
}
