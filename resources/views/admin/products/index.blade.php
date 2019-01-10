@extends('layouts.admin')

@section('title', 'Produits')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Produits</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Créer un produit</a>
        <a href="{{ route('admin.containers.index') }}" class="btn btn-primary">Liste des contenants</a>
    </div>
</div>

@include('partials/_alert')

@if ($products->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore créer de produit.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Prix au kilo</th>
                <th scope="col">Variété</th>
                <th scope="col">Stock</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td class="p-0">
                    @if ($product->picture)
                    <img src="{{ asset('storage/'.$product->picture) }}" 
                        height="60px" class="w-100">
                    @else
                    <div class="p-2 text-center">
                        <span class="fa-stack fa-2x">
                            <i class="fas fa-image fa-stack-1x"></i>
                            <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                        </span>
                    </div>
                    @endif
                </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ tva($product->price) }}</td>
                    <td>{{ tva($product->price_kilo) }}</td>
                    @if ($product->variety)
                    <td>{{ $product->variety->name }}</td>
                    @else
                    <td class="text-danger">Aucune variété</td>
                    @endif
                    <td>{{ $product->quantity }} Kg</td> 
                    <td>
                        <a href="{{ route('admin.products.active', $product) }}">
                            @if ($product->is_active)
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
                    <td>{{ $product->created_at }}</td>          
                <td>
                    <a href="{{ route('admin.products.star', $product) }}">
                        @if ($product->push_forward)
                        <button type="button" class="btn btn-dark text-warning btn-sm">
                            <i class="fas fa-star"></i>
                        </button>
                        @else
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-star"></i>
                        </button>                        
                        @endif
                    </a> 
                    <a href="{{ route('admin.products.show', $product) }}">
                        <button type="button" class="btn btn-primary btn-sm">
                            Voir
                        </button>
                    </a>
                    <a href="{{ route('admin.products.edit', $product) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $product->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        
                        @component('admin/components/delete_modal', ['data' => $product, 'route' => 'products']) 
                        @endcomponent

                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $products->links() }}
@endsection
