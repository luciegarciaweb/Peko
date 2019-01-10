@extends('layouts.app')

@section('title', 'Mes coordonnées')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include ('partials/_parameters_menu')
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Mes coordonnées
                </div>
                <div class="card-body" name="professionals" id="pro" >
                    @include('partials/_alert')
                    <form method="POST" action="{{ route('parameters.edit') }}">
                            @csrf
                        <div class="form-group">
                            <label class="col-form-label" for="firstname">Prénom</label>
                            <input id="firstname" type="firstname" 
                                class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                                name="firstname" 
                                value="{{Auth::user()->firstname}}"
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
                                required>
                            
                            @if ($errors->has('lastname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="email">Email</label>
                            <input id="email" type="email" 
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" 
                                value="{{Auth::user()->email}}"
                                required>
                            
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="phone">Téléphone</label>
                            <input id="phone" type="phone" 
                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                                name="phone" 
                                value="{{Auth::user()->phone}}"
                                >
                            
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" name="save" class="btn btn-primary" >Modifier</button>
                    </form>
                </div>
            </div>
        </div>       
    </div>                     
</div>
@endsection
