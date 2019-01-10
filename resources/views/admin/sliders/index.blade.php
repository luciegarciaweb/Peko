@extends('layouts.admin')

@section('title', 'Carrousels')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Carrousels</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Créer un carrousel</a>
    </div>
</div>

@include('partials/_alert')

@if ($sliders->isEmpty())
<div class="alert alert-info" role="alert">
  Vous n'avez pas encore créer un carrousel.
</div>
@else
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col"># ID</th>
                <th scope="col">Image</th>
                <th scope="col">Titre</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
            <tr>
                <th scope="row">{{ $slider->id }}</th>
                <td class="p-0">
                    @if ($slider->picture)
                    <img src="{{ asset('storage/'.$slider->picture) }}" 
                        class="img-table">
                    @else
                    Pas d'image
                    @endif
                </td>
                <td>{{ $slider->title }}</td>
                <td>
                    <a href="{{ route('admin.sliders.active', $slider) }}">
                        @if ($slider->is_active)
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
                <td>{{ $slider->created_at }}</td>
                <td>
                    <a href="{{ route('admin.sliders.edit', $slider) }}">
                        <button type="button" class="btn btn-dark btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $slider->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    @component('admin/components/delete_modal', ['data' => $slider, 'route' => 'sliders']) 
                    @endcomponent
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{ $sliders->links() }}

@endsection
