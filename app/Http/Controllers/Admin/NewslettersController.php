<?php

namespace App\Http\Controllers\Admin;
use App\Mail\AnswerContact;
use App\Newsletter;
use App\Contact;
use App\Mail\NewsletterSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewslettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = Newsletter::paginate(10);
        
        return view('admin/newsletters/index', ['newsletters' => $newsletters]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        return view('admin/newsletters/edit',[
            'newsletter' => $newsletter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $newsletter->update([
            'email' => $request->input('email'),
        ]);

        return redirect()->route('admin.newsletters.index')
        ->with('success', 'La page a été mise en jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')
            ->with('success','la newsletter a bien été supprimée');
    }

     /**
     * Display the newsletter form
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/newsletters/create');
    }

     /**
     * Send the newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'object' => 'required|string|max:100',
            'body' => 'required|string'
        ]);

        //pluck = use only the email 
        $emails = Newsletter::pluck('email')->take(2);

        // dd($emails);

        Mail::send(new NewsletterSent(
            $request->input('object'),
            $request->input('body'),
            $emails
        ));

        return redirect()->route('admin.newsletters.index')
            ->with('success', 'Votre newsletter a bien été envoyée à tous les contacts');
    }

}
