<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use Illuminate\Support\Facades\DB;

class NewslettersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email_newsletter' => 'required|email|max:191',
        ]);

        Newsletter::create([
            'email' => $request->input('email_newsletter')
        ]);

        return redirect()->back()
            ->with('success_newsletter', 'Vous vous êtes bien inscrit à notre newsletter ! ');
    }
}
