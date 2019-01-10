<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="orderModalLabel">Détails de la commande N°{{ $order->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                        <tr>
                            <td class="p-0">
                                @if ($product->picture)
                                <img src="{{ asset('storage/'.$product->picture) }}" alt="Image du produit"
                                width="100%" height="60px">
                                @endif
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ tva($product->price) }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>