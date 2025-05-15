@extends('layouts.app')

@section('content')
    <style>
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
            border-radius: 15px;
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
            height: 300px; /* Taille de l'image agrandie */
            width: 100%;
            object-fit: cover; /* Assure que l'image couvre toute la zone */
        }

        .card-img-top:hover {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-text {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .card-text i {
            margin-right: 8px;
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
            margin-bottom: 1rem;
        }

        /* Titre "Caractéristiques" */
        .caracteristiques-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4e79a7;
            text-align: center;
            margin-bottom: 1rem;
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
    <h1 class="my-4">Biens immobiliers à acheter</h1>
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

                        <!-- Boutons "Voir en détail" et "Prendre RDV" -->
                        <div class="card-buttons">
                            <a href="{{ route('vente.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Voir en détail
                            </a>
                          
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



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




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection