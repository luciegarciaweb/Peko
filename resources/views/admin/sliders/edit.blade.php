@extends('layouts.admin')

@section('title', 'Editer le carrousel '.$slider->title)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer le carrousel <span class="badge badge-primary">{{ $slider->title }}</span></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.sliders.index') }}" class="btn btn-primary">Retour à la liste des carrousels</a>
    </div>
</div>

<div class="card">
    <div class="card-body">  
        @include('partials/_alert')      
        <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titre du slider</label>
                <input id="title" type="text" 
                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                    name="title" 
                    value="{{ $slider->title }}" 
                    required>
                
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="body">Contenu du slider</label>
                <textarea id="body" type="text" 
                    class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    name="body" 
                    required>{{ $slider->body }}</textarea>
                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="custom-file mt-2 mb-3">
                <input type="file" class="custom-file-input" id="picture" name="picture">
                <label class="custom-file-label" for="picture">Image du carrousel</label>
                @if ($errors->has('picture'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('picture') }}</strong>
                    </span>
                @endif         
            </div>

            <button type="submit" class="btn btn-primary">Editer le slider</button>
        </form>
    </div>
</div>
@endsection
