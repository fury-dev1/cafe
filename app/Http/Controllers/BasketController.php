<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $categories = Category::get();

        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }

        return view('basket', compact('categories', 'order'));
    }

    public function order()
    {
        $categories = Category::get();
        return view('order', compact('categories'));
    }

    public function basketAdd($productId)
    {
        $categories = Category::get();

        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        $order->products()->attach($productId);

//        dump($order->products);

        return view('basket', compact('categories', 'order'));
    }
}
