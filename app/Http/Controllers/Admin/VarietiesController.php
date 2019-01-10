<?php

namespace App\Http\Controllers\Admin;

use App\Variety;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VarietiesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin/varieties/create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:75'
        ]);

        Variety::create([
            'slug' => str_slug($request->input('name')),
            'name' => $request->input('name'),
            'category_id' => $category->id
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La variété ' . $request->input('name') . ' a bien été créée');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Variety $variety)
    {
        return view('admin/varieties/edit', [
            'category' => $category,
            'variety' => $variety,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variety $variety)
    {
        $request->validate([
            'name' => 'required|string|max:75',
            'category' => 'required|numeric|exists:categories,id'
        ]);

        $variety->update([
            'slug' => str_slug($request->input('name')),
            'name' => $request->input('name'),
            'category_id' => $request->input('category')
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La variété ' . $variety->name . ' a bien été éditée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variety  $variety
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variety $variety)
    {
        $name = $variety->name;

        foreach ($variety->products as $product) {
            $product->update([
                'is_active' => false
            ]);
        }

        $variety->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'La variété ' . $name . ' a bien été supprimée.');
    }
}
