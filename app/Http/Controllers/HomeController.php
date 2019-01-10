<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last_products = Product::active()->latest()->limit(4)->get();

        $star_products = Product::active()->where('push_forward', true)->limit(4)->get();
          
        //use Laravel Collection isEmpty method
        if($star_products->isEmpty()) {
            $star_products = Product::active()->inRandomOrder()->limit(4)->get();
        }
        
        $sliders  = Slider::where('is_active', true)->whereNotNull('picture')->get();

        return view('home', [
            'sliders' => $sliders, 
            'last_products' => $last_products,
            'star_products' => $star_products
        ]);    
    }
}
