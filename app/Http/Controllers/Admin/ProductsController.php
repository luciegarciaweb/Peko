<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use App\Container;
use App\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('admin/products/index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        $containers = Container::all()->sortBy('name');
        $titles = DB::table('products')->pluck('title');
        
        return view('admin/products/create', [
            'categories' => $categories,
            'containers' => $containers,
            'titles' => $titles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|string|max:191',
            'body' => 'required|string',
            'variety' => 'required|exists:varieties,id',
            'container' => 'required|exists:containers,id',
            'price' => 'required|numeric',
            'price_kilo' => 'required|numeric',
            'weight_unity' => 'required|numeric',
            'quantity' => 'required|numeric',
            'picture' => 'nullable|image'
        ]);

        if ($request->has('picture')) {
            $picture = $request->file('picture')->store('products', 'public');
        }

        Product::create([
            'slug' => str_slug($request->input('title')),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'price' => $request->input('price'),
            'price_kilo' => $request->input('price_kilo'),
            'weight_unity' => $request->input('weight_unity'),
            'picture' => isset($picture) ? $picture : null,
            'quantity' => $request->input('quantity'),
            'variety_id' => $request->input('variety'),
            'container_id' => $request->input('container')
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Vous avez bien rajouté le produit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin/products/show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->sortBy('name');
        $containers = Container::all()->sortBy('name');

        return view('admin/products/edit', [
            'product' => $product,
            'categories' => $categories,
            'containers' => $containers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'bail|required|string|max:191',
            'body' => 'required|string',
            'variety' => 'required|exists:varieties,id',
            'container' => 'required|exists:containers,id',
            'price' => 'required|numeric',
            'price_kilo' => 'required|numeric',
            'quantity' => 'required|numeric',
            'picture' => 'nullable|image'
        ]);

        if ($request->has('picture')) {
            $picture = $request->file('picture')->store('products', 'public');
        }

        $product->update([
            'slug' => str_slug($request->input('title')),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'price' => $request->input('price',2),
            'price_kilo' => $request->input('price_kilo'),
            'picture' => isset($picture) ? $picture : $product->picture,
            'quantity' => $request->input('quantity'),
            'variety_id' => $request->input('variety'),
            'container_id' => $request->input('container')
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Vous avez bien édité le produit');
    }

    /**
     * Push product in first plan from sell.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function pushForward( Product $product)
    {
        if ($product->push_forward) {

            $product->update([
                'push_forward' => false
            ]);

            return redirect()->route('admin.products.index')
            ->with('success', 'Vous avez désactivé la mise en avant de : '. $product->title);
                
        } else {
            
            $product->update([
                'push_forward' => true
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Vous avez mis en avant : '. $product->title);
        }
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function setStatus(Product $product)
    {
        if ($product->is_active) {

            $product->update([
                'is_active' => false
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Vous avez désactivé le produit '. $product->title);
        } else {
            
            $product->update([
                'is_active' => true
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Vous avez activé le produit '. $product->title);

        }
    }    
}
