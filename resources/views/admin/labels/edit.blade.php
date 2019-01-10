@extends('layouts.admin')

@section('title', 'Editer l\'étiquette '.$label->name)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer l'étiquette <span class="badge badge-primary">{{ $label->name }}</span></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.labels.index') }}" class="btn btn-primary">Retour à la liste des étiquettes</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.labels.update', ['label' => $label]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom de l'étiquette</label>
                <input id="name" type="text" 
                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    name="name" 
                    value="{{ $label->name }}" 
                    required>
                
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="body">Description de l'étiquette</label>
                <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    id="body" 
                    name="body"
                    rows="3">{{ $label->body }}</textarea>

                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>    

            <div class="form-group">
                <label for="recipe">Recette de l'étiquette</label>
                <textarea class="form-control{{ $errors->has('recipe') ? ' is-invalid' : '' }}" 
                    id="recipe" 
                    name="recipe"
                    rows="3">{{ $label->recipe }}</textarea>

                @if ($errors->has('recipe'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('recipe') }}</strong>
                    </span>
                @endif
            </div> 

            <div class="form-group">
                <label for="variety">Variété</label>
                <select class="form-control{{ $errors->has('variety') ? ' is-invalid' : '' }}" 
                    name="variety"
                    id="variety">
                    @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach ($category->varieties as $variety)
                        <option value="{{ $variety->id }}" {{ $label->selectedVariety($variety->id) }}>{{ $variety->name }}</option>
                        @endforeach
                    </optgroup>
                    @endforeach
                </select>

                @if ($errors->has('variety'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('variety') }}</strong>
                    </span>
                @endif        
            </div>

            <div class="custom-file mt-2 mb-3">
                <input type="file" class="custom-file-input" id="picture" name="picture">
                <label class="custom-file-label" for="picture">Image de l'étiquette</label>
                @if ($errors->has('picture'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('picture') }}</strong>
                    </span>
                @endif         
            </div>
            
            <button type="submit" class="btn btn-primary">Editer de l'étiquette</button>
        </form>
    </div>
</div>
@endsection
