<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User;


class AddressesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * index of addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('addresses/index');
    }
    /**
     * updating user address
     *  @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string|max:191',
            'complement' => 'nullable|string|max:191',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:191',
        ]);
                //dd($request);

        Auth::user()->update([
            'address' => $request->input('address'),
            'complement' => $request->input('complement'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
        ]);

        return redirect()
        ->route('addresses.index')
        ->with('success', 'Votre adresse a bien été modifiée');
    }
}
