<?php

namespace App\Providers;

use App\Category;
use App\Page;
use App\Cart;
use App\CartProduct;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'fr_FR.utf8');
        
        Schema::defaultStringLength(191);
        
        if (Schema::hasTable('categories')) {
            view()->share('categories', Category::all()->sortBy('name'));
        }

        if (Schema::hasTable('pages')) {
            view()->share('pages', Page::active()->get());
        }

        if (Schema::hasTable('carts')) {
            $cookie = Cookie::get('carts');

            if (!empty($cookie)) {
                $decrypted_cookie = decrypt($cookie, false);
                $cart = Cart::where('session', $decrypted_cookie)->first();

                if (!empty($cart)) {
                    view()->share('count_carts', CartProduct::where('cart_id', $cart->id)->count());
                }
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
