@extends('layouts.admin')

@section('title', 'Commandes en cours')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Commandes en cours</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.orders.index.completed') }}" class="btn btn-primary">Commandes terminées</a>
    </div>
</div>

@include('partials/_alert')

@if ($orders->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore de commande.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"># ID</th>
                <th scope="col">Prix total TTC</th>
                <th scope="col">Utilisateur</th>
                <th scope="col">Commande à récupérer le</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ tva($order->price) }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->retrieval_at }}</td>
                <td>
                    {!! $order->status() !!}
                </td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary btn-sm">
                        Voir
                    </a>
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $orders->links() }}
@endsection