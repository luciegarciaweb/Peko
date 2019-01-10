@extends('layouts.app')

@section('title', 'Nous contacter')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            @include ('partials/_pages_menu')
        </div>
        <div class="col-5">
                @include('partials/_alert')
            <div class="card">
                <div class="card-header">
                    Nous contacter
                </div>
                <div class="card-body">  
                    <form method="POST" action="{{ route('contacts.store') }}">
                        @csrf
                    
                        <div class="form-group">
                            <label for="fullname">Nom complet</label>
                            <input id="fullname" type="text" 
                                class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" 
                                name="fullname" 
                                value="{{ old('fullname') }}" 
                                required>
                            
                            @if ($errors->has('fullname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fullname') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" 
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required>
                            
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="object">Objet</label>
                            <input id="object" type="text" 
                                class="form-control{{ $errors->has('object') ? ' is-invalid' : '' }}" 
                                name="object" 
                                value="{{ old('object') }}" 
                                required>
                            
                            @if ($errors->has('object'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('object') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="message">Votre message</label>
                            <textarea id="message" type="text" 
                                class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" 
                                name="message" 
                                required>{{ old('message') }}</textarea>
                                
                            @if ($errors->has('message'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                                                    
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    A la source de Péko
                </div>
                <div class="card-body p-0">
                    <div id="map-peko" class="map-contact"></div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    Notre adresse
                </div>
                <div class="card-body">
                    <address>
                        <strong>{{ config('peko.address.name') }}</strong><br/>
                        {{ config('peko.address.address') }}<br/>
                        {{ config('peko.address.zipcode') }}, {{ config('peko.address.city') }}<br/>
                        {{ config('peko.address.phone') }}<br/>
                        E-mail : <a href="mailto:{{ config('peko.email') }}">{{ config('peko.email') }}</a><br/>
                    </address>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

