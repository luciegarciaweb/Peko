<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Variety;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10)->sortBy('name');

        return view('admin/categories/index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/categories/create');
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
            'name' => 'required|string|max:75'
        ]);

        Category::create([
            'slug' => str_slug($request->input('name')),
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie ' . $request->input('name') . ' a été créé.');
    }


    public function show(Category $category)
    {
        return view('admin/categories/show', ['categories' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin/categories/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:75'
        ]);

        $category->update([
            'slug' => str_slug($request->input('name')),
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie ' . $category->name . ' a bien été éditée.');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $name = $category->name;

        $category->varieties()->delete();
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie ' . $name . ' a bien été supprimée.');        
    }
}
