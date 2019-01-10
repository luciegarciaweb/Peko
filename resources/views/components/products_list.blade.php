@if ($products->isEmpty())
<div class="alert alert-info" role="alert">
  Il n'y à aucun produits ici. 
</div>
@else

<div class="card-group">
    @foreach ($products as $product)
    <div class="col-sm-12 col-md-{{ $row_item }}">
        <div class="card mb-3">
            @if ($product->picture)
            <img class="card-img-top" height="200px" src="{{ asset('storage/'.$product->picture) }}" alt="Image du produit">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ substr($product->title, 0, 20) }}</h5>
                <p class="card-text font-weight-bold">{{ tva($product->price) }}</p>
                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Voir le détail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if ($pagination)
<div class="row">
    <div class="col-12 ml-3">
        {{ $products->links() }}
    </div>
</div>
@endif
@endif