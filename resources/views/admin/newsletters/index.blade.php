@extends('layouts.admin')

@section('title', 'Newsletters')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Newsletters</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.newsletters.create') }}" class="btn btn-primary">Envoyer une newsletter</a>
    </div>
</div>

@include('partials/_alert')
@if ($newsletters->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore de newsletter.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"># ID</th>
                <th scope="col">E-mail</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newsletters as $newsletter)
            <tr>
                <th scope="row">{{ $newsletter->id }}</th>
                <td>{{ $newsletter->email }}</td>
                <td>{{ $newsletter->created_at }}</td>
                <td>                           
                    <a href="{{ route('admin.newsletters.edit', $newsletter) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $newsletter->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                        
                    @component('admin/components/delete_modal', ['data' => $newsletter, 'route' => 'newsletters']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $newsletters->links() }}
@endsection
