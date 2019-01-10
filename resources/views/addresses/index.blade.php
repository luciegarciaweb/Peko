@extends('layouts.app')

@section('title', 'Mon adresse')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include ('partials/_parameters_menu')
        </div>
        <div class="col-md-9 col-sm-12">
            @include('partials/_alert')
            <div class="card">
                <div class="card-header">
                    Mon adresse
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('addresses.update')}}">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="firstname">Prénom</label>
                            <input id="firstname" type="firstname" 
                                class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                                name="firstname" 
                                value="{{Auth::user()->firstname}}"
                                readonly
                                required>
                            
                            @if ($errors->has('firstname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="lastname">Nom</label>
                            <input id="lastname" type="lastname" 
                                class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                                name="lastname" 
                                value="{{Auth::user()->lastname}}"
                                readonly
                                required>
                            
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="address">Adresse</label>
                            <input id="address" type="address" 
                                class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                                name="address" 
                                value="{{Auth::user()->address}}">
                            
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="complement">Complément</label>
                            <input id="complement" type="complement" 
                                class="form-control{{ $errors->has('complement') ? ' is-invalid' : '' }}" 
                                name="complement" 
                                value="{{Auth::user()->complement}}">
                            
                            @if ($errors->has('complement'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('complement') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="postal_code">Code postal</label>
                            <input id="postal_code" type="postal_code" 
                                class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" 
                                name="postal_code" 
                                value="{{Auth::user()->postal_code}}">
                            
                            @if ($errors->has('postal_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('postal_code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="city">Ville</label>
                            <input id="city" type="city" 
                                class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                name="city" 
                                value="{{Auth::user()->city}}">
                            
                            @if ($errors->has('city'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection