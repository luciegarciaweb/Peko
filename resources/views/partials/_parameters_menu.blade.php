<div class="card mb-3">
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action @if (Request::is('parameters')) active @endif" 
            href="{{ route('parameters.edit') }}">
            Paramètres du compte
        </a>
        <a class="list-group-item list-group-item-action @if (Request::is('parameters/passwords')) active @endif" 
            href="{{ route('parameters.passwords.edit') }}">
            Changer de mot de passe
        </a>
        <a class="list-group-item list-group-item-action @if (Request::is('addresses')) active @endif" 
            href="{{ route('addresses.index') }}">
            Mon adresse
        </a>
        <a class="list-group-item list-group-item-action @if (Request::is('orders/current')) active @endif" 
            href="{{ route('orders.current') }}">
            Commandes en cours
        </a>
        <a class="list-group-item list-group-item-action @if (Request::is('orders/history')) active @endif" 
            href="{{ route('orders.history') }}">
            Historique des commandes
        </a>
        <a class="list-group-item list-group-item-action @if (Request::is('parameters/pro')) active @endif" 
            href="{{ route('parameters.pro.create') }}">
            Devenir un professionel
        </a>
    </div>
</div>