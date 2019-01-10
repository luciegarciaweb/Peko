@extends('layouts.admin')

@section('title', 'Accueil')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Panneau d'administration</h1>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Commandes en cours</h4>
                <h1 class="mb-0">{{ $orders }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.orders.index') }}" class="card-link">Toutes les commandes</a>
            </div>
        </div>
    </div> 
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Commandes terminées</h4>
                <h1 class="mb-0">{{ $completed_order }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.orders.index.completed') }}" class="card-link">Toutes les commandes terminées</a>
            </div>
        </div>
    </div>        
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Messages reçu</h4>
                <h1 class="mb-0">{{ $contacts }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.contacts.index') }}" class="card-link">Tous les messages</a>
            </div>
        </div>
    </div>   
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Utilisateurs</h4>
                <h1 class="mb-0">{{ $users }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.index') }}" class="card-link">Tous les utilisateurs</a>
            </div>
        </div>
    </div>    
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Nombres de professionels</h4>
                <h1 class="mb-0">{{ $professionals }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.pro') }}" class="card-link">Tous les professionels</a>
            </div>
        </div>
    </div>       
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-body text-center">
                <h4>Professionels en attente</h4>
                <h1 class="mb-0">{{ $professionals_not_validate }}</h1>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.new.pro') }}" class="card-link">Tous les pros</a>
            </div>
        </div>
    </div>              
</div>
@endsection