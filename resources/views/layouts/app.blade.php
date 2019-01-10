<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('peko.title') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/front.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
    integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
    crossorigin=""></script>
</head>
<body>
    <div id="app">
        <div class="container">
            <header class="py-3 border-bottom mb-1 pb-4">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 pt-1">
                        <form method="GET" action="{{ route('search') }}">
                            <div class="input-group">
                                <input class="form-control" type="text" name="query" placeholder="Rechercher un produit">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-4 text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('image/logo/Aux-Paniers-de-Peko - Logo.png') }}" width="170px" height="125px" alt="Logo Péko">
                        </a>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="btn btn-outline-primary mr-2" href="{{ route('carts.index') }}">Panier <span class="badge badge-primary">@if (isset($count_carts)) {{ $count_carts }} @else 0 @endif</span></a>                        
                        @guest
                        <a class="btn btn-outline-primary mr-2" href="{{ route('login') }}">Connexion</a>
                        <a class="btn btn-outline-primary" href="{{ route('register') }}">Créer un compte</a>
                        @else
                        <div class="dropdown">
                            <a id="navbarDropdown" class="btn btn-outline-primary dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->fullname() }}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('parameters.edit') }}">Paramètres</a>
                                <a class="dropdown-item" href="{{ route('orders.current') }}">Commandes en cours</a>
                                <a class="dropdown-item" href="{{ route('orders.history') }}">Historiques des commandes</a>
                                @if (Auth::user()->is_admin) 
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Administration</a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>                        
                        </div>
                        @endguest
                    </div>
                </div>
            </header>

            <div class="nav-categories py-1 mb-2 mt-1">
                <nav class="nav d-flex text-uppercase">
                    <a href="{{ route('products.index') }}" class="p-2 text-muted btn btn-link">Tous les produits</a>
                    @foreach ($categories as $category)
                    @if (!$category->varieties->isEmpty())
                    <div class="dropdown">
                        <a class="p-2 text-muted dropdown-toggle btn btn-link" href="#" id="{{ $category->slug }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->name }} </a>
                        <div class="dropdown-menu" aria-labelledby="{{ $category->slug }}">
                            @foreach ($category->varieties as $variety)
                            <a class="dropdown-item" href="{{ route('products.index.variety', $variety) }}">{{ $variety->name }}</a>
                            @endforeach
                        </div>
                    </div>                    
                    @endif
                    @endforeach
                </nav>
            </div>
        </div>

        <main class="py-2">
            @yield('content')
        </main>


        <footer class="mt-3">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <form method="POST" action="{{ route('newsletters.store') }}">
                            @csrf
                            <label for="email_newsletter">S'inscrire à la Newsletter</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control{{ $errors->has('email_newsletter') ? ' is-invalid' : '' }}" placeholder="email@email.com" name="email_newsletter">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p>&copy {{ config('peko.title') }} - 2018.</p>
            <p>
                @foreach ($pages as $page)
                <a href="{{ route('pages.show', $page) }}">{{ $page->title }}</a>
                @endforeach
                <a href="{{ route('contacts.create') }}">Nous contacter</a>
            </p>
        </footer>
    </div>
    <script>
    var mapbox_api = '{{ env('MAPBOX_API') }}';
    </script>
</body>
</html>
