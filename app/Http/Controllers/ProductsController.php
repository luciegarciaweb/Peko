<?php

namespace App\Http\Controllers;

use App\Variety;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::active()->paginate(10);

        return view('products/index', [
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        if ($product->is_active) {
            return view('products/show', ['product' => $product]);
        }

        return redirect()->back();
    }

    public function category(Category $category)
    {
        $products = $category->products()->active()->paginate(10);
                
        return view('products/index', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function variety(Variety $variety)
    {
        $products = $variety->products()->active()->paginate(10);

        return view('products/index', [
            'category' => $variety->category,
            'variety' => $variety,
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        
        $products = Product::where('title', 'like', $query.'%')->active()->paginate(10);

        return view('products/index', [
            'products' => $products
        ]);
    }
}
