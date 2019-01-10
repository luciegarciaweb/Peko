@extends('layouts.admin')

@section('title', 'Voir l\'étiquette ', $label->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Voir l'étiquette produit :</h1>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $label->name}}</h5>
                <p class="card-text">
                    <strong>Variété :</strong> {{ $label->variety->name }} </br>
                    <strong>Descriptif :</strong> {{ $label->body }} </br>
                    <strong>Image :</strong> {{ $label->picture }} </br>  
                    <strong>Recette :</strong> {{ $label->recipe }}
                </p>
            </div>
        </div>
    </div>
 
@endsection
