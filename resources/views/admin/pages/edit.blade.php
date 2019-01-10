@extends('layouts.admin')

@section('title', 'Editer la page '.$page->title)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer la page <span class="badge badge-primary">{{ $page->title }}</span></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Retour à la liste des pages</a>
    </div>
</div>

<div class="card">
    <div class="card-body">        
        <form method="POST" action="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Titre de la page</label>
                <input id="title" type="text" 
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                    name="title" 
                    value="{{ $page->title }}" 
                    required>
                
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="body">Contenu de la page</label>
                <textarea id="body" type="text" 
                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    name="body" 
                    required>{{ $page->body }}</textarea>
                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Editer la page</button>
        </form>
    </div>
</div>
@endsection
