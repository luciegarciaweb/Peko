@extends('layouts.admin')

@section('title', 'Editer la newsletter '.$newsletter->email)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer la newsletter <span class="badge badge-primary">{{ $newsletter->email }}</span></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.newsletters.index') }}" class="btn btn-primary">Retour à la liste des newsletters</a>
    </div>
</div>

<div class="card">
    <div class="card-body">        
        <form method="POST" action="{{ route('admin.newsletters.update', ['newsletter' => $newsletter]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="email">{{ __('E-mail') }}</label>
                <input id="email" type="email" 
                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                    name="email" 
                    value="{{ $newsletter->email }}" 
                    required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Editer</button>
        </form>
    </div>
</div>
@endsection
