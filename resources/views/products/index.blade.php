@extends('layouts.app')

@section('title', 'Liste des produits')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Accueil</a>
            </li>
            @if (isset($category) || isset($variety) || Request::is('search'))
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Catalogues</a>
            </li>
            @else
            <li class="breadcrumb-item active" aria-current="page">Catalogues</li>
            @endif
            @if (Request::is('search'))
            <li class="breadcrumb-item active" aria-current="page">Résultat de la recherche pour : {{ Request::query('query') }}</li>
            @endif
            @if (isset($category)) 
            @if (isset($variety))
            <li class="breadcrumb-item">
                <a href="{{ route('products.index.category', $category) }}">{{ $category->name }}</a>
            </li> 
            @else
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>    
            @endif
            @endif
            @if (isset($variety))
            <li class="breadcrumb-item active" aria-current="page">{{ $variety->name }}</li>
            @endif
        </ol>
    </nav>    
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header">
                    Catégories
                </div>
                @foreach ($categories as $left_category)
                @if (!$left_category->varieties->isEmpty())
                <div class="list-group list-group-flush dropright">
                    <a href="#" id="{{ $left_category->slug }}" data-reference="toggle" data-toggle="dropdown" data-offset="0,10" aria-haspopup="true" aria-expanded="false"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center dropdown-toggle">
                        {{ $left_category->name }} 
                    </a>
                    <div class="dropdown-menu" aria-labelledby="{{ $loop->index }}">
                        <h6 class="dropdown-header">{{ $left_category->name }}</h6>
                        @if ($left_category->varieties)
                        @foreach ($left_category->varieties as $left_variety)
                        <a class="dropdown-item" href="{{ route('products.index.variety', $left_variety) }}">{{ $left_variety->name }}</a>
                        @endforeach
                        @endif                     
                    </div>
                </div>
                @endif
                @endforeach                
            </div>
        </div>
        <div class="col-md-9">
            @component('components/products_list', [
                'products' => $products, 
                'row_item' => 4,
                'pagination' => true
            ])
            @endcomponent
        </div>
    </div>
</div>
@endsection
