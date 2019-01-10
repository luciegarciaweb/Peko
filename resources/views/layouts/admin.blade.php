<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Administration Péko</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand navbar-dark bg-dark static-top">
               
            <a class="sidebar-toggler mr-3" href="#"><i class="material-icons text-white align-middle">menu</i></a>
            <a class="navbar-brand mr-1" href="{{ route('admin.dashboard') }}">Administration</a>
            
            <!-- Navbar -->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">Accueil du site</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
      
          </nav>
      
          <div id="wrapper">
      
            <!-- Sidebar -->
            <ul id="sidebar" style="min-width: 250px; max-width: 250px; min-height: 100vh;" class="sidebar navbar-nav">
                <div id="scrollable">
                    <li class="nav-item {{ Request::is('admin') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/orders') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.orders.index') }}">
                            Commandes en cours
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/orders/completed') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.orders.index.completed') }}">
                            Commandes terminées
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/users') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            Utilisateurs
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/users/pro') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.users.pro') }}">
                            Professionels
                        </a>
                    </li>     
                    <li class="nav-item {{ Request::is('admin/users/pro/new') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.users.new.pro') }}">
                            Demande pour être pro
                        </a>
                    </li>                                   
                    <li class="nav-item {{ Request::is('admin/contacts*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                            Messages
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/products*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            Produits
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/categories*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">
                            Catégories
                        </a>
                    </li> 
                    <li class="nav-item {{ Request::is('admin/labels*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.labels.index') }}">
                            Etiquettes
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/sliders*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                            Carrousels
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/pages*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.pages.index') }}">
                            Pages
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('admin/newsletters*') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin.newsletters.index') }}">
                            Newsletters
                        </a>
                    </li>
                </div>                                                                                                                           
            </ul>
      
            <div id="content-wrapper">
      
                <div class="container-fluid">
                    @yield('content')
                </div>
                 <!-- /.container-fluid -->
      
                <!-- Sticky Footer -->
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © {{ config('peko.title') }} - 2018</span>
                        </div>
                    </div>
                </footer>
      
            </div>
            <!-- /.content-wrapper -->
      
        </div>
          <!-- /#wrapper -->
    </div>
</body>
</html>
