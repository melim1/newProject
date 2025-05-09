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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Barre de navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4e79a7 !important;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .nav-link:hover {
            color: #4e79a7 !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #4e79a7 !important;
            font-weight: 700;
        }

        /* Menu déroulant */
        .dropdown-menu {
            background: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Contenu principal */
        main {
            padding: 2rem;
        }

        .nav-icon {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.notification-badge,
.pending-notification-chat {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 20px;
    height: 20px;
    background-color: #ff4757;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    font-weight: bold;
    justify-content: center;
}

.nav-link {
    display: flex;
    align-items: center;
    position: relative;
}

    </style>
</head>

<body>
    <div id="app">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Immobilier</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end pe-5" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_accueil') active @endif"
                                aria-current="page" href="{{ route('app_accueil') }}">
                                <i class="fas fa-home"></i> Accueil
                            </a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_acheter') active @endif"
                                href="{{ route('app_acheter') }}">
                                <i class="fas fa-shopping-cart"></i> Acheter
                            </a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_louer') active @endif"
                                href="{{ route('app_louer') }}">
                                <i class="fas fa-hand-holding-usd"></i> Louer
                            </a>
                        </li>


                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_echanger') active @endif"
                                href="{{ route('app_echanger') }}">
                                <i class="fas fa-hand-holding-usd"></i> Echanger
                            </a>
                        </li>
                        <li class="nav-item me-4">
                            <a class="nav-link @if(Request::route()->getName() == 'app_about') active @endif"
                                href="{{ route('app_about') }}">
                                <i class="fas fa-info-circle"></i> À propos
                            </a>
                        </li>



    

                        <!-- Lien "Profil" visible uniquement pour les utilisateurs connectés -->
                        @auth
                            <li class="nav-item me-4">
                                <a class="nav-link @if(Request::route()->getName() == 'app_historique') active @endif"
                                    href="{{ route('app_historique') }}">
                                    <i class="fas fa-user"></i> Historique
                                </a>
                            </li>


                            
                            <li class="nav-item dropdown me-4">
    <a class="nav-link" href="#" id="notificationDropdown" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i> Notification

        @if(Auth::user()->unreadNotifications->count() > 0)
            <span class="notification-badge" id="notificationCount">
                {{ Auth::user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="min-width: 300px;">
        @if(Auth::user()->unreadNotifications->count() > 0)
            @foreach(Auth::user()->unreadNotifications as $notification)
                <li class="dropdown-item">
                    <a href="#" class="notification-link" data-notification-id="{{ $notification->id }}"
                        data-url="{{ $notification->data['url'] ?? '#' }}">
                        {{ $notification->data['message'] ?? 'Vous avez une notification.' }}
                    </a>
                </li>
            @endforeach
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="#" id="markAllAsRead">
                    Marquer toutes comme lues
                </a>
            </li>
        @else
            <li class="dropdown-item text-muted">Aucune notification.</li>
        @endif
    </ul>
</li>



                            <li class="nav-item">
    <a class="nav-link nav-icon" href="{{ route('messagerie') }}">
        <i class="fas fa-envelope"></i> Messagerie

        @if($unseenCounter > 0)
            <span class="notification-badge">{{ $unseenCounter }}</span>
        @endif
    </a>
</li>


                            <li class="nav-item">
                                <a class="nav-link @if(Request::route()->getName() == 'app_profil') active @endif"
                                    href="{{ route('app_profil') }}">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                            </li>
                        @endauth

                        <!-- Lien "Se connecter" visible uniquement pour les utilisateurs non connectés -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> Se connecter
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>



    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Activer le log Pusher (à désactiver en production)
    Pusher.logToConsole = true;

    // Initialiser Pusher
    var pusher = new Pusher('90772dc20eb20484a33c', {
        cluster: 'mt1'
    });

    // S'abonner au canal
    var channel = pusher.subscribe('my-channel');

    // Réagir à l'événement 'my-event'
    channel.bind('my-event', function(data) {
        $.ajax({
            type: 'GET',
            url: '/updateunseenmessage',
            success: function(data) {
                console.log(data.unseenCounter);

                var html = ``;

                if (data.unseenCounter > 0) {
                    html += `<span style="right:68px;" class="pending-notification-chat">${data.unseenCounter}</span>`;
                }

                $('.pending-div').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX :", error);
            }
        });
    });
</script>

</body>

</html>