@extends('layouts.app')
@section('title', 'Profil')

@section('content')
<div class="container mt-5">
    <!-- Affichage du bouton de déconnexion si l'utilisateur est connecté -->
    @auth
        <div class="d-flex justify-content-between align-items-center">
            <h1>Profil de {{ $user->name }}</h1>
            <a href="{{ route('logout') }}" class="btn btn-danger" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>
        </div>

        <!-- Formulaire de déconnexion caché -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @else
        <p>Vous n'êtes pas connecté.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
    @endauth
</div>

<div class="container">
    <!-- Informations de l'utilisateur -->
    <div class="mb-4">
        <div class="p-4 bg-white rounded shadow-sm border">
            <p class="mb-2"><strong>Nom :</strong> {{ $user->name }}</p>
            <p class="mb-0"><strong>Email :</strong> {{ $user->email }}</p>
        </div>
    </div>
</div>



<footer class="bg-white text-white pt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Colonne À propos -->
            <div class="col-lg-4 col-md-6">
                <div class="pe-lg-4">
                    <h3 class="h4 mb-4 text-primary">Agence immobilière</h3>
                    <p class="text-muted">
                        Votre partenaire de confiance pour trouver le bien idéal. 
                        Nous vous accompagnons dans tous vos projets immobiliers 
                        avec expertise et professionnalisme.
                    </p>
                    <div class="mt-4">
                        <a href="tel:+123456789" class="text-bleu text-decoration-none d-block mb-2">
                            <i class="fas fa-phone-alt me-2"></i> +123 456 789
                        </a>
                        <a href="mailto:contact@agence.com" class="text-blue text-decoration-none d-block">
                            <i class="fas fa-envelope me-2"></i> contact@agence.com
                        </a>
                    </div>
                </div>
            </div>

            <!-- Colonne Liens rapides -->
            <div class="col-lg-4 col-md-6">
                <h5 class="h6 mb-4 text-primary">Navigation</h5>
                <div class="d-flex flex-column">
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary 
                        @if(Request::route()->getName() == 'app_accueil') active text-primary @endif" 
                        href="{{ route('app_accueil') }}">
                        <i class="fas fa-home me-2"></i> Accueil
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_acheter') active text-primary @endif" 
                        href="{{ route('app_acheter') }}">
                        <i class="fas fa-euro-sign me-2"></i> Acheter
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_louer') active text-primary @endif" 
                        href="{{ route('app_louer') }}">
                        <i class="fas fa-key me-2"></i> Louer
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_about') active text-primary @endif" 
                        href="{{ route('app_about') }}">
                        <i class="fas fa-info-circle me-2"></i> À propos
                    </a>
                    <a class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_connexion') active text-primary @endif" 
                        href="{{ route('app_connexion') }}">
                        <i class="fas fa-sign-in-alt me-2"></i> Connexion
                    </a>
                    <a class="text-blue-50 text-decoration-none py-1 hover-text-primary
                        @if(Request::route()->getName() == 'app_inscription') active text-primary @endif" 
                        href="{{ route('app_inscription') }}">
                        <i class="fas fa-user-plus me-2"></i> Inscription
                    </a>
                </div>
            </div>

            <!-- Colonne Réseaux sociaux -->
            <div class="col-lg-4 col-md-6">
                <h5 class="h6 mb-4 text-primary">Nous suivre</h5>
                <div class="d-flex flex-column mb-4">
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-twitter me-2"></i> Twitter
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-facebook-f me-2"></i> Facebook
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none mb-2 py-1 hover-text-primary">
                        <i class="fab fa-instagram me-2"></i> Instagram
                    </a>
                    <a href="#" class="text-blue-50 text-decoration-none py-1 hover-text-primary">
                        <i class="fab fa-linkedin-in me-2"></i> LinkedIn
                    </a>
                </div>
                
              
            </div>
        </div>
        
        <hr class="my-4 bg-gray-700">
        
        <div class="text-center py-3">
            <p class="mb-0 text-blue-50 small">
                &copy; {{ date('Y') }} Agence immobilière - Tous droits réservés
                <span class="mx-2">|</span>
                <a href="#" class="text-blue-50 text-decoration-none hover-text-primary">Mentions légales</a>
                <span class="mx-2">|</span>
                <a href="#" class="text-blue-50 text-decoration-none hover-text-primary">Politique de confidentialité</a>
            </p>
        </div>
    </div>
</footer>

<style>
    .hover-text-primary:hover {
        color:rgb(23, 58, 96) !important;
        transform: translateX(5px);
        transition: all 0.3s ease;
    }
    
    .bg-gray-800 {
        background-color:rgb(192, 208, 236);
    }
    
    footer a.active {
        color: #4e79a7 !important;
        font-weight: 600;
    }
    
    footer .text-primary {
        color: #4e79a7 !important;
    }
</style>




@endsection
