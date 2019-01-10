@extends('layouts.admin')

@section('title', 'Demandes pour devenir pro')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Utilisateurs professionels</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Tous les utilisateurs</a>
        <a href="{{ route('admin.users.new.pro') }}" class="btn btn-primary">Demandes pour être pro</a>
    </div>
</div>

@include('partials/_alert')

@if ($users->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore d'utilisateur professionels.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Nom complet</th>
                <th scope="col">E-mail</th>
                <th scope="col">Status</th>
                <th scope="col">Role</th>
                <th scope="col">Demande</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->fullname() }}</td>
                <td>{{ $user->email }}</td>
                <td>
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
                </td>
                <td>
                    @if ($user->is_admin)
                    <span class="badge badge-primary">Administrateur</span>
                    @else
                    <span class="badge badge-primary">Client</span>
                    @endif
                </td>
                <td>
                    @if ($user->pro->is_accepted)
                    <span class="text-success">
                        Accepter
                    </span>
                    @elseif ($user->pro->is_denied)
                    <span class="text-danger">
                        Refuser
                    </span> 
                    @elseif ($user->pro->is_requested)
                    <span class="text-info">
                        En cours
                    </span>
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user) }}">
                        <button type="button" class="btn btn-primary btn-sm">
                            Voir
                        </button>
                    </a>
                </a>
                <a href="{{ route('admin.users.edit', $user) }}">
                    <button type="button" class="btn btn-dark btn-sm">
                        <i class="fas fa-edit"></i>
                    </button>
                </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $user->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    @component('admin/components/delete_modal', ['data' => $user, 'route' => 'users']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $users->links() }}
@endsection
