@extends('layouts.admin')

@section('title', 'Contenants')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Contenants</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.containers.create') }}" class="btn btn-primary">Créer un contenant</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Liste des produits</a>
    </div>
</div>

@include('partials/_alert')

@if ($containers->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore créer de contenant.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Nom du contenant</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($containers as $container)
            <tr>
                <td>{{ $container->name }}</td>
                <td>                           
                    <a href="{{ route('admin.containers.edit', $container) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $container->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @component('admin/components/delete_modal', ['data' => $container, 'route' => 'containers']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $containers->links() }}
@endsection
