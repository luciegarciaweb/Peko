@extends('layouts.admin')

@section('title', 'Créer un carrousel')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Créer un carrousel</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary">Retour à la liste des pages</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Titre du carrousel</label>
                <input id="title" type="text" 
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                    name="title" 
                    value="{{ old('title') }}" 
                    required>
                
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="body">Contenu du carrousel</label>
                <textarea id="body" type="text" 
                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    name="body" 
                    value="{{ old('body') }}" 
                    required>
                </textarea>
                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>

            <div class="custom-file mt-2 mb-3">
                <input type="file" class="custom-file-input" id="picture" name="picture" required>
                <label class="custom-file-label" for="picture">Image du carrousel</label>
                @if ($errors->has('picture'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('picture') }}</strong>
                    </span>
                @endif         
            </div>
            
            <button type="submit" class="btn btn-primary">Créer le carrousel</button>
        </form>
    </div>
</div>
@endsection
