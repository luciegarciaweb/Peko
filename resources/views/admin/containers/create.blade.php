@extends('layouts.admin')

@section('title', 'Créer un contenant')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Créer un contenant</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.containers.index') }}" class="btn btn-primary">Liste des contenants</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Liste des produits</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.containers.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nom du contenant</label>
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

            <button type="submit" class="btn btn-primary">Créer le contenant</button>
        </form>
    </div>
</div>
@endsection
