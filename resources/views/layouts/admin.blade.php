<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #17a2b8 !important;
        }

        .dropdown-menu {
            background-color: #343a40;
        }

        .dropdown-item {
            color: #ffffff !important;
        }

        .dropdown-item:hover {
            background-color: #17a2b8;
            color: #ffffff !important;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            background-color: #17a2b8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #138496;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #17a2b8;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        .nav-icon {
            font-size: 1.25rem;
            margin-right: 15px;
            color: white;
            position: relative;
        }

        .nav-icon:hover {
            color: #17a2b8;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.5rem;
            /* Taille réduite */
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .card-text {
            font-size: 1rem;
            /* Taille réduite */
            font-weight: bold;
            margin-bottom: 0;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        .bg-immobilier {
            background-color: rgba(46, 45, 48, 0.2) !important;
        }

        .bg-utilisateur {
            background-color: rgba(122, 122, 122, 0.64) !important;

        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="{{ url('/home') }}" class="navbar-brand">
                <i class="fas fa-home"></i> Dashboard
            </a>
            @role('Admin')
            <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Manage Users</a>
          
          
            <a href="{{ route('rdvs.index') }}">
    <i class="fas fa-user-tag"></i> Manage Rdvs
</a>

@endrole
            <a href="{{ route('immobiliers.index') }}"><i class="fas fa-building"></i> Manage Immobilier</a>
            @role('Admin')
            <div class="has-submenu">
                <a href="{{ route('roles.index', ) }}">
                    <i class="fas fa-cog"></i> Settings
                </a>

            </div>
            @endrole
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Messagerie -->
                            <li class="nav-item">
                                <a class="nav-link nav-icon" href="#">
                                    <i class="fas fa-envelope"></i>
                                    <span class="notification-badge">3</span> <!-- Badge pour les messages non lus -->
                                </a>
                            </li>

                            <!-- Notifications -->
                            <li class="nav-item">
                                <a class="nav-link nav-icon" href="#">
                                    <i class="fas fa-bell"></i>
                                    <span class="notification-badge">5</span>
                                    <!-- Badge pour les notifications non lues -->
                                </a>
                            </li>

                            <!-- Profil utilisateur -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item" href="profilAdmin.edit" id="profile-link">
                                            <i class="fas fa-user-circle"></i> Profil
                                        </a>
                                    </div>

                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container-fluid">
                    <div class="welcome-message">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>