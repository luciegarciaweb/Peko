<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts/create');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Contact  $contact
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|string|max:100',
            'object' => 'required|string|max:100',
            'message' => 'required|string|max:255',
        ]);

        Contact::create([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'object' => $request->input('object'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('contacts.create')
            ->with('success', 'Votre message a bien été envoyé');
    }
}