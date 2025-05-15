@extends('layouts.app')

@section('content')
<style>
    /* Styles généraux */
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        color: #333;
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

    /* Titre de la page */
    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4e79a7;
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 15px;
    }

    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: #4e79a7;
    }

    /* Cartes de biens */
    .property-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        height: 100%;
    }

    .property-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .property-image {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .property-card:hover .property-image {
        transform: scale(1.05);
    }

    .card-body {
        padding: 20px;
    }

    .property-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #4e79a7;
        margin-bottom: 15px;
    }

    .property-features {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .property-feature {
        text-align: center;
        flex: 1;
    }

    .feature-icon {
        font-size: 1.5rem;
        color: #4e79a7;
        margin-bottom: 5px;
    }

    .property-location {
        text-align: center;
        margin: 15px 0;
        font-size: 0.9rem;
    }

    .location-icon {
        color: #4e79a7;
        margin-right: 5px;
    }

    /* Boutons */
    .btn-primary {
        background-color: #4e79a7;
        border: none;
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #3a5f8a;
        transform: translateY(-2px);
    }

    /* Formulaire de recherche */
    .search-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .search-title {
        font-size: 1.5rem;
        color: #4e79a7;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        color: #555;
    }

    .form-control {
        border-radius: 30px;
        padding: 10px 15px;
        border: 1px solid #ddd;
    }

    /* Filtres actifs */
    .active-filters {
        margin-top: 20px;
    }

    .filter-badge {
        background-color: #4e79a7;
        color: white;
        border-radius: 20px;
        padding: 5px 10px;
        margin-right: 10px;
        margin-bottom: 10px;
        display: inline-block;
        font-size: 0.8rem;
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

<div class="container py-5">
    <h1 class="page-title">Biens immobiliers à échanger</h1>

    <div class="search-container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="{{ route('echanger.search') }}" method="GET">
                    <div class="row g-3">
                        <!-- Localisation -->
                        <div class="col-md-6">
                            <label for="ville" class="form-label">Localisation</label>
                            <input type="text" class="form-control" id="ville" name="ville" 
                                   value="{{ request('ville') }}" placeholder="Ville, quartier...">
                        </div>
                        
                        <!-- Surface -->
                        <div class="col-md-6">
                            <label for="surface" class="form-label">Surface minimale (m²)</label>
                            <input type="number" class="form-control" id="surface" name="surface" 
                                   value="{{ request('surface') }}" min="0" placeholder="Surface minimum">
                        </div>
                        
                        <!-- Bouton Rechercher -->
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-search me-2"></i> Rechercher
                            </button>
                            
                            <a href="{{ route('app_echanger') }}" class="btn btn-outline-secondary px-5 ms-2">
                                <i class="fas fa-undo me-2"></i> Réinitialiser
                            </a>
                        </div>
                    </div>
                    
                    <!-- Filtres avancés -->
                    <div class="text-center mt-4">
                        <a href="#advancedFilters" class="text-primary" data-bs-toggle="collapse">
                            <i class="fas fa-filter me-2"></i> Filtres avancés
                        </a>
                    </div>
                    
                    <div class="collapse mt-3" id="advancedFilters">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="prix_min" class="form-label">Prix minimum (DA)</label>
                                <input type="number" class="form-control" id="prix_min" name="prix_min" 
                                       value="{{ request('prix_min') }}" placeholder="Prix minimum">
                            </div>
                            <div class="col-md-6">
                                <label for="prix_max" class="form-label">Prix maximum (DA)</label>
                                <input type="number" class="form-control" id="prix_max" name="prix_max" 
                                       value="{{ request('prix_max') }}" placeholder="Prix maximum">
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Filtres actifs -->
                @if(request()->anyFilled(['ville', 'surface', 'prix_min', 'prix_max']))
                <div class="active-filters mt-4">
                    <h6 class="mb-3"><i class="fas fa-filter me-2"></i>Filtres appliqués :</h6>
                    @foreach(request()->all() as $key => $value)
                        @if(in_array($key, ['ville', 'surface', 'prix_min', 'prix_max']) && !empty($value))
                            <span class="filter-badge">
                                @if($key == 'ville') Localisation: {{ $value }}
                                @elseif($key == 'surface') Surface min: {{ $value }}m²
                                @elseif($key == 'prix_min') Prix min: {{ number_format($value, 0, ',', ' ') }} DA
                                @elseif($key == 'prix_max') Prix max: {{ number_format($value, 0, ',', ' ') }} DA
                                @endif
                                <a href="{{ request()->fullUrlWithQuery([$key => null]) }}" class="text-white ms-2">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bouton Ajouter une offre -->
    <div class="text-end mb-4">
        <a href="{{ route('echange.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Ajouter mon offre
        </a>
    </div>


<div class="text-end mb-4">
    <a class="btn btn-primary" onclick="toggleReferenceForm()">
        <i class="fas fa-plus-circle me-2"></i> Chercher par référence 
    </a>
</div>

<div id="reference-form" class="mb-4" style="display: none;">
    <input type="text" id="reference-input" class="form-control mb-2" placeholder="Entrer la référence">
    <button class="btn btn-success" onclick="searchByReference()">Rechercher</button>
</div>

<div id="result"></div>

<script>
function toggleReferenceForm() {
    const form = document.getElementById('reference-form');
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}
function searchByReference() {
    const ref = document.getElementById('reference-input').value.trim();
    if (!ref) {
        alert('Veuillez entrer une référence.');
        return;
    }
    // Redirection simple vers la page de détail
    window.location.href = `/immobiliers/rechercher/${ref}`;
}

</script>






    <!-- Liste des biens -->
    <div class="row">
        @forelse ($immobiliers as $immobilier)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="property-card h-100">
                <div class="overflow-hidden" style="height: 250px;">
                    <img src="{{ asset($immobilier->user_image) }}" class="property-image w-100 h-100">
                </div>
                
                <div class="card-body">
                    
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
</div>
                   
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('echange.detail', ['id' => $immobilier->id]) }}" class="btn btn-primary flex-grow-1 me-2">
                            <i class="fas fa-eye me-2"></i> Détails
                        </a>
                        
                        @auth
                            @if(Auth::user()->id === $immobilier->user_id)
                                <a href="{{ route('offres.similaires', $immobilier->id) }}" class="btn btn-outline-primary flex-grow-1">
                                    <i class="fas fa-search me-2"></i> Recherche
                                </a>
                            @else
     <a href="{{ url('chatify/' . $immobilier->user_id) }}" class="btn btn-primary flex-grow-1 me-2">
    <i class="fas fa-envelope me-2"></i> Contacter
</a>


                            @endif
                        @else
                      
<a href="{{ url('chatify/' . $immobilier->user_id) }}" class="btn btn-primary flex-grow-1 me-2">
    <i class="fas fa-envelope me-2"></i> Contacter
</a>

                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i> Aucun bien trouvé correspondant à vos critères de recherche.
            </div>
        </div>
        @endforelse
    </div>
    
    
</div>

<!-- Script pour les filtres avancés -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher les filtres avancés s'ils ont des valeurs
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('prix_min') || urlParams.has('prix_max')) {
            const advancedFilters = document.getElementById('advancedFilters');
            const bsCollapse = new bootstrap.Collapse(advancedFilters, {
                toggle: false
            });
            bsCollapse.show();
        }
    });
</script>






@endsection