@extends('layouts.admin')

@section('title', 'Ajouter une variété dans la catégorie '.$category->name)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Ajouter une variété dans la catégorie <small class="text-primary">{{ $category->name }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Liste des catégories</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.varieties.store', $category) }}">

            @csrf
            
            <div class="form-group">
                <label for="name">Nom de la variété</label>
                <input id="name" type="text" 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required>
                
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Créer la variété</button>
        </form>
    </div>
</div>
@endsection
