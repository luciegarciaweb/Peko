@extends('layouts.admin')

@section('title', 'Pages')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Pages</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Créer une page</a>
    </div>
</div>

@include('partials/_alert')

@if ($pages->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore créer de page.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Titre de la page</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>
                    <a href="{{ route('admin.pages.active', $page) }}">
                        @if ($page->is_active)
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
                <td>{{ $page->created_at }}</td>
                <td>                           
                    <a href="{{ route('pages.show', $page) }}">
                        <button type="button" class="btn btn-primary btn-sm">
                            Voir
                        </button>
                    </a>
                    <a href="{{ route('admin.pages.edit', $page) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $page->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    @component('admin/components/delete_modal', ['data' => $page, 'route' => 'pages']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $pages->links() }}
@endsection
