@extends('layouts.admin')

@section('title', 'Voir l\'utilisateur '.$user->email)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Voir l'utilisateur <small class="text-primary">{{ $user->email }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Liste des utilisateurs</a>
    </div>
</div>

@include('partials/_alert')

<div class="row">
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-header">
                <div class="float-left">
                    {{ $user->fullname() }} 
                </div>
                <div class="float-right">
                    @if ($user->pro)
                    <span class="badge badge-primary">Professionnel</span>
                    @else
                    <span class="badge badge-primary">Particulier</span>
                    @endif
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="font-weight-bold pr-2">E-mail</span> {{ $user->email }}
                </li>
                <li class="list-group-item">
                    <span class="font-weight-bold pr-2">Téléphone</span> 
                    @if ($user->phone) 
                    {{ $user->phone }} 
                    @else 
                    n\a
                    @endif
                </li>
                <li class="list-group-item">
                    <span class="font-weight-bold pr-2">Commandes</span> {{ $user->orders()->count() }}
                </li>
            </ul>
            <div class="card-footer">
                <a href="{{ route('admin.users.active', $user) }}">
                    @if ($user->is_active)
                    <button type="button" class="btn btn-success btn-sm">
                        Activer
                    </button>
                    @else
                    <button type="button" class="btn btn-warning btn-sm">
                        Désactiver
                    </button>
                    @endif
                </a>
                <a href="{{ route('admin.users.admin', $user) }}" class="btn btn-info btn-sm">
                    @if ($user->is_admin)
                    Administrateur                      
                    @else
                    Client
                    @endif
                </a>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                Adresse
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                        <span class="float-left font-weight-bold">Prénom</span> 
                        <span class="float-right">{{ $user->firstname }}</span>
                    </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Nom</span> 
                    <span class="float-right">{{ $user->lastname }}</span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Adresse</span> 
                    <span class="float-right">{{ $user->address }}</span>
                </li>               
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Complément</span> 
                    <span class="float-right">{{ $user->complement }}</span>
                </li>  
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Code postal</span> 
                    <span class="float-right">{{ $user->postal_code }}</span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Ville</span> 
                    <span class="float-right">{{ $user->city }}</span>
                </li>                  
            </ul>
        </div>
        @if ($user->pro)
        <div class="card mb-3">
            <div class="card-header">
                Informations professionnel
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Status</span> 
                    @if ($user->pro->is_accepted)
                    <span class="float-right text-success">
                        Accepter
                    </span>
                    @elseif ($user->pro->is_denied)
                    <span class="float-right text-danger">
                        Refuser
                    </span> 
                    @elseif ($user->pro->is_requested)
                    <span class="float-right text-info">
                        En cours
                    </span>
                    @endif                                       
                </li>
                <li class="list-group-item">
                        <span class="float-left font-weight-bold">Nom d'entreprise</span> 
                        <span class="float-right">{{ $user->pro->company_name }}</span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Raison sociale</span> 
                    <span class="float-right">{{ $user->pro->social_reason }}</span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">N° de Siret</span> 
                    <span class="float-right">{{ $user->pro->siret }}</span>
                </li>               
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">TVA intracommunautaire</span> 
                    <span class="float-right">{{ $user->pro->tva_intracommunity }}</span>
                </li>               
            </ul>
            <div class="card-footer border-top-0">
                <a href="{{ route('admin.users.pro.accept', $user) }}" class="btn btn-primary btn-sm btn-block">
                    Accepter
                </a>
                <a href="{{ route('admin.users.pro.refuse', $user) }}" class="btn btn-danger btn-sm btn-block">
                    Refuser
                </a>
            </div>
        </div>
        @endif
    </div>
    <div class="col-sm-8">
        <h3>Dernières commandes</h3>
        @if ($user->orders->isEmpty())
        <div class="alert alert-primary" role="alert">
            {{ $user->fullname() }} n'a pas encore fait de commande !
        </div> 
        @else  
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Total</th>
                        <th scope="col">Commande à récupérer le</th>
                        <th scope="col">Status</th>
                        <th scope="col">Créer le</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->orders as $order)
                    <tr>
                        <td>{{ tva($order->price) }}</td>
                        <td>{{ $order->retrieval_at }}</td>
                        <td>
                            {!! $order->status() !!}
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary btn-sm">Voir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection