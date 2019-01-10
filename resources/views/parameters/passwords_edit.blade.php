@extends('layouts.app')

@section('title', 'Changer le mot de passe')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include ('partials/_parameters_menu')
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Changer le mot de passe
                </div>
                <div class="card-body">
                    @include('partials/_alert')
                    <form method="POST" action="{{ route('parameters.passwords.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="old_password">Ancien mot de passe</label>
                            <input id="old_password" type="password" 
                                class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" 
                                name="old_password" 
                                required>
                            
                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="new_password">Nouveau mot de passe</label>
                            <input id="new_password" type="password" 
                                class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" 
                                name="new_password" 
                                required>
                            
                            @if ($errors->has('new_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="confirm_new_password">Confirmation du nouveau mot de passe</label>
                            <input id="confirm_new_password" type="password" 
                                class="form-control{{ $errors->has('confirm_new_password') ? ' is-invalid' : '' }}" 
                                name="confirm_new_password" 
                                required>
                            
                            @if ($errors->has('confirm_new_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Modifier</button> 
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
