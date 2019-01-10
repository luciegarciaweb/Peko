@extends('layouts.admin')

@section('title', 'Voir le produit '.$product->title)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Voir le produit <small class="text-primary">{{ $product->title }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Liste des produits</a>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="card mb-3">
            @if ($product->picture)
            <img class="card-img-top" src="{{ asset('storage/'.$product->picture) }}" alt="Image du produit">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->title }}</h5>
                <p class="card-text">{{ substr($product->body, 0, 70) }}...</p>
                <p class="card-text font-weight-bold">{{ tva($product->price) }}</p>
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Voir le détail</a>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h1 class="h5 mb-0">{{ $product->title }}</h1>
            </div>
            @if ($product->picture)
            <img src="{{ asset('storage/'.$product->picture) }}" height="200px" style="object-fit: contain;">
            @endif
            <div class="card-body">
                <h5>Description</h5>
                <p>{{ $product->body }}</p>
            </div>
            @if ($product->variety->label)
            <div class="card-body">
                <h5>Recettes</h5>
                <p>{{ $product->variety->label->recipe }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
