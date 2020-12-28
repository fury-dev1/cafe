<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;

class NotEmptyBasket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
            if ($order->products->count() < 1) {
                session()->flash('message', 'Корзина пуста, добавьте товары!');
                return redirect()->route('index');
            }

        }

        return $next($request);
    }
}