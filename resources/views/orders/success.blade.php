@extends('layouts.app')

@section('title', 'Merci d\'avoir commandé !')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card mb-3">
                <div class="card-header text-center">
                    Merci d'avoir commandé !
                </div>
                <div class="card-body text-center">
                    <h1 class="display-1 text-success">
                        <i class="far fa-check-circle"></i>
                    </h1>
                    <p>
                        <a href="{{ route('orders.current') }}" class="btn btn-primary">Voir mes commandes</a>
                    </p>
                    <p class="pt-3">
                        Un problème ? N'hésitez pas à <a href="{{ route('contacts.create') }}">nous contacter</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Récupération de la commande
                </div>
                <div class="card-body">
                    <p>La commande doit être récupérée le <span class="text-primary">{{ $date }}</span>.</p>
                    <address>
                        <strong>{{ config('peko.address.name') }}</strong><br/>
                        {{ config('peko.address.address') }}<br/>
                        {{ config('peko.address.zipcode') }}, {{ config('peko.address.city') }}<br/>
                        {{ config('peko.address.phone') }}<br/>
                        E-mail : <a href="mailto:{{ config('peko.email') }}">{{ config('peko.email') }}</a><br/>
                    </address>
                </div>
                <div class="card-body p-0">
                    <div id="map-peko" class="map-success"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection