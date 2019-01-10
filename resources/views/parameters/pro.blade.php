@extends('layouts.app')

@section('title', 'Devenir un professionel')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include ('partials/_parameters_menu')
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Devenir un professionel
                </div>
                <div class="card-body">
                    @if (Auth::user()->pro)
                        @if (Auth::user()->pro->is_requested)
                        <div class="alert alert-info" role="alert">
                            Votre demande pour devenir un professionel a bien été soumise.<br> Elle sera traité le plus vite possible.
                        </div>
                        @endif

                        @if (Auth::user()->pro->is_accepted)
                        <div class="alert alert-success" role="alert">
                            Votre demande pour devenir un professionel a été acceptée.
                        </div> 
                        @endif 

                        @if (Auth::user()->pro->is_denied)
                        <div class="alert alert-danger" role="alert">
                            Votre demande pour devenir un professionel a été refusée.
                        </div>
                        @endif                                   
                    @else
                    <form method="POST" action="{{ route('parameters.pro.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="company_name">Nom de l'entreprise :</label>
                            <input id="company_name" type="text" 
                                class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" 
                                name="company_name" 
                                required>
                            
                            @if ($errors->has('company_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="social_reason">Raison social :</label>
                            <input id="social_reason" type="text" 
                                class="form-control{{ $errors->has('social_reason') ? ' is-invalid' : '' }}" 
                                name="social_reason" 
                                required>
                            
                            @if ($errors->has('social_reason'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('social_reason') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="siret">N° de siret :</label>
                            <input id="siret" type="text" 
                                class="form-control{{ $errors->has('siret') ? ' is-invalid' : '' }}" 
                                name="siret" 
                                required>
                            
                            @if ($errors->has('siret'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('siret') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tva_intracommunity">TVA Intracommunautaire :</label>
                            <input id="tva_intracommunity" type="text" 
                                class="form-control{{ $errors->has('tva_intracommunity') ? ' is-invalid' : '' }}" 
                                name="tva_intracommunity" 
                                required>
                            
                            @if ($errors->has('tva_intracommunity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tva_intracommunity') }}</strong>
                                </span>
                            @endif
                        </div>                        

                        <button type="submit" class="btn btn-primary">Enregistrer</button> 
                    </form> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
