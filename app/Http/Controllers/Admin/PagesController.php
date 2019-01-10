<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);

        return view('admin/pages/index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pages/create');
    }


    public function show(Page $page)
    {
        return view('admin/pages/show', ['page' => $page]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin/pages/edit', ['page' => $page]);
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
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:100'
        ]);
                //dd($request);
        Page::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'slug' => str_slug($request->input('title', '-'))
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'La page a été créée.');
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'body' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $page->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'is_active' => 1,
            'slug' => str_slug($request->input('title', '-'))
        ]);

        return redirect()->route('admin.pages.index')
        ->with('success', 'La page a été éditée.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Vous avez bien supprimé la page '. $page->title);
    }

    public function setStatus(Page $page)
    {
        if ($page->is_active) {
            $page->update([
                'is_active' => false
            ]);

            return redirect()->route('admin.pages.index')
                ->with('success', 'Vous avez désactivé la page '. $page->title);
        } else {
            $page->update([
                'is_active' => true
            ]);

            return redirect()->route('admin.pages.index')
                ->with('success', 'Vous avez activé la page '. $page->title);

        }
    }
}
