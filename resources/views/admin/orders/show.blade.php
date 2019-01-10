@extends('layouts.admin')

@section('title', 'Voir la commande '.$order->id)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Voir la commande <small class="text-primary">N°{{ $order->id }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Liste des commandes</a>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                Informations de la commande
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Utilisateur</span> 
                    <a href="{{ route('admin.users.show', $order->user) }}" class="float-right">{{ $order->user->fullname() }}</a>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">E-mail</span> 
                    <span class="float-right">{{ $order->user->email }}</span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Date de récupération</span> 
                    <span class="float-right">{{ $order->retrieval_at }}</span>
                </li>               
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Total</span> 
                    <span class="float-right">{{ tva($order->price) }}</span>
                </li>               
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Status</span> 
                    <span class="float-right">{!! $order->status() !!}</span>
                </li>                                
            </ul>
            <div class="card-footer border-top-0">
                <a href="{{ route('admin.orders.completed', $order) }}" class="btn btn-primary btn-sm btn-block">
                    @if ($order->is_completed)
                    Réouvrir la commande
                    @else
                    Terminer la commande
                    @endif
                </a>
                <a href="{{ route('admin.orders.ready', $order) }}" class="btn btn-primary btn-sm btn-block">
                    @if ($order->is_ready)
                    Commande non prête
                    @else
                    Commande prête
                    @endif
                </a>
                <a href="{{ route('admin.orders.progress', $order) }}" class="btn btn-primary btn-sm btn-block">
                    @if ($order->in_progress)
                    Commande non préparer
                    @else
                    Commande en cours de préparation
                    @endif
                </a>
                <a href="{{ route('admin.orders.canceled', $order) }}" class="btn btn-danger btn-sm btn-block">
                    @if ($order->is_canceled)
                    Désannuler la commande
                    @else
                    Annuler la commande
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                Liste des produits
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($order->products as $product)
                <li class="list-group-item">
                    <div class="float-left">
                        {{ $product->title }} - {{ $product->container->name }} - {{ $product->weight_unity }}g
                    </div>
                    <div class="float-right">
                        x{{ $product->pivot->quantity }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
