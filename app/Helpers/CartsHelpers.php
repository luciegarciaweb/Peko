<?php 

namespace App\Helpers;

use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartsHelpers
{
    private $cookie;
    private $request;
    private $random;
    private $cart_id;
    private $has_cookie;

    public function __construct($request)
    {
        $this->request = $request;
        $this->has_cookie = false;
        $this->setRandom();
        $this->getCart();
    }

    public function getCartId()
    {
        return $this->cart_id;
    }

    public function getCookie()
    {
        return $this->cookie;
    }

    public function hasCookie()
    {
        return $this->has_cookie;
    }

    private function getCart()
    {
        $session = $this->request->cookie('carts');
        $cart = Cart::where('session', $session)->first();

        if (empty($cart)) {
            $this->createCookie();
            $this->createCart();
            $this->has_cookie = true;
        } else {
            $this->cart_id = $cart->id;
        }
    }

    private function createCart()
    {
        $cart = Cart::create([
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'session' => $this->random
        ]);

        $this->cart_id = $cart->id;
    }

    private function createCookie()
    {
        $this->cookie = cookie('carts', $this->random, config('peko.carts_duration'));
    }

    private function setRandom()
    {
        $this->random = str_random(40);
    }
}