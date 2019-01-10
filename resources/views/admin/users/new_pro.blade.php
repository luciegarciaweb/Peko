@extends('layouts.admin')

@section('title', 'Demandes pour devenir pro ')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Demandes pour devenir un professionel</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Tous les utilisateurs</a>
        <a href="{{ route('admin.users.pro') }}" class="btn btn-primary">Liste des professionels</a>
    </div>
</div>

@include('partials/_alert')

@if ($users->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore demande pour devenir un professionel.
</div>
@else
<div class="card-group mb-4">
    @foreach ($users as $user)
    <div class="col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                {{ $user->pro->company_name }}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Utilisateur</span>
                    <span class="float-right">
                        <a href="{{ route('admin.users.show', $user) }}">{{ $user->fullname() }}</a>
                    </span>
                </li>
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">Raison social</span>
                    <span class="float-right">{{ $user->pro->social_reason }}</span>
                </li> 
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">N° Siret</span>
                    <span class="float-right">{{ $user->pro->siret }}</span>
                </li> 
                <li class="list-group-item">
                    <span class="float-left font-weight-bold">N° TVA Intra..</span>
                    <span class="float-right">{{ $user->pro->tva_intracommunity }}</span>
                </li>                                                                               
            </ul>
            <div class="card-footer">
                <a href="{{ route('admin.users.pro.accept', $user) }}" class="btn btn-success btn-sm btn-block">Accepter</a>
                <a href="{{ route('admin.users.pro.refuse', $user) }}" class="btn btn-danger btn-sm btn-block">Refuser</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

{{ $users->links() }}
@endsection
