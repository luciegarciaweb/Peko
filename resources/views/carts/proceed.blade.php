@extends('layouts.app')

@section('title', 'Confirmation de la commande')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    Confirmation de la commande
                </div>
                <div class="card-body text-center">
                    <h5 class="mb-3">Votre commande sera prête à cette date</h5>
                    <h5>
                        <span class="text-primary">{{ $cart->retrieval_at }}</span>
                    </h5>
                    <h4 class="pb-2 pt-2">Votre commande</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nom du produit</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix unitaire TTC</th>
                                    <th scope="col">Prix total TTC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->carts as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $product->product) }}">{{ $product->product->title }}</a>
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <td>{{ tva($product->product->price) }}</td>
                                    <td>{{ tva($product->totalProduct()) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h5>Total de votre commande</h5>
                    <h4>{{ tva($cart->price) }}</h4>
                </div>
                <div class="card-footer">
                    <div class="float-left">
                        <a href="{{ route('carts.index') }}" class="btn btn-secondary">Revenir aux paniers</a>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('orders.create', $cart->key) }}" class="btn btn-primary">Payer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection