<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->is('orders/history')) {
            $orders = Auth::user()->orders()->history()->latest()->paginate(10);
        } else {
            $orders = Auth::user()->orders()->current()->latest()->paginate(10);
        }

        return view('orders/index', ['orders' => $orders]);
    }

    public function create(Request $request, $key)
    {
        $cart = Cart::where('session', $request->cookie('carts'))->first();

        if (empty($cart) || $cart->key !== $key) {
            return redirect()->route('carts.index');
        }

        $order = Order::create([
            'is_paid' => true,
            'price' => $cart->price,
            'user_id' => Auth::user()->id,
            'retrieval_at' => $cart->getOriginal('retrieval_at')
        ]);

        foreach ($cart->carts as $cart) {
            $order->products()->attach($cart->product->id, ['quantity' => $cart->quantity]);
            $product = Product::find($cart->product->id)->first();
            $product->decrement('quantity', $product->weight_unity / 1000 * $cart->quantity);
            $cart->delete();
        }

        return redirect()->route('orders.success', $key);
    }

    public function success(Request $request, $key)
    {
        $cart = Cart::where('session', $request->cookie('carts'))->first();

        if (empty($cart) || $cart->key !== $key) {
            return redirect()->route('carts.index');
        }

        $cart->update([
            'is_completed' => true,
            'user_id' => Auth::user()->id,
            'key' => null
        ]);  
        
        return view('orders/success', ['date' => $cart->retrieval_at]);
    }
}
