@extends('layouts.app')

@section('title', 'Commandes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-12">
            @include ('partials/_parameters_menu')
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if (Request::is('orders/history'))
                    Historique des commandes
                    @else
                    Commandes en cours
                    @endif
                </div>
                <div class="card-body">
                    @if ($orders->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Vous n'avez pas de commande
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Total TTC</th>
                                    <th scope="col">À récupérer le</th>
                                    <th scope="col">Créer</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id }}</th>
                                    <td>{{ tva($order->price) }}</td>
                                    <td>{{ $order->retrieval_at }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        {!! $order->status() !!}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                            Détails
                                        </button>

                                        @component('components/order_detail_modal', ['order' => $order])
                                            
                                        @endcomponent
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
