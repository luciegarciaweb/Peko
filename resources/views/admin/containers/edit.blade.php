@extends('layouts.admin')

@section('title', 'Editer le contenant '.$container->name)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer le contenant <small class="text-primary">{{ $container->name }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.containers.index') }}" class="btn btn-primary">Liste des contenants</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Liste des produits</a>
    </div>
</div>

<div class="card">
    <div class="card-body">        
        <form method="POST" action="{{ route('admin.containers.update', $container) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Nom du contenant</label>
                <input id="name" type="text" 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    name="name" 
                    value="{{ $container->name }}" 
                    required>
                
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Editer le contenant</button>
        </form>
    </div>
</div>
@endsection
