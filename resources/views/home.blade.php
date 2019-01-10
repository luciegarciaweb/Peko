@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            @component('components/sliders', ['sliders' => $sliders])
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <h3 class="pb-3 mb-4 font-italic border-bottom">Nos meilleures ventes</h3>
            @component('components/products_list', [
                'products' => $star_products, 
                'row_item' => 3, 
                'pagination' => false
            ])
            @endcomponent   
        </div>

        <div class="col-12">
            <h3 class="pb-3 mb-4 font-italic border-bottom">Nos derniers produits</h3>
            @component('components/products_list', [
                'products' => $last_products, 
                'row_item' => 3, 
                'pagination' => false
            ])
            @endcomponent   
        </div>    
    </div>
</div>
@endsection
