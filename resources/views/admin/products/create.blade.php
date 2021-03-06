@extends('layouts.admin')

@section('title', 'Créer un produit')

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Créer un produit</h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Liste des produits</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @include('partials/_alert')
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf

            <h3 class="mb-3">Générale</h3>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="title">Titre</label>
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
                    <div class="col">
                        <label for="quantity">Stock (en kilo)</label>
                        <input id="quantity" type="text" 
                            class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                            name="quantity" 
                            value="{{ old('quantity') }}" 
                            required>
                        
                        @if ($errors->has('quantity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="body">{{ __('Description') }}</label>
                <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" 
                    id="body" 
                    name="body"
                    rows="3">{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>    

            <hr>

            <h3 class="mb-3">Prix</h3>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="container" class="w-100">Type de contenant <a href="{{ route('admin.containers.create') }}" class="float-right">Créer un contenant</a></label>
                        <select class="form-control{{ $errors->has('container') ? ' is-invalid' : '' }}" 
                            id="container"
                            name="container">
                            @foreach ($containers as $container)
                            <option value="{{ $container->id }}">{{ $container->name }}</option>
                            @endforeach
                        </select>   

                        @if ($errors->has('container'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('container') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col">
                        <label for="weight_unity">Poids par unité (en gramme)</label>
                        <input type="text" class="form-control{{ $errors->has('weight_unity') ? ' is-invalid' : '' }}" id="weight_unity" name="weight_unity" value="{{ old('weight_unity') }}">
                        
                        @if ($errors->has('weight_unity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('weight_unity') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="price">Prix à l'unité</label>
                        <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" name="price" value="{{ old('price') }}">
                        
                        @if ($errors->has('price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col">
                        <label for="price_kilo">Prix aux kilos</label>
                        <input type="text" class="form-control{{ $errors->has('price_kilo') ? ' is-invalid' : '' }}" id="price_kilo" name="price_kilo" value="{{ old('price_kilo') }}">
                        
                        @if ($errors->has('price_kilo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price_kilo') }}</strong>
                        </span>
                        @endif  
                    </div>
                </div>
            </div>

            <hr>

            <h3 class="mb-3">Catégorie</h3>

            <div class="form-group">
                <label for="variety">Variété</label>
                <select class="form-control{{ $errors->has('variety') ? ' is-invalid' : '' }}" 
                    name="variety"
                    id="variety">
                    @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach ($category->varieties as $variety)
                        <option value="{{ $variety->id }}">{{ $variety->name }}</option>
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
            <div class="custom-file mt-3">
                <input type="file" class="custom-file-input" id="picture" name="picture">
                <label class="custom-file-label" for="picture">Image du produit</label>
                @if ($errors->has('picture'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('picture') }}</strong>
                    </span>
                @endif         
            </div>
        <div>
        <button type="submit" class="btn btn-primary mt-3 mb-3">Créer le produit</button>
        </form>
    </div>
</div>
@endsection
