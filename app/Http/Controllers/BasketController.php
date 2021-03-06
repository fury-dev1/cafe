<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $categories = Category::get();

        $orderId = session('orderId');

        $order = Order::find($orderId);

        if (is_null($order)) {
            $orderId = Order::create()->id;
            session(['orderId' => $orderId]);
            return redirect()->route('index');
        }

        $quantity = null;
        foreach ($order->products as $product) {
            $quantity += $product->pivot->count;
        }

        return view('basket', compact('categories', 'order', 'quantity'));
    }

    public function orderCheck()
    {
        $categories = Category::get();

        $orderId = session('orderId');

        $order = Order::find($orderId);

        if (is_null($order)) {
            return redirect()->route('index');
        }

        $quantity = null;
        foreach ($order->products as $product) {
            $quantity += $product->pivot->count;
        }

        return view('order', compact('categories', 'quantity', 'order'));
    }

    public function orderConfirm(Request $request)
    {
        $orderId = session('orderId');

        $order = Order::find($orderId);

        if (is_null($order)) {
            return redirect()->route('index');
        }

        $orderResult = $order->saveOrder($request->name, $request->phone);

        if ($orderResult) {
            session()->flash('message', 'Заказ оформлен успешно!');
        } else {
            session()->flash('message', 'Ошибка при заказе!');
        }

        return redirect()->route('index');
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if (is_null($order)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
//            dd($pivotRow);
        } else {
            $order->products()->attach($productId);
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($productId);

        session()->flash('message', $product->name . ' добавлен в корзину!');

        return redirect()->route('basket');
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');

        $order = Order::find($orderId);

        if (is_null($order->products)) {
            return redirect()->route('index');
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        $product = Product::find($productId);

        session()->flash('message', $product->name . ' удалён из корзины!');

        return redirect()->route('basket');
    }
}
