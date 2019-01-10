@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header border-bottom-0">
                    Mon panier
                </div>
                <div class="card-body p-0">
                    @include ('partials/_alert')

                    @if ($carts->isEmpty())
                    <div class="alert alert-info mt-3 ml-3 mr-3" role="alert">
                        Vous n'avez pas encore ajouter de produit dans votre panier 
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nom du produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix unitaire TTC</th>
                                    <th scope="col">Prix total TTC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <a href="{{ route('carts.remove', $cart) }}" class="btn btn-primary btn-sm mr-2">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @if ($cart->product->picture)
                                        <img src="{{ asset('storage/'.$cart->product->picture) }}" 
                                            width="50px" height="50px">
                                        @else
                                        Pas d'image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $cart->product) }}">{{ $cart->product->title }}</a>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ route('carts.decrement', $cart) }}" class="btn btn-primary">-</a>
                                            <button type="button" class="btn btn-primary">{{ $cart->quantity }}</button>
                                            <a href="{{ route('carts.increment', $cart) }}" class="btn btn-primary">+</a>
                                        </div>
                                    </td>
                                    <td>{{ tva($cart->product->price) }}</td>
                                    <td>{{ tva($cart->totalProduct()) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                @if (!$carts->isEmpty())
                <div class="card-footer">
                    <div class="float-right">
                        <span class="h5">
                            <span class="text-muted mr-3">Total</span> {{ tva($carts->total()->sum()) }}
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="col-3">
            @if (!$carts->isEmpty())
            <div class="card">
                <div class="card-header">
                    Commander
                </div>
                <div class="card-body">
                    <p>Vous pouvez choisir quand vous récupérez votre panier !</p>
                    <form method="POST" action="{{ route('carts.proceed') }}">
                        @csrf
                        <select-hour 
                            open-hour="{{ config('peko.open_hours') }}" 
                            close-hour="{{ config('peko.close_hours') }}"
                            increment="{{ config('peko.hour_increment') }}">
                        </select-hour>
                        <button type="submit" class="btn btn-primary btn-block">Passer la commande</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
