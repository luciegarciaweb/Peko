@extends('layouts.admin')

@section('title', 'Envoyer une newsletter')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Envoyer une newsletter</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-primary">Retour</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.newsletters.store') }}">
            @csrf

            <div class="form-group">
                <label for="object">Objet de l'e-mail</label>
                <input id="object" type="text" 
                    class="form-control{{ $errors->has('object') ? ' is-invalid' : '' }}" 
                    name="object" 
                    value="{{ old('object') }}" 
                    required>
                
                @if ($errors->has('object'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('object') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="body">Contenu de l'e-mail</label>
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
            
            <button type="submit" class="btn btn-primary">Envoyer la newsletter</button>
        </form>
    </div>
</div>
@endsection
