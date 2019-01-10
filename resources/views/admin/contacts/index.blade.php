@extends('layouts.admin')

@section('title', 'Messages reçu')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Messages reçu</h1>
    </div>
</div>

@include('partials/_alert')

@if ($contacts->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore de message.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Destinataire</th>
                <th scope="col">Objet</th>
                <th scope="col">Date réception</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->fullname }}</td>
                <td>{{ $contact->object }}</td>
                <td>{{ $contact->created_at }}</td>             
                <td>
                    @if ($contact->is_read) 
                    <span class="badge badge-info">lu</span> 
                    @else
                    <span class="badge badge-warning">non-lu</span>
                    @endif
                </td>
                <td>
                   <a href="{{ route('admin.contacts.show', $contact) }}">
                        <button type="button" class="btn btn-primary btn-sm">
                            Voir
                        </button>
                     </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $contact->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>   
                        @component('admin/components/delete_modal', ['data' => $contact, 'route' => 'contacts']) 
                        @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $contacts->links() }}
@endsection
