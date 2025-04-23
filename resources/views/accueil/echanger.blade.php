@extends('layouts.app')

@section('content') <style>
        /* Styles généraux */
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

        /* Titre de la page */
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4e79a7;
            text-align: center;
            margin-bottom: 2rem;
        }

        /* Cartes de biens immobiliers */
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            transition: transform 0.3s ease;
            height: 350px; /* Taille de l'image agrandie */
            width: 100%;
            object-fit: cover; /* Assure que l'image couvre toute la zone */
        }

        .card-img-top:hover {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1rem;
        }

        .card-text {
            font-size: 0.80rem;
            color: #555;
            margin-bottom: 0.3rem;
        }

        .card-text i {
            margin-right: 6px;
            color: #4e79a7;
        }

        .card-text strong {
            color: #333;
        }

        /* Prix et surface sur la même ligne */
        .price-surface {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        /* Titre "Caractéristiques" */
        .caracteristiques-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4e79a7;
            text-align: center;
            margin-bottom: 0.8rem;
            border-bottom: 2px solid #4e79a7;
            padding-bottom: 0.5rem;
        }

        /* Localisation centrée */
        .localisation {
            text-align: center;
            margin-top: 1rem;
        }

        /* Boutons dans la carte */
        .card-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        .card-buttons .btn {
            flex: 1;
            margin: 0 5px;
            text-align: center;
        }

        /* Boutons */
        .btn {
            background-color: #4e79a7;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 30px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #357ab7;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 1.5rem;
            }

            h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-nav {
                text-align: center;
            }

            .nav-item {
                margin: 0.5rem 0;
            }

            .price-surface {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-buttons {
                flex-direction: column;
            }

            .card-buttons .btn {
                margin: 5px 0;
            }
        }


        
    </style>


<!-- Contenu principal -->
<div class="container">
    <h1 class="my-4">Biens immobiliers à echanger</h1>
   
    <div class="row">
    @foreach ($immobiliers as $immobilier)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-lg border-0">
                <!-- Image du bien immobilier -->
                <div class="card-img-top overflow-hidden">
                    <img src="{{ asset($immobilier->user_image) }}" class="img-fluid w-100" style="object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                </div>
                
                <!-- Corps de la carte -->
                <div class="card-body">
                    <!-- Titre "Caractéristiques" -->
                    <div class="caracteristiques-title">Caractéristiques</div>

                    <!-- Prix et surface sur la même ligne -->
                    <div class="price-surface">
                        <p class="card-text">
                            <i class="fas fa-tag"></i> <strong>Prix :</strong> {{ $immobilier->prix }} DA
                        </p>
                        <p class="card-text">
                            <i class="fas fa-ruler-combined"></i> <strong>Surface :</strong> {{ $immobilier->surface }} m²
                        </p>
                    </div>

                    <!-- Localisation centrée -->
                    <div class="localisation">
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> <strong>Localisation :</strong> {{ $immobilier->adresse }}
                        </p>
                    </div>


                    <div class="card-buttons">
                            <a href="{{ route('echange.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Voir en détail
                            </a>
                          
                        </div>
                </div>
            </div>
        </div>
    @endforeach
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




<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection