@extends('layouts.app')

@section('title', $product->title)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Accueil</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Catalogues</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index.category', $product->variety->category) }}">{{ $product->variety->category->name }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('products.index.variety', $product->variety) }}">{{ $product->variety->name }}</a>
            </li>                        
            <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
        </ol>
    </nav>    
    <div class="row">
        <div class="col-md-8">
            @include('partials/_alert')
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
        <div class="col-auto">
            <p class="h3">{{ tva($product->price) }}</p>
            <p class="h5 text-muted">
                par {{ $product->container->name }} 
                @if ($product->weight_unity > 0 && $product->price_kilo > 0) de 
                @if ($product->weight_unity > 999) 
                {{ $product->weight_unity / 1000 }}kg
                @else
                {{ $product->weight_unity}}g
                @endif
                @endif
            </p>
            @if ($product->price_kilo > 0)
            <p><span class="text-muted">Prix au kilo : </span> {{ tva($product->price_kilo) }}</p>
            @endif
            <form method="POST" action="{{ route('carts.add', $product) }}" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="quantity">Quantité</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>
@endsection
