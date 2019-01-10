@extends('layouts.admin')

@section('title', 'Editer l\'utilisateur '.$user->email)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer l'utilisateur <small class="text-primary">{{ $user->email }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Liste des utilisateurs</a>
    </div>
</div>

<div class="card">
    <div class="card-body">  
        @include('partials/_alert')
         
        <form method="POST" action="{{ route('admin.users.update', ['user' => $user]) }}">
            @csrf
            @method('PUT')
        
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input id="firstname" type="text" 
                            class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" 
                            name="firstname" 
                            value="{{ $user->firstname }}" 
                            required>
                        
                        @if ($errors->has('firstname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="lastname">Nom de famille</label>
                        <input id="lastname" type="text" 
                            class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" 
                            name="lastname" 
                            value="{{ $user->lastname }}" 
                            required>
                        
                        @if ($errors->has('lastname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" 
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            name="email" 
                            value="{{ $user->email }}" 
                            required>
                
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input id="phone" type="text" 
                            class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                            name="phone" 
                            value="{{ $user->phone }}">
                
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input id="address" type="text" 
                            class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                            name="address" 
                            value="{{ $user->address }}">
                
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>                     
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="complement">Complément d'adresse</label>
                        <input id="complement" type="text" 
                            class="form-control{{ $errors->has('complement') ? ' is-invalid' : '' }}" 
                            name="complement" 
                            value="{{ $user->complement }}">
                
                        @if ($errors->has('complement'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('complement') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>
            </div>       
            
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="postal_code">Code postal</label>
                        <input id="postal_code" type="text" 
                            class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" 
                            name="postal_code" 
                            value="{{ $user->postal_code }}">
                
                        @if ($errors->has('postal_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('postal_code') }}</strong>
                            </span>
                        @endif
                    </div>                     
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input id="city" type="text" 
                            class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                            name="city" 
                            value="{{ $user->city }}">
                
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Editer l'utilisateur</button>
        </form>
    </div>
</div>
@endsection
