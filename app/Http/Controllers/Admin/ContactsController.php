<?php

namespace App\Http\Controllers\Admin;
use App\Contact;
use App\Mail\AnswerContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(10);
        
        return view('admin/contacts/index', ['contacts' => $contacts]);
    }
   
   /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @param  \App\Professional  $Professional
     * @return \Illuminate\Http\Response
     */    
    public function show(Contact $contact)
    {
        $contact->update([
            'is_read' => true
        ]);

        return view('admin/contacts/show', [
            'contact' => $contact            
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Le message a bien été supprimé.');
    }

     /**
     * Send the form.
     * @param  \App\Contact  $contact
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request, Contact $contact)
    {
        //allows to verify that the incoming request body
        $request->validate([
            'body' => 'required|string'
        ]);

        //Mail is an object with the "send" function. 
        //Add contact to get Contact model(information).
        //Add the data from the body message with the request method.
        Mail::send(new AnswerContact($contact, $request->input('body')));

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Votre message a bien été envoyé');
    }
}
