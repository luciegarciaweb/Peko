<?php

namespace App\Http\Controllers\Admin;

use App\Label;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::paginate(10);

        return view('admin/labels/index', ['labels' => $labels]);
    }

    /**
     * Show the form for creating a new resource.
     *@param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');

        return view('admin/labels/create', ['categories' => $categories]);
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
            'name' => 'required|string|max:191',
            'body' => 'required|string|max:600',
            'recipe' => 'required|string|max:600',
            'variety' => 'required|exists:varieties,id',
            'picture' => 'nullable|image'
        ]);

        if ($request->has('picture')) {
            $picture = $request->file('picture')->store('labels', 'public');
        }

        Label::create([
            'name' => $request->input('body'),
            'body' => $request->input('body'),
            'recipe' => $request->input('recipe'),
            'variety_id' => $request->input('variety'),
            'picture' => isset($picture) ? $picture : null
        ]);

        return redirect()->route('admin.labels.index')
            ->with('success', 'Vous avez bien enregistré une nouvelle étiquette');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $categories = Category::all()->sortBy('name');

        return view('admin/labels/edit', [
            'categories' => $categories,
            'label' => $label
        ]);
    }

    public function show(Label $label)
    {
        return view('admin/labels/show', ['label' => $label]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'body' => 'required|string|max:200',
            'recipe' => 'required|string|max:2000'
        ]);

        if ($request->has('picture')) {
            $picture = $request->file('picture')->store('labels', 'public');
        }

        $label->update([
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'recipe' => $request->input('recipe'),
            'picture' => isset($picture) ? $picture : $label->picture
        ]);

        return redirect()->route('admin.labels.index')->with('success', 'Etiquette modifiée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        $label->delete();

        return redirect()->route('admin.labels.index')
            ->with('success', 'Le label a bien été supprimé.');
    }
}
