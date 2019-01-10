<?php

namespace App\Http\Controllers\Admin;

use App\Container;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContainersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = Container::paginate(10);

        return view('admin/containers/index', ['containers' => $containers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/containers/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);
               
        Container::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.containers.index')
            ->with('success', 'Le contenant a bien été créé.');
    }
   
    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function edit(Container $container)
    {
        return view('admin/containers/edit', ['container' => $container]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Container $container)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $container->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('admin.containers.index')
            ->with('success', 'Vous avez bien édité le filtre '. $container->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container $container)
    {
        $container->delete();

        return redirect()->route('admin.containers.index')
            ->with('success', 'Vous avez bien supprimé le filtre '. $container->name);
    }
}
