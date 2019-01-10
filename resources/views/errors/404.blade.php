@extends('layouts.app')

@section('title', '404 Page non trouvée')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-0">
                <img src="{{ asset('image/404.jpg') }}" class="img-fluid" alt="404 Error">
                <div class="text-404 text-center">
                    Oups, la page n'a pas été trouvée !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
