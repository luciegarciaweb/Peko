@extends('layouts.admin')

@section('title', 'Editer la commande '.$order->id)

@section('content')
<div class="row pb-3">
    <div class="col-auto mr-auto">
        <h1 class="h2">Editer la commande <small class="text-primary">N°{{ $order->id }}</small></h1>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Liste des commandes</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="text-center">Modifier la date de récupération de la commande</h5>
        <form method="POST" action="{{ route('admin.orders.update', $order) }}">
            @csrf
            @method('PUT')

            <select-hour 
                open-hour="{{ config('peko.open_hours') }}" 
                close-hour="{{ config('peko.close_hours') }}"
                increment="{{ config('peko.hour_increment') }}">
            </select-hour>

            <button type="submit" class="btn btn-primary">Editer la commande</button>
        </form>
    </div>
</div>
@endsection
