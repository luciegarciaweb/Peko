<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartProduct;
use App\Product;
use App\Helpers\CartsHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('proceed');
    }

    public function index(Request $request)
    {
        $cart = Cart::where('session', $request->cookie('carts'))->first();

        if (!empty($cart)) {
            return view('carts/index', [
                'carts' => $cart->carts            
            ]);
        }

        return view('carts/index', ['carts' => collect([])]);
    }

    public function getProceed()
    {
        return redirect()->route('carts.index');
    }

    public function proceed(Request $request)
    {
        // Finish Validate
        $cart = Cart::where('session', $request->cookie('carts'))->first();

        if (empty($cart)) {
            return redirect()->route('carts.index');
        }

        $request->validate([
            'weekday' => 'required|date',
            'hour' => 'required|min:1|max:24'
        ]);

        $date = \Carbon\Carbon::parse($request->input('weekday'));
        $date->hour = $request->input('hour');

        $cart->update([
            'retrieval_at' => $date,
            'key' => str_random(50),
            'price' => $cart->carts->total()->sum()
        ]);

        return view('carts/proceed', ['cart' => $cart]);
    }

    public function add(Request $request, Product $product)
    {
        $CartsHelpers = new CartsHelpers($request);

        if ($product->quantity > $request->input('quantity') && $request->input('quantity') > 0) {
            
            $cartProduct = CartProduct::where('cart_id', $CartsHelpers->getCartId())
                ->where('product_id', $product->id)
                ->first();

            if (empty($cartProduct)) {
                CartProduct::create([
                    'cart_id' => $CartsHelpers->getCartId(),
                    'product_id' => $product->id,
                    'quantity' => $request->input('quantity')
                ]);

                if ($CartsHelpers->hasCookie()) {
                    return redirect()->back()->cookie($CartsHelpers->getCookie())->with('success', $product->title.' à bien été ajouté au panier.');
                }
                
                return redirect()->back()->with('success', $product->title.' a bien été ajouté(e) au panier.');
            }

            $cartProduct->increment('quantity', $request->input('quantity'));

            if (isset($cookie)) {
                return redirect()->back()->cookie($cookie)->with('success', $product->title.' a bien été ajouté(e) au panier.');
            }

            return redirect()->back()->with('success', $product->title.' a bien été ajouté(e) au panier.');
        }

        return redirect()->back()
            ->with('error', 'Le produit n\'a pas assez de stock !');
    }

    public function decrement(Request $request, CartProduct $CartProduct)
    {
        if ($request->cookie('carts') === $CartProduct->cart->session) {
            if ($CartProduct->quantity <= 1) {
                return $this->remove($request, $CartProduct);
            }

            $CartProduct->decrement('quantity', 1);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function increment(Request $request, CartProduct $CartProduct)
    {
        if ($request->cookie('carts') === $CartProduct->cart->session) {
            if ($CartProduct->quantity < $CartProduct->product->quantity) {
                $CartProduct->increment('quantity', 1);
    
                return redirect()->back();
            }
    
            return redirect()->back()
                ->with('error', 'Le produit n\'a pas assez de stock !');
        }

        return redirect()->back();
    }
    
    public function remove(Request $request, CartProduct $CartProduct)
    {
        if ($request->cookie('carts') === $CartProduct->cart->session) {
            $CartProduct->delete();

            return redirect()->back();
        }

        return redirect()->back();
    }
}
