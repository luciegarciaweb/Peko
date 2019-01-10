@extends('layouts.admin')

@section('title', 'Editer la variété '.$variety->name)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer la variété <small class="text-primary">{{ $variety->name }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Liste des catégories</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.varieties.update', $variety) }}">

            @csrf
            
            <div class="form-group">
                <label for="name">Nom de la variété</label>
                <input id="name" type="text" 
                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                    name="name" 
                    value="{{ $variety->name }}" 
                    required>
                
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="category">Catégorie</label>
                <select class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" 
                    name="category"
                    id="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->selectedCategory($variety->category->id) }}>{{ $category->name }}</option>
                    @endforeach
                </select>
        
                @if ($errors->has('category'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif        
            </div>

            <button type="submit" class="btn btn-primary">Editer la variété</button>
        </form>
    </div>
</div>
@endsection
