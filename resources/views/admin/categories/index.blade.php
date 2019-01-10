@extends('layouts.admin')

@section('title', 'Catégories')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Catégories</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Créer une catégorie</a>
    </div>
</div>

@include('partials/_alert')

@if ($categories->isEmpty())
<div class="alert alert-primary" role="alert">
  Vous n'avez pas créer de catégorie !
</div>
@else
<div class="alert alert-warning" role="alert">
  <p>Attention ! Supprimer une catégorie supprimera toutes les variétes dans cette catégorie.</p>
  <p class="mb-0">Si vous supprimez une variété, vous devrez modifier les produits qui sont liés à cette variété.</p>
</div>
<div class="card-group">
    @foreach ($categories as $category)
    <div class="col-sm-12 col-md-4">
        <div class="card mb-3">
            <div class="card-header font-weight-bold">
                {{ $category->name }} 
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($category->varieties as $variety)
                <li class="list-group-item">
                    <div class="float-left">
                        {{ $variety->name }}
                    </div>
                    <div class="float-right">
                        <a href="{{ route('admin.varieties.edit', $variety) }}" class="text-dark">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.varieties.delete', $variety) }}"
                            class="text-danger"
                            onclick="event.preventDefault();
                            document.getElementById('delete-form-{{ $variety->slug }}').submit();">
                            <i class="fas fa-trash-alt"></i>
                        </a>

                        <form id="delete-form-{{ $variety->slug }}" action="{{ route('admin.varieties.delete', $variety) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="card-footer border-top-0">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-sm-12 mb-sm-2">
                        <a href="{{ route('admin.varieties.create', $category) }}" class="btn btn-primary btn-sm">Ajouter une variété</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $category->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        @component('admin/components/delete_modal', ['data' => $category, 'route' => 'categories']) 
                        @endcomponent
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
