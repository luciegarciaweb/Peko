@extends('layouts.admin')

@section('title', 'Liste des étiquettes')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Etiquettes</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.labels.create') }}" class="btn btn-primary">Créer une étiquette</a>
    </div>
</div>

@include('partials/_alert')

@if ($labels->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore créer d'étiquette.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
            <tr>
                <td>
                    @if ($label->picture)
                    <img src="{{ asset('storage/'.$label->picture) }}" 
                        width="50px" height="50px">
                    @else
                    Pas d'image
                    @endif
                </td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->created_at }}</td>
            </td>
                <td>
                    <a href="{{ route('admin.labels.edit', $label) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $label->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    @component('admin/components/delete_modal', ['data' => $label, 'route' => 'labels']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif 

{{ $labels->links() }}
@endsection
