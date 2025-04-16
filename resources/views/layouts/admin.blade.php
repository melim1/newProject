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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #1a252f;
            --accent-color: #3498db;
            --sidebar-bg: #2c3e50;
            --navbar-bg: #ffffff;
            --hover-color: #34495e;
            --active-color: #3498db;
            --text-light: #ecf0f1;
            --text-dark: #2c3e50;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--text-dark);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 0 1.5rem 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand .logo-icon {
            font-size: 1.8rem;
            color: var(--accent-color);
            margin-right: 10px;
        }

        .sidebar-brand .logo-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
        }

        .sidebar-menu {
            padding: 0 1rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--hover-color);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a i {
            font-size: 1.1rem;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* Navbar Styles */
        .main-navbar {
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            height: 70px;
            background: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            z-index: 900;
            display: flex;
            align-items: center;
            padding: 0 2rem;
        }

        .nav-item {
            margin-left: 1.5rem;
            position: relative;
        }

        .nav-icon {
            font-size: 1.3rem;
            color: #7f8c8d;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-icon:hover {
            color: var(--accent-color);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 0.65rem;
            font-weight: bold;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid var(--accent-color);
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-right: 5px;
        }

        .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            margin-top: 10px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            color: var(--text-dark);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
        }

        .dropdown-item i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            padding: 90px 2rem 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            background-color: white;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0;
            color: var(--text-dark);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-navbar {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .navbar-toggler {
                display: block;
                margin-right: 1rem;
            }


        

        
    </style>
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-brand">
                <div class="logo-icon"><i class="fas fa-home"></i></div>
                <div class="logo-text">Tableau de bord</div>
            </div>

            <div class="sidebar-menu">
                <a href="{{ url('/home') }}" class="active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>

                @role('Admin')
                <a href="{{ route('users.index') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Gérer Utilisateurs</span>
                </a>

                <a href="{{ route('rdvs.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Rendez-vous</span>
                </a>
                @endrole

                <a href="{{ route('immobiliers.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Immobilier</span>
                </a>

           
            </div>
        </div>

        <!-- Navbar -->
        <nav class="main-navbar navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-icon" href="#">
                            <i class="fas fa-envelope"></i>
                            <span class="notification-badge">3</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-icon" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">5</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <div class="user-dropdown" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3498db&color=fff"
                                class="user-avatar">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                    <i class="fas fa-user"></i> Profil
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>


                             <!-- Messagerie -->
                             <li class="nav-item">
                                <a class="nav-link nav-icon" href="{{ route('messagerie') }}">
                                    <i class="fas fa-envelope"></i>
                                            @if($unseenCounter > 0)
                                          <span class="notification-badge">{{ $unseenCounter }}</span>
                                           @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <main class="py-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.querySelector('.navbar-toggler').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>