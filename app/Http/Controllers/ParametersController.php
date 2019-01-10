<?php

namespace App\Http\Controllers;

use App\Parameter;
use App\Professional;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class ParametersController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Edit the parameters.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('parameters/edit');
    }

    /**
     * update user profile.
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //allows to verify that the incoming request body
        $request->validate([
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'required|email|string|max:191',
            'phone' =>'nullable|numeric',
        ]);
           
        Auth::user()->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('parameters.edit')
            ->with('success', 'Votre profil a bien été mis à jour.');
    }

     /**
     * change user password.
     * @param  \Illuminate\Validation\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'current-password.required' => 'Entrez votre mot de passe actuel',
            'password.required' => 'Entrez votre nouveau mot de passe',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required|string',
            'password' => 'required|same:password',
            'confirmPassword' => 'required|same:password',    
        ], $messages);

        return $validator;
    } 
   

    /**
     * change user password.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function passwordsUpdate(Request $request)
    {
        if (Hash::check($request->input('old_password'), Auth::user()->password)) {
            $request->validate([
                'new_password' => 'required|string|min:6|max:191',
                'confirm_new_password' => 'required|same:new_password'
            ]);

            Auth::user()->update([
                'password' => Hash::make($request->input('new_password'))
            ]);

            return redirect()->back()->with('success', 'Votre mot de passe a bien été changé.');
        }

        return redirect()->back()->withErrors(['old_password' => 'Mot de passe incorrect.']);
    }
      
   
    public function passwordsEdit()
    {
        return view('parameters/passwords_edit');
    }

     /**
     * add user professionals infos.
     * @param  \App\Professional  $professional
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function professionals(Request $request)
    {
        //function pour rentrer les infos pro
        $request->validate([
            'social_reason' => 'string',
            'company_name' => 'string',
            'siret' => 'string',
            'tva_intracommunity' =>'string',
        ]);
           
        $pro = Auth::user()->pro;
        
        if (is_null($pro)) {
            Auth::user()->pro()->create([
                'social_reason' => $request->input('social_reason'),
                'company_name' => $request->input('company_name'),
                'siret' => $request->input('siret'),
                'tva_intracommunity' => $request->input('tva_intracommunity')
            ]);
        } else {
            $pro->update([
                'social_reason' => $request->input('social_reason'),
                'company_name' => $request->input('company_name'),
                'siret' => $request->input('siret'),
                'tva_intracommunity' => $request->input('tva_intracommunity')
            ]);         
        }

        return redirect()->route('parameters.edit')
        ->with('success', 'Vos informations professionnelles sont bien enregistrées.');
    }


    public function proCreate()
    {
        return view('parameters/pro');
    }

    public function proStore(Request $request)
    {
        $pro = Auth::user()->pro;

        if (empty($pro)) {
            $request->validate([
                'social_reason' => 'required|max:191|string',
                'company_name' => 'required|max:191|string',
                'siret' => 'required|max:191|string',
                'tva_intracommunity' =>'required|max:191|string',
            ]);

            Auth::user()->pro()->create([
                'social_reason' => $request->input('social_reason'),
                'company_name' => $request->input('company_name'),
                'siret' => $request->input('siret'),
                'tva_intracommunity' => $request->input('tva_intracommunity'),
                'is_requested' => true
            ]);

            return redirect()->back();
        }
    }
}
