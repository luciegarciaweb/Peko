<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function show(Page $page)
    {
        return view('pages/show', ['page' => $page]);
    }
}
